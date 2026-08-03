<?php

namespace App\Filament\Widgets;

use App\Models\Campaign;
use App\Models\Creator;
use App\Models\Lead;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = -3;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $leadsBaru = Lead::where(fn ($q) => $q->where('status', 'baru')->orWhereNull('status'))->count();
        $creatorAktif = Creator::where('is_active', true)->count();
        $campaignAktif = Campaign::active()->count();
        $campaignSoon = Campaign::active()
            ->whereNotNull('ends_at')
            ->whereDate('ends_at', '<=', now()->addDays(7))->count();
        $artikel = Post::where('is_published', true)->count();

        return [
            Stat::make('Lead Belum Ditangani', $leadsBaru)
                ->description($leadsBaru > 0 ? 'Perlu ditindaklanjuti' : 'Semua tertangani')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color($leadsBaru > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.leads.index')),

            Stat::make('Creator Aktif', $creatorAktif)
                ->description('Tampil di katalog')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->url(route('filament.admin.resources.creators.index')),

            Stat::make('Campaign Aktif', $campaignAktif)
                ->description($campaignSoon > 0 ? $campaignSoon . ' berakhir ≤ 7 hari' : 'Semua masih lama')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color($campaignSoon > 0 ? 'danger' : 'success')
                ->url(route('filament.admin.resources.campaigns.index')),

            Stat::make('Artikel Terbit', $artikel)
                ->description('Di blog')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('gray')
                ->url(route('filament.admin.resources.posts.index')),
        ];
    }
}
