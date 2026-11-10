<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuPublicationLog;
use App\Models\SppgProfile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        // Statistik menu
        $totalMenus = Menu::count();

        $publishedMenus = Menu::where('status', 'published')->count();

        $draftMenus = Menu::whereIn('status', [
            'draft',
            'scheduled',
        ])->count();

        $publicationPercentage = $totalMenus > 0
            ? round(($publishedMenus / $totalMenus) * 100, 1)
            : 0;

        // Menu yang berlaku hari ini
        $todayMenu = Menu::with([
            'sppg',
            'portions.nutrition',
            'portions.foodComponents',
        ])
            ->whereDate('serving_date', now()->toDateString())
            ->first();

        // Aktivitas admin terbaru
        $recentActivities = MenuPublicationLog::with('user')
            ->latest('created_at')
            ->limit(5)
            ->get();

        // Profil SPPG aktif
        $sppgProfile = SppgProfile::where('is_active', true)
            ->first();

        return Inertia::render('Dashboard', [
            'statistics' => [
                'total_menus' => $totalMenus,
                'published_menus' => $publishedMenus,
                'draft_menus' => $draftMenus,
                'publication_percentage' => $publicationPercentage,
            ],

            'todayMenu' => $todayMenu,

            'recentActivities' => $recentActivities,

            'sppgProfile' => $sppgProfile,
        ]);
    }
}
