<?php

namespace App\Http\Controllers;

use App\Mail\ComplaintMail;
use App\Mail\ContactForm;
use App\Mail\VisitorMail;
use App\Mail\VendorRegistrationMail;
use App\Models\AgentProperty;
use App\Models\Community;
use App\Models\Developer;
use App\Models\DeveloperProperty;
use App\Models\FloorPlan;
use App\Models\Information;
use App\Models\Location;
use App\Models\MasterPlan;
use App\Models\Product;
use App\Models\Blog;
use App\Models\TeamMember;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function showForm()
    {
        return view('frontend.complaint');
    }

    public function registration()
    {
        return view('frontend.registration');
    }

    /**
     * Handle form submission and send email.
     */
    public function submitForm(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email',
            'building_villa' => 'required|string|max:255',
            'flat_no' => 'required|string|max:50',
            'complaints' => 'required|array',
            'complaint_details' => 'required|string',
            'suggestion' => 'nullable|string',
            // 'email_flat_tenant' => 'sometimes|boolean',
        ]);

        // Prepare data for the email
        $data = [
            'full_name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'building_villa' => $validated['building_villa'],
            'flat_no' => $validated['flat_no'],
            'complaints' => $validated['complaints'],
            // 'email_flat_tenant' => isset($validated['email_flat_tenant']) ? 'Yes' : 'No',
            'complaint_details' => $validated['complaint_details'],
            'suggestion' => $validated['suggestion'] ?? 'N/A',
        ];

        try {
            // Simple check: Ensure mailer host is set
            Mail::to('info@thehr.ae')->send(new ComplaintMail($data));
            // if (Config::get('mail.mailers.smtp.host') && Config::get('mail.mailers.smtp.username')) {
            // } else {
            //     Log::warning('SMTP configuration not available. Email not sent.');
            // }
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
        }
        // Redirect back with success message
        return redirect()->back()->with('success', 'Your complaint has been submitted successfully.');
    }

    public function submitRegistration(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:information,email',
            'phone_number' => 'required|string|max:20',
            'trade_license' => 'required|image|mimes:jpg,png|max:10240',
            'emirates_id' => 'required|image|mimes:jpg,png|max:10240',
            'passport' => 'required|image|mimes:jpg,png|max:10240',
            'bank_account_no' => 'required|numeric',
            'iban_letter' => 'required|string|max:255',
            'vat_registration_no' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'office_address' => 'required|string|max:500',
        ]);
        // dd($validated);

        // File uploads
        $tradeLicensePath = $request->file('trade_license')->storeAs(
            'uploads/trade_licenses',
            'trade_license_' . time() . '.' . $request->file('trade_license')->extension(),
            'public'
        );

        $emiratesIdPath = $request->file('emirates_id')->storeAs(
            'uploads/emirates_ids',
            'emirates_id_' . time() . '.' . $request->file('emirates_id')->extension(),
            'public'
        );

        $passportPath = $request->file('passport')->storeAs(
            'uploads/passports',
            'passport_' . time() . '.' . $request->file('passport')->extension(),
            'public'
        );

        // Database Insertion
        $registration = new Information();
        $registration->name = $validated['name'];
        $registration->email = $validated['email'];
        $registration->phone_number = $validated['phone_number'];
        $registration->trade_license = $tradeLicensePath;
        $registration->emirates_id = $emiratesIdPath;
        $registration->passport = $passportPath;
        $registration->bank_account_no = $validated['bank_account_no'];
        $registration->iban_letter = $validated['iban_letter'];
        $registration->vat_registration_no = $validated['vat_registration_no'];
        $registration->contact_person_name = $validated['contact_person_name'];
        $registration->office_address = $validated['office_address'];
        $registration->save();

        $emailData = [
            'name' => $registration->name,
            'email' => $registration->email,
            'phone_number' => $registration->phone_number,
            'contact_person_name' => $registration->contact_person_name,
            'office_address' => $registration->office_address,
            'bank_account_no' => $registration->bank_account_no,
            'iban_letter' => $registration->iban_letter,
            'vat_registration_no' => $registration->vat_registration_no,
            'trade_license_url' => $tradeLicensePath ? Storage::url($tradeLicensePath) : null,
            'emirates_id_url' => $emiratesIdPath ? Storage::url($emiratesIdPath) : null,
            'passport_url' => $passportPath ? Storage::url($passportPath) : null,
        ];

        try {
            Mail::to('info@thehr.ae')->send(new VendorRegistrationMail($emailData));
            // if (Config::get('mail.mailers.smtp.host') && Config::get('mail.mailers.smtp.username')) {
            // } else {
            //     Log::warning('Vendor registration email skipped because SMTP settings are incomplete.');
            // }
        } catch (\Exception $e) {
            Log::error('Failed to send vendor registration email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Registration submitted successfully.');
    }

    public function visitForm()
    {
        return view('frontend.visitor', [
            'nationalities' => config('visitor.nationalities', []),
            'budgetRanges' => config('visitor.budget_ranges', []),
        ]);
    }

    public function submitVisit(Request $request)
    {
        $nationalities = config('visitor.nationalities', []);
        $budgetRanges = config('visitor.budget_ranges', []);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            // allow country code characters: +, digits, spaces, hyphens, parentheses
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[+0-9\s()\-]{7,20}$/'],
            'nationality' => ['required', 'string', 'max:255', Rule::in($nationalities)],

            // Existing optional fields
            'property_type' => 'nullable|string',
            'specifications' => 'nullable|string',
            'preferred_location' => 'nullable|string',
            'budget_range' => ['nullable', 'string', Rule::in(array_keys($budgetRanges))],

            // Rent-specific fields
            'payment_for_rent' => 'required|in:Personal,Company',
            'number_of_family_members' => 'nullable|integer|min:0',

            // Files: PDFs only, 100 MB (102400 KB)
            'passport' => 'required|file|mimes:pdf|max:102400',
            'emirates_id' => 'required|file|mimes:pdf|max:102400',
            'bank_statement' => 'required|file|mimes:pdf|max:102400',
            'trade_license' => 'nullable|file|mimes:pdf|max:102400',
            'vat_registration_certificate' => 'nullable|file|mimes:pdf|max:102400',
            'etihad_credit_bureau' => 'nullable|file|mimes:pdf|max:102400',
        ]);

        // Store files
        $storePdf = function ($file, $dir) {
            if (!$file) {
                return null;
            }
            $name = $dir . '_' . time() . '_' . uniqid() . '.pdf';
            return $file->storeAs('visitor_uploads/' . $dir, $name, 'public');
        };

        $passportPath = $storePdf($request->file('passport'), 'passport');
        $emiratesIdPath = $storePdf($request->file('emirates_id'), 'emirates_id');
        $bankStatementPath = $storePdf($request->file('bank_statement'), 'bank_statement');
        $tradeLicensePath = $storePdf($request->file('trade_license'), 'trade_license');
        $vatCertPath = $storePdf($request->file('vat_registration_certificate'), 'vat_registration_certificate');
        $ecbPath = $storePdf($request->file('etihad_credit_bureau'), 'etihad_credit_bureau');

        // Persist to DB
        $submission = new \App\Models\VisitorSubmission();
        $submission->name = $validated['name'];
        $submission->email = $validated['email'];
        $submission->phone_number = $validated['phone_number'];
        $submission->nationality = $validated['nationality'];
        $submission->property_type = $validated['property_type'] ?? null;
        $submission->specifications = $validated['specifications'] ?? null;
        $submission->preferred_location = $validated['preferred_location'] ?? null;
        $selectedBudgetRange = $validated['budget_range'] ?? null;
        $submission->budget_range = $selectedBudgetRange ? $budgetRanges[$selectedBudgetRange] : null;
        $submission->payment_for_rent = $validated['payment_for_rent'];
        $submission->number_of_family_members = $validated['number_of_family_members'] ?? null;
        $submission->passport_pdf = $passportPath;
        $submission->emirates_id_pdf = $emiratesIdPath;
        $submission->bank_statement_pdf = $bankStatementPath;
        $submission->trade_license_pdf = $tradeLicensePath;
        $submission->vat_registration_certificate_pdf = $vatCertPath;
        $submission->etihad_credit_bureau_pdf = $ecbPath;
        $submission->save();

        // Prepare data for email (no large attachments, provide links)
        $data = [
            'name' => $submission->name,
            'phone_number' => $submission->phone_number,
            'email' => $submission->email,
            'nationality' => $submission->nationality,
            'property_type' => $submission->property_type,
            'specifications' => $submission->specifications,
            'preferred_location' => $submission->preferred_location,
            'budget_range' => $submission->budget_range,
            'payment_for_rent' => $submission->payment_for_rent,
            'number_of_family_members' => $submission->number_of_family_members,
            'passport_pdf' => $submission->passport_pdf,
            'emirates_id_pdf' => $submission->emirates_id_pdf,
            'bank_statement_pdf' => $submission->bank_statement_pdf,
            'trade_license_pdf' => $submission->trade_license_pdf,
            'vat_registration_certificate_pdf' => $submission->vat_registration_certificate_pdf,
            'etihad_credit_bureau_pdf' => $submission->etihad_credit_bureau_pdf,
        ];

        Mail::to('info@thehr.ae')->send(new VisitorMail($data));

        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }

    public function index()
    {
        $developer_properties = DeveloperProperty::latest()->take(3)->get();

        return view('frontend.index', compact('developer_properties'));
    }

    public function projects($slug)
    {
        $property = AgentProperty::with('propertygallery')->where('slug', $slug)->firstOrFail();
        return view('frontend.devPropertyDetails', compact('property'));
    }

    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function leadership()
    {
        $teammembers = TeamMember::all();
        return view('frontend.leadership', compact("teammembers"));
    }

    public function leadershipDetail(string $slug)
    {
        $teammember = TeamMember::where('slug', $slug)->firstorfail();
        return view('frontend.leadershipDetail', compact("teammember"));
    }

    // public function blog()
    // {
    //     $currentLang = session('locale');

    //     $query = Blog::orderBy('created_at', 'desc');

    //     switch ($currentLang) {
    //         case 'ar':
    //             $query->where('target_audience', 'UAE');
    //             break;
    //         default:
    //             $query->where('target_audience', 'International');
    //             break;
    //     }

    //     $data['blogs'] = $query->paginate(10);

    //     return view('frontend.blog', $data);
    // }

    public function blog()
    {
        $locale = session('locale');

        $blogs = Blog::with([
            'translations' => function ($q) use ($locale) {
                $q->where('locale', $locale);
            }
        ])->latest()->paginate(9);

        return view('frontend.blog', compact('blogs'));
    }

    public function blogdetail($slug)
    {
        $data["blog"] = Blog::where("slug", $slug)->firstOrFail();
        // whereHas('translations', function ($query) use ($slug) {
        //     $query->where('slug', $slug);
        // })->firstOrFail();
        $data['blogs'] = Blog::get();
        $data['developer_property'] = DeveloperProperty::first();
        return view('frontend.blog-detail', $data);
    }


    public function innerBlog()
    {
        // $data['blog'] = Blog::find($id);
        $data['blogs'] = Blog::get();
        // $developer_properties = DeveloperProperty::latest()->take(3)->get();
        $data['developer_property'] = DeveloperProperty::first();
        return view('frontend.blog-detail', $data);
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function emailsend(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|string',
        ]);

        // Email send
        try {
            // Simple check: Ensure mailer host is set
            if (Config::get('mail.mailers.smtp.host') && Config::get('mail.mailers.smtp.username')) {
                Mail::to('infor@thehr.ae')->send(new ContactForm($request->all()));
            } else {
                Log::warning('SMTP configuration not available. Email not sent.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
        }
        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function faqs()
    {
        return view('frontend.faqs');
    }

    public function offplan(Request $request)
    {
        // Fetch communities, developer properties, and developers
        $communities = Community::all();
        $developer_property = DeveloperProperty::all();
        $developers = Developer::all();

        Log::info('Request Parameters: ', $request->all());

        // Paginate developer properties
        $properties = DeveloperProperty::paginate(5);

        // dd($minPrice, $maxPrice);  // For debugging
        // Return filtered data to the view
        return view('frontend.offplan', compact('properties', 'communities', 'developer_property', 'developers'));
    }

    public function developerList()
    {
        $developers = Developer::get();
        return view('frontend.developer_list', compact('developers'));
    }

    public function location()
    {
        return view('frontend.location');
    }

    public function projectCommunity()
    {
        $comunities = Community::get();
        $totalcomunities = Community::count();
        return view('frontend.community', compact('comunities', 'totalcomunities'));
    }

    public function service()
    {
        $developer_property = DeveloperProperty::get();
        return view('frontend.service', compact('developer_property'));
    }

    public function secondarySale()
    {
        $properties = AgentProperty::paginate(5);
        return view('frontend.secondary_properties_sale', compact('properties'));
    }

    public function newArticles()
    {
        return view('frontend.new_articles');
    }

    public function propertyDetails($slug)
    {
        $property = AgentProperty::where('slug', $slug)->firstOrFail();
        return view('frontend.property_details', compact('property'));
    }

    public function addressResidence($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();
        return view('frontend.address_residence', compact('developer_property'));
    }

    public function paymentPlan($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();
        return view('frontend.payment_plan', compact('developer_property'));
    }

    public function locationMap($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();
        return view('frontend.location_map', compact('developer_property'));
    }

    public function masterPlan($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();
        return view('frontend.master_plan', compact('developer_property'));
    }

    public function floorPlan($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();
        return view('frontend.floor_plan', compact('developer_property'));
    }

    public function communityPage($id)
    {
        $community = Community::with('amenities')->findOrFail($id);
        return view('frontend.communityPage', compact('community'));
    }

    public function developerPage($id)
    {
        $developers = Developer::with('developersProperties')->findOrFail($id);
        Log::info($developers->developersProperties()->toSql());

        return view('frontend.developerPage', compact('developers'));
    }

    public function termCondition()
    {
        return view('frontend.term_condition');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy');
    }


    public function filter(Request $request)
    {
        $validated = $request->validate([
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
            'status' => 'nullable|string',
            'sort' => 'nullable|string',
            'field3' => 'nullable|string',
        ]);

        // Base query
        $query = DeveloperProperty::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('field3')) {
            $query->where('name', 'LIKE', '%' . $request->input('field3') . '%');
        }

        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_high_to_low':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_low_to_high':
                    $query->orderBy('price', 'asc');
                    break;
            }
        }

        $properties = $query->paginate(20)->appends($request->except('page'));
        $communities = Community::all();
        $developers = Developer::all();
        $search = $request->input('field3');

        return view('frontend.offplan', compact('properties', 'search', 'communities', 'developers'));
    }

    public function showPropertiesByLocation(Request $request, $location)
    {
        // dd($request->all(), $location);
        $request->validate([
            'city' => ['nullable', 'string', Rule::in(['Dubai', 'Abu Dhabi', 'Sharjah', 'Al Ain', 'Fujairah', 'Ras Al Khaimah'])],
            'community' => ['nullable', 'string', Rule::in(['Dubai', 'Abu Dhabi', 'Sharjah', 'Al Ain', 'Fujairah', 'Ras Al Khaimah'])],
            'property_type' => ['nullable', 'string', Rule::in(['Residential', 'Commercial', 'Off-Plan', 'Mall', 'Villa'])],
            'status' => ['nullable', 'string', Rule::in(['sold', 'available'])],
        ]);

        $allowedLocations = ['Dubai', 'Abu Dhabi', 'Sharjah', 'Al Ain', 'Fujairah', 'Ras Al Khaimah'];
        $allowedTypes = ['Residential', 'Commercial', 'Off-Plan', 'Mall', 'Villa'];

        $allowedAll = array_merge($allowedLocations, $allowedTypes);

        validator(
            ['location' => $location],
            ['location' => ['required', Rule::in($allowedAll)]]
        )->validate();

        $bannerImages = [
            'Residential' => 'about/residential project banner.jpg',
            'Commercial' => 'about/commercial project banner.jpg',
            'Mall' => 'about/mall project banner.jpg',
        ];
        $type = $request->query('property_type'); // e.g. “Residential”
        $status = $request->query('status'); // e.g. “Residential”
        $community = $request->query('community');
        // $communities = Community::all();
        // $developers = Developer::all();

        $query = AgentProperty::query();
        $currentLang = session('locale');
        if ($status) {
            $query->where('status', $status);
        }

        if ($type || $community) {
            // If both are provided
            if ($type && $community) {
                $query->where('property_type', $type)
                    ->where('location', $community);
                $locationName = __("head_$type");
            } elseif ($type) {
                // If only type is provided
                $query->where('property_type', $type);
                $locationName = __("head_$type");
            } elseif ($community) {
                // If only community is provided
                $query->where('location', $community);
                $locationName = __($community);
            }
        } elseif ($location) {
            if (in_array($location, $allowedLocations)) {
                $query->where('location', $location);
                $locationName = __("$location");
            } elseif (in_array($location, $allowedTypes)) {
                $query->where('property_type', $location);
                $locationName = __("head_$location");
            } else {
                abort(404, 'Location or Property Type not found.');
            }
        } else {
            abort(404, 'Location or Property Type not found.');
        }

        // Sorting logic
        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_high_to_low':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_low_to_high':
                    $query->orderBy('price', 'asc');
                    break;
            }
        }

        $properties = $query->get();
        // dd($properties);

        if ($type) {
            $bannerImage = $bannerImages[$type] ?? 'property-details/bg.png';
        } elseif ($location) {
            $bannerImage = $bannerImages[$location] ?? 'property-details/bg.png';
            // dd($bannerImage);
        } else {
            $bannerImage = 'property-details/bg.png';
        }

        return view('frontend.offplan', compact(
            'properties',
            // 'communities',
            // 'developers',
            'location',
            'locationName',
            'bannerImage'
        ));
    }
}
