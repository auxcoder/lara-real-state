<?php

namespace App\Services;

use App\Models\VisitorSubmission;

class VisitorSubmissionService
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {}

    public function submit(array $data, array $files): VisitorSubmission
    {
        $budgetRanges = config('visitor.budget_ranges', []);

        $submission = new VisitorSubmission;
        $submission->name = $data['name'];
        $submission->email = $data['email'];
        $submission->phone_number = $data['phone_number'];
        $submission->nationality = $data['nationality'];
        $submission->property_type = $data['property_type'] ?? null;
        $submission->specifications = $data['specifications'] ?? null;
        $submission->preferred_location = $data['preferred_location'] ?? null;
        $submission->budget_range = isset($data['budget_range']) ? $budgetRanges[$data['budget_range']] : null;
        $submission->payment_for_rent = $data['payment_for_rent'];
        $submission->number_of_family_members = $data['number_of_family_members'] ?? null;

        $submission->passport_pdf = $this->fileUploadService->uploadPdf($files['passport'], 'passport');
        $submission->emirates_id_pdf = $this->fileUploadService->uploadPdf($files['emirates_id'], 'emirates_id');
        $submission->bank_statement_pdf = $this->fileUploadService->uploadPdf($files['bank_statement'], 'bank_statement');
        $submission->trade_license_pdf = isset($files['trade_license']) ? $this->fileUploadService->uploadPdf($files['trade_license'], 'trade_license') : null;
        $submission->vat_registration_certificate_pdf = isset($files['vat_registration_certificate']) ? $this->fileUploadService->uploadPdf($files['vat_registration_certificate'], 'vat_registration_certificate') : null;
        $submission->etihad_credit_bureau_pdf = isset($files['etihad_credit_bureau']) ? $this->fileUploadService->uploadPdf($files['etihad_credit_bureau'], 'etihad_credit_bureau') : null;

        $submission->save();

        return $submission;
    }

    public function prepareEmailData(VisitorSubmission $submission): array
    {
        return [
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
    }
}
