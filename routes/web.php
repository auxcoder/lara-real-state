<?php

use App\Http\Controllers\Admin\AgentPropertyController;
use App\Http\Controllers\Admin\AgentsController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommunityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\DeveloperPropertyController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MasterPlanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TeacherDashboardController;
use App\Http\Controllers\Admin\StudentDashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\VisitorSubmissionController;
use App\Http\Controllers\Admin\VendorRegistrationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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
    if (!in_array($lang, ['en', 'ar'])) {
        abort(400);
    }
    session(['locale' => $lang]);
    return back();
})->name('lang.switch');

Route::get('/test-email', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('This is a test email from Property Marketplace. If you received this, your SMTP configuration is working correctly!', function ($message) {
            $message->to('dcsyedfaraz@gmail.com')
                ->subject('SMTP Test Email - Property Marketplace');
        });

        return response()->json([
            'success' => true,
            'message' => 'Test email sent successfully! Check your inbox at test@example.com'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send email: ' . $e->getMessage()
        ], 500);
    }
})->name('test.email');

require __DIR__ . '/auth.php';

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/properties', 'filter')->name('properties.index');
    Route::get('/properties/{location}', 'showPropertiesByLocation')->name('properties.byLocation');
    Route::get('/property-details/{slug}', 'projects')->name('projects');
    Route::get('/about-us', 'aboutUs')->name('aboutUs');
    Route::get('/leadership', 'leadership')->name('leadership');
    Route::get('/leadership/{slug}', 'leadershipDetail')->name('leadership.detail');

    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{slug}', 'blogdetail')->name('blog.show');

    // Route::get('/vendors/registration', 'registration')->name('registration');

    Route::get('/inner-blog', 'innerBlog')->name('innerBlog');
    Route::get('/contact-us', 'contactUs')->name('contactUs');
    Route::post('/contact/send', 'emailsend')->name('contact.send');
    Route::get('/offplan', 'offplan')->name('offplan');
    Route::get('/developer-list', 'developerList')->name('developerList');
    Route::get('/location', 'location')->name('location');
    Route::get('/project-community', 'projectCommunity')->name('projectCommunity');
    Route::get('/service', 'service')->name('service');
    Route::get('/secondary-sale', 'secondarySale')->name('secondarySale');
    // Route::get('/property-details/{slug}', 'propertyDetails')->name('propertyDetails');
    Route::get('/new-articles', 'newArticles')->name('newArticles');
    Route::get('/community/{id}', 'community')->name('community');
    Route::get('/address-residence/{slug}', 'addressResidence')->name('addressResidence');
    Route::get('/payment-plan/{slug}', 'paymentPlan')->name('paymentPlan');
    Route::get('/location-map/{slug}', 'locationMap')->name('locationMap');
    Route::get('/master-plan/{slug}', 'masterPlan')->name('masterPlan');
    Route::get('/floor-plan/{slug}', 'floorPlan')->name('floorPlan');
    Route::get('/community-page/{id}', 'communityPage')->name('communityPage');
    Route::get('/developer-page/{id}', 'developerPage')->name('developerPage');
    Route::get('/term-condition', 'termCondition')->name('term-condition');
    Route::get('/privacy-policy', 'PrivacyPolicy')->name(name: 'privacy-policy');
    // Route::get('/offplan/search',  'filter')->name('offplan_search');
});

Route::get('/complain', [FrontendController::class, 'showForm'])->name('complaint.form');
Route::post('/complaint-submit', [FrontendController::class, 'submitForm'])->name('complaint.submit');
Route::get('/search/offplan', [FrontendController::class, 'filter'])->name('offplan_search');

Route::get('/visitor', [FrontendController::class, 'visitForm'])->name('visitor.form');
Route::post('/visitor-submit', [FrontendController::class, 'submitVisit'])->name('visitor.submit');

Route::get('/vendors/registration', [FrontendController::class, 'registration'])->name('registration.form');
Route::post('/vendors/registration-submit', [FrontendController::class, 'submitRegistration'])->name('registration.submit');

// Dashboard and Logout routes
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::get('/home', [AuthenticatedSessionController::class, 'home'])->name('home');
});

// Route::get('property/backfill-slugs', [AgentPropertyController::class, 'backfillSlugs'])->name('property.backfill-slugs');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
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
    Route::resource('blogs', BlogController::class);
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
