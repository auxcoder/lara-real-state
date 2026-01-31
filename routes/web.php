<?php

use App\Http\Controllers\Admin\AgentPropertyController;
use App\Http\Controllers\Admin\AgentsController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CommunityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\DeveloperPropertyController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MasterPlanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorRegistrationController;
use App\Http\Controllers\Admin\VisitorSubmissionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\FormController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/lang/{lang}', function ($lang) {
    if (! in_array($lang, ['en', 'es', 'ca'])) {
        abort(400);
    }
    session(['locale' => $lang]);

    return back();
})->name('lang.switch');

Route::get('/test-email', [TestEmailController::class, 'sendTestEmail'])->name('test.email');

require __DIR__.'/auth.php';

// Property routes
Route::controller(PropertyController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/properties', 'filter')->name('properties.index');
    Route::get('/properties/{location}', 'showByLocation')->name('properties.byLocation');
    Route::get('/property-details/{slug}', 'show')->name('projects');
    Route::get('/offplan', 'offplan')->name('offplan');
    Route::get('/search/offplan', 'filter')->name('offplan_search');
    Route::get('/secondary-sale', 'secondarySale')->name('secondarySale');
    Route::get('/address-residence/{slug}', 'addressResidence')->name('addressResidence');
    Route::get('/payment-plan/{slug}', 'paymentPlan')->name('paymentPlan');
    Route::get('/location-map/{slug}', 'locationMap')->name('locationMap');
    Route::get('/master-plan/{slug}', 'masterPlan')->name('masterPlan');
    Route::get('/floor-plan/{slug}', 'floorPlan')->name('floorPlan');
});

// Blog routes
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog');
    Route::get('/blog/{slug}', 'show')->name('blog.show');
    Route::get('/inner-blog', 'inner')->name('innerBlog');
    Route::get('/new-articles', 'latest')->name('newArticles');
});

// Page routes
Route::controller(PageController::class)->group(function () {
    Route::get('/about-us', 'aboutUs')->name('aboutUs');
    Route::get('/leadership', 'leadership')->name('leadership');
    Route::get('/leadership/{slug}', 'leadershipDetail')->name('leadership.detail');
    Route::get('/contact-us', 'contactUs')->name('contactUs');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/service', 'service')->name('service');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('/term-condition', 'termCondition')->name('term-condition');
    Route::get('/location', 'location')->name('location');
    Route::get('/project-community', 'projectCommunity')->name('projectCommunity');
    Route::get('/developer-list', 'developerList')->name('developerList');
    Route::get('/developer-page/{id}', 'developerPage')->name('developerPage');
    Route::get('/community/{id}', 'communityPage')->name('community');
    Route::get('/community-page/{id}', 'communityPage')->name('communityPage');
});

// Form routes
Route::controller(FormController::class)->middleware('throttle:5,1')->group(function () {
    Route::get('/complain', 'showComplaint')->name('complaint.form');
    Route::post('/complaint-submit', 'submitComplaint')->name('complaint.submit');
    Route::get('/visitor', 'showVisitor')->name('visitor.form');
    Route::post('/visitor-submit', 'submitVisitor')->name('visitor.submit');
    Route::get('/vendors/registration', 'showRegistration')->name('registration.form');
    Route::post('/vendors/registration-submit', 'submitRegistration')->name('registration.submit');
    Route::post('/contact/send', 'sendContact')->name('contact.send');
});

// Dashboard and Logout routes
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::get('/home', [AuthenticatedSessionController::class, 'home'])->name('home');
});

// Route::get('property/backfill-slugs', [AgentPropertyController::class, 'backfillSlugs'])->name('property.backfill-slugs');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('slugify', [AgentPropertyController::class, 'slugify'])->name('slugify');
    Route::resource('roles', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('agents', AgentsController::class);
    Route::resource('property', AgentPropertyController::class);
    Route::resource('developers', DeveloperController::class);
    Route::resource('amenity', AmenityController::class);
    Route::resource('master-plans', MasterPlanController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('developer_properties', DeveloperPropertyController::class);
    Route::resource('communities', CommunityController::class);
    Route::resource('blogs', AdminBlogController::class);
    Route::resource('team', TeamController::class);
    Route::resource('visitor-submissions', VisitorSubmissionController::class)->only(['index', 'show', 'destroy']);
    Route::resource('vendor-registrations', VendorRegistrationController::class)->only(['index', 'show']);
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function () {
    Route::get('user/dashboard', [UserController::class, 'user'])->name('user.dashboard');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'role:user|admin']], function () {
    Route::get('/profile', [UserController::class, 'showProfile']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
