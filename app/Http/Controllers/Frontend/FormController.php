<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\VendorRegistrationRequest;
use App\Http\Requests\VisitorSubmissionRequest;
use App\Mail\ComplaintMail;
use App\Mail\ContactForm;
use App\Mail\VendorRegistrationMail;
use App\Mail\VisitorMail;
use App\Services\VendorRegistrationService;
use App\Services\VisitorSubmissionService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function __construct(
        private VendorRegistrationService $vendorService,
        private VisitorSubmissionService $visitorService
    ) {}
    public function showComplaint()
    {
        return view('frontend.complaint');
    }

    public function submitComplaint(ComplaintRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'full_name' => $validated['first_name'].' '.$validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'building_villa' => $validated['building_villa'],
            'flat_no' => $validated['flat_no'],
            'complaints' => $validated['complaints'],
            'complaint_details' => $validated['complaint_details'],
            'suggestion' => $validated['suggestion'] ?? 'N/A',
        ];

        try {
            Mail::to('info@thehr.ae')->send(new ComplaintMail($data));
        } catch (\Exception $e) {
            Log::error('Failed to send email: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Your complaint has been submitted successfully.');
    }

    public function showRegistration()
    {
        return view('frontend.registration');
    }

    public function submitRegistration(VendorRegistrationRequest $request)
    {
        $registration = $this->vendorService->register(
            $request->validated(),
            $request->only(['trade_license', 'emirates_id', 'passport'])
        );

        $emailData = $this->vendorService->prepareEmailData($registration);

        try {
            Mail::to('info@thehr.ae')->send(new VendorRegistrationMail($emailData));
        } catch (\Exception $e) {
            Log::error('Failed to send vendor registration email: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Registration submitted successfully.');
    }

    public function showVisitor()
    {
        return view('frontend.visitor', [
            'nationalities' => config('visitor.nationalities', []),
            'budgetRanges' => config('visitor.budget_ranges', []),
        ]);
    }

    public function submitVisitor(VisitorSubmissionRequest $request)
    {
        $submission = $this->visitorService->submit(
            $request->validated(),
            $request->only(['passport', 'emirates_id', 'bank_statement', 'trade_license', 'vat_registration_certificate', 'etihad_credit_bureau'])
        );

        $data = $this->visitorService->prepareEmailData($submission);

        Mail::to('info@thehr.ae')->send(new VisitorMail($data));

        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }

    public function sendContact(ContactRequest $request)
    {
        try {
            if (Config::get('mail.mailers.smtp.host') && Config::get('mail.mailers.smtp.username')) {
                Mail::to('infor@thehr.ae')->send(new ContactForm($request->all()));
            } else {
                Log::warning('SMTP configuration not available. Email not sent.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to send email: '.$e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully!');
    }
}

