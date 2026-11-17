<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $projects = Project::query()
            ->when($user->role?->value === 'client', fn ($q) => $q->where('client_user_id', $user->id))
            ->latest()
            ->limit(20)
            ->get();

        return view('portal.index', [
            'projects' => $projects,
            'accent' => config('jobcosting.accent'),
            'user' => $user,
        ]);
    }
}