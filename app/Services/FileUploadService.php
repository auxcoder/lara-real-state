<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileUploadService
{
    public function uploadImage(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, 'public');
    }

    public function uploadWithCustomName(UploadedFile $file, string $directory, string $prefix): string
    {
        $filename = $prefix.'_'.time().'.'.$file->extension();
        return $file->storeAs($directory, $filename, 'public');
    }

    public function uploadPdf(UploadedFile $file, string $directory): string
    {
        $filename = $directory.'_'.time().'_'.uniqid().'.pdf';
        return $file->storeAs('visitor_uploads/'.$directory, $filename, 'public');
    }
}
