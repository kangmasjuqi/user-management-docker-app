<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserEducation;

class UserController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'gender_distribution' => User::selectRaw('gender, count(*) as count')
                ->groupBy('gender')
                ->get(),
            'education_levels' => UserEducation::selectRaw('level, count(*) as count')
                ->groupBy('level')
                ->get(),
            'recent_registrations' => User::where('created_at', '>=', now()->subDays(30))->count(),
        ];

        return response()->json($stats);
    }

    public function index()
    {
        $users = User::with('educations')->paginate(10);
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::with('educations')->findOrFail($id);
        return response()->json($user);
    }
}