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
use App\Models\Information;
use App\Models\VisitorSubmission;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
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
        $validated = $request->validated();

        $tradeLicensePath = $request->file('trade_license')->storeAs(
            'uploads/trade_licenses',
            'trade_license_'.time().'.'.$request->file('trade_license')->extension(),
            'public'
        );

        $emiratesIdPath = $request->file('emirates_id')->storeAs(
            'uploads/emirates_ids',
            'emirates_id_'.time().'.'.$request->file('emirates_id')->extension(),
            'public'
        );

        $passportPath = $request->file('passport')->storeAs(
            'uploads/passports',
            'passport_'.time().'.'.$request->file('passport')->extension(),
            'public'
        );

        $registration = new Information;
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
        $validated = $request->validated();
        $budgetRanges = config('visitor.budget_ranges', []);

        $storePdf = function ($file, $dir) {
            if (! $file) {
                return null;
            }
            $name = $dir.'_'.time().'_'.uniqid().'.pdf';

            return $file->storeAs('visitor_uploads/'.$dir, $name, 'public');
        };

        $passportPath = $storePdf($request->file('passport'), 'passport');
        $emiratesIdPath = $storePdf($request->file('emirates_id'), 'emirates_id');
        $bankStatementPath = $storePdf($request->file('bank_statement'), 'bank_statement');
        $tradeLicensePath = $storePdf($request->file('trade_license'), 'trade_license');
        $vatCertPath = $storePdf($request->file('vat_registration_certificate'), 'vat_registration_certificate');
        $ecbPath = $storePdf($request->file('etihad_credit_bureau'), 'etihad_credit_bureau');

        $submission = new VisitorSubmission;
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

