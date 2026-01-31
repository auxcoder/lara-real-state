<?php

namespace App\Services;

use App\Models\AgentProperty;
use App\Models\PropertyGalleryImages;

class AgentPropertyService
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {}

    public function create(array $data, $mainImage, array $galleryImages = []): AgentProperty
    {
        $property = new AgentProperty;
        $property->fill($data);
        
        if ($mainImage) {
            $property->main_image = $this->fileUploadService->uploadImage($mainImage, 'properties');
        }
        
        $property->save();

        $this->saveTranslations($property, $data['title'], $data['description'] ?? []);
        $this->saveGalleryImages($property, $galleryImages);

        return $property;
    }

    public function update(AgentProperty $property, array $data, $mainImage = null, array $galleryImages = []): AgentProperty
    {
        $property->fill($data);
        
        if ($mainImage) {
            $property->main_image = $this->fileUploadService->uploadImage($mainImage, 'properties');
        }
        
        $property->save();

        $property->translations()->delete();
        $this->saveTranslations($property, $data['title'], $data['description'] ?? []);
        
        if (!empty($galleryImages)) {
            $this->saveGalleryImages($property, $galleryImages);
        }

        return $property;
    }

    private function saveTranslations(AgentProperty $property, array $titles, array $descriptions): void
    {
        $locales = ['en', 'ar'];
        
        foreach ($locales as $locale) {
            $property->translations()->create([
                'locale' => $locale,
                'title' => $titles[$locale] ?? '',
                'description' => $descriptions[$locale] ?? '',
            ]);
        }
    }

    private function saveGalleryImages(AgentProperty $property, array $images): void
    {
        foreach ($images as $image) {
            PropertyGalleryImages::create([
                'property_id' => $property->id,
                'image' => $this->fileUploadService->uploadImage($image, 'gallery'),
            ]);
        }
    }
}
