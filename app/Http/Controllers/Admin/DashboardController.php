<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentProperty;
use App\Models\Agents;
use App\Models\Blog;
use App\Models\Community;
use App\Models\Developer;
use App\Models\DeveloperProperty;
use App\Models\User;
use App\Models\VisitorSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_properties' => AgentProperty::count(),
            'total_developer_properties' => DeveloperProperty::count(),
            'total_agents' => Agents::count(),
            'total_developers' => Developer::count(),
            'total_communities' => Community::count(),
            'total_blogs' => Blog::count(),
            'total_users' => User::count(),
            'pending_visitors' => VisitorSubmission::whereDate('created_at', '>=', now()->subDays(7))->count(),
        ];

        $recentProperties = AgentProperty::with('agent')->latest()->take(5)->get();
        $recentBlogs = Blog::latest()->take(5)->get();
        
        $propertiesByType = AgentProperty::select('property_type', DB::raw('count(*) as count'))
            ->groupBy('property_type')
            ->get();

        $propertiesByStatus = AgentProperty::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // New: Latest properties with details
        $latestProperties = AgentProperty::with(['agent', 'translations'])
            ->latest()
            ->take(10)
            ->get();

        // New: Properties by location (state/province)
        $propertiesByLocation = AgentProperty::select('location', DB::raw('count(*) as count'))
            ->groupBy('location')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        return view('admin.dashboards', compact(
            'stats', 
            'recentProperties', 
            'recentBlogs', 
            'propertiesByType', 
            'propertiesByStatus',
            'latestProperties',
            'propertiesByLocation'
        ));
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('message', 'You have been successfully logged out.');
        return redirect()->route('login');
    }
}


