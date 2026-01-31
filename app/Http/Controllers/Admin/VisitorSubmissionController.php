<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorSubmission;
use Illuminate\Http\Request;

class VisitorSubmissionController extends Controller
{
    public function index()
    {
        $this->authorize('view visitor submissions');
        
        $submissions = VisitorSubmission::latest()->paginate(20);
        return view('admin.visitor_submissions.index', compact('submissions'));
    }

    public function show(VisitorSubmission $visitor_submission)
    {
        $this->authorize('view visitor submissions');
        
        return view('admin.visitor_submissions.show', [
            'submission' => $visitor_submission,
        ]);
    }

    public function destroy(VisitorSubmission $visitor_submission)
    {
        $this->authorize('delete visitor submissions');
        
        $visitor_submission->delete();
        return redirect()->route('visitor-submissions.index')->with('success', 'Submission deleted');
    }
}

