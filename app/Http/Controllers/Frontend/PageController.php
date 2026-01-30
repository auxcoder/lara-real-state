<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Developer;
use App\Models\DeveloperProperty;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function leadership()
    {
        $teammembers = TeamMember::all();

        return view('frontend.leadership', compact('teammembers'));
    }

    public function leadershipDetail(string $slug)
    {
        $teammember = TeamMember::where('slug', $slug)->firstOrFail();

        return view('frontend.leadershipDetail', compact('teammember'));
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function faqs()
    {
        return view('frontend.faqs');
    }

    public function service()
    {
        $developer_property = DeveloperProperty::get();

        return view('frontend.service', compact('developer_property'));
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy');
    }

    public function termCondition()
    {
        return view('frontend.term_condition');
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

    public function developerList()
    {
        $developers = Developer::get();

        return view('frontend.developer_list', compact('developers'));
    }

    public function developerPage($id)
    {
        $developers = Developer::with('developersProperties')->findOrFail($id);
        Log::info($developers->developersProperties()->toSql());

        return view('frontend.developerPage', compact('developers'));
    }

    public function communityPage($id)
    {
        $community = Community::with('amenities')->findOrFail($id);

        return view('frontend.communityPage', compact('community'));
    }
}
