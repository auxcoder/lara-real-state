<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;

class VendorRegistrationController extends Controller
{
    public function index()
    {
        $this->authorize('view vendor registrations');
        
        $registrations = Information::latest()->paginate(20);
        return view('admin.vendor_registrations.index', compact('registrations'));
    }

    public function show(Information $vendor_registration)
    {
        $this->authorize('view vendor registrations');
        
        return view('admin.vendor_registrations.show', [
            'registration' => $vendor_registration,
        ]);
    }
}
