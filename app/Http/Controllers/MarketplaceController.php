<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Creator;

class MarketplaceController extends Controller
{
    public function campaign(Campaign $campaign)
    {
        abort_unless($campaign->is_live, 404);

        $related = Campaign::active()
            ->where('id', '!=', $campaign->id)
            ->latest()->take(3)->get();

        return view('pages.campaign-show', compact('campaign', 'related'));
    }

    public function index()
    {
        $creators = Creator::where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderByDesc('followers')
            ->get();

        $featured = $creators->where('is_featured', true)->take(3)->values();
        if ($featured->count() < 3) {
            $featured = $creators->take(3)->values();
        }

        $categories = $creators->pluck('category')->unique()->sort()->values();
        $platforms  = $creators->pluck('platform')->unique()->sort()->values();
        $tiers      = ['Micro', 'Mid', 'Macro', 'Mega'];

        return view('pages.creator', compact('creators', 'featured', 'categories', 'platforms', 'tiers'));
    }

    public function campaigns()
    {
        $all = Campaign::active()->orderByDesc('is_featured')->latest()->get();

        // Campaign sorotan (top) — utamakan yang di-set is_featured, else yang termahal
        $featured = $all->firstWhere('is_featured', true) ?? $all->first();
        $campaigns = $all->reject(fn ($c) => $featured && $c->id === $featured->id)->values();

        // Unit/pemilik campaign untuk filter (VOBI MCN, SEAMEDIA, dll)
        $units = $all->pluck('creator_name')->filter()->unique()->values();
        $cats = $all->pluck('category')->unique()->sort()->values();

        return view('pages.campaign-index', compact('campaigns', 'featured', 'units', 'cats'));
    }
}
