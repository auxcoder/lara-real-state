<?php

namespace App\Services;

use App\Models\Information;
use Illuminate\Support\Facades\Storage;

class VendorRegistrationService
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {}

    public function register(array $data, array $files): Information
    {
        $tradeLicensePath = $this->fileUploadService->uploadWithCustomName(
            $files['trade_license'],
            'uploads/trade_licenses',
            'trade_license'
        );

        $emiratesIdPath = $this->fileUploadService->uploadWithCustomName(
            $files['emirates_id'],
            'uploads/emirates_ids',
            'emirates_id'
        );

        $passportPath = $this->fileUploadService->uploadWithCustomName(
            $files['passport'],
            'uploads/passports',
            'passport'
        );

        $registration = new Information;
        $registration->fill($data);
        $registration->trade_license = $tradeLicensePath;
        $registration->emirates_id = $emiratesIdPath;
        $registration->passport = $passportPath;
        $registration->save();

        return $registration;
    }

    public function prepareEmailData(Information $registration): array
    {
        return [
            'name' => $registration->name,
            'email' => $registration->email,
            'phone_number' => $registration->phone_number,
            'contact_person_name' => $registration->contact_person_name,
            'office_address' => $registration->office_address,
            'bank_account_no' => $registration->bank_account_no,
            'iban_letter' => $registration->iban_letter,
            'vat_registration_no' => $registration->vat_registration_no,
            'trade_license_url' => Storage::url($registration->trade_license),
            'emirates_id_url' => Storage::url($registration->emirates_id),
            'passport_url' => Storage::url($registration->passport),
        ];
    }
}
