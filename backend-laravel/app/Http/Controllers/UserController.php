<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
        $users = User::with('educations')->paginate(100);
        return response()->json($users);
    }

    public function show($id)
    {
        $cacheKey = "user:{$id}:with_educations";
        $ttl = 60 * 60 * 24; // 24 hours

        if (Cache::has($cacheKey)) {
            // Data exists in Redis
            $user = Cache::get($cacheKey);
            Log::info("User {$id} retrieved from Redis cache.");
        } else {
            // Cache miss → query DB and store
            $user = User::with('educations')->findOrFail($id);
            Cache::put($cacheKey, $user, $ttl);
            Log::info("User {$id} retrieved from DB.");
        }

        return response()->json($user);
    }
}
