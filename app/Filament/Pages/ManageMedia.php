<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\SettingsPage;
use Filament\Forms;
use Filament\Forms\Components\Section;

class ManageMedia extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Tampilan Situs';
    protected static ?string $navigationLabel = 'Gambar & Video';
    protected static ?string $title = 'Ganti Gambar & Video Website';
    protected static ?int $navigationSort = 6;

    /**
     * Definisi media per grup: [group => [ [role, label, isVideo], ... ]].
     * role = penanda gambar/video yang dipakai di template (data-bg / data-vid).
     */
    private function media(): array
    {
        return [
            'Hero (Beranda)' => [
                ['hero', 'Video background hero', true],
                ['hero-poster', 'Poster hero (gambar cadangan video)', false],
            ],
            'Ekosistem / 4 Pilar' => [
                ['eco1', 'Pilar 1 / VOBI (juga Layanan MCN)', false],
                ['eco2', 'Pilar 2 / Victory Media', false],
                ['eco3', 'Pilar 3 / Upmedia', false],
                ['eco4', 'Cadangan ekosistem', false],
                ['vobi-content', 'Konten / SEAMEDIA', false],
                ['vobi-web', 'Conversion Web', false],
            ],
            'Success Stories (Beranda)' => [
                ['succ1', 'Success 1', false],
                ['blog1', 'Success 2 / Blog 1', false],
                ['blog3', 'Success 3 / Blog 3', false],
                ['succ4', 'Success 4', false],
            ],
            'Testimonial & Performance' => [
                ['test', 'Foto testimonial', false],
                ['vobi-beauty', 'Gambar kategori produk (Performance)', false],
            ],
            'Blog & Creator' => [
                ['blog2', 'Blog 2', false],
                ['avatar', 'Avatar default creator (bila belum upload)', false],
            ],
            'Lainnya' => [
                ['succ2', 'Cadangan 1', false],
                ['succ3', 'Live Streaming Service (kartu hero)', false],
                ['story', 'Gambar story / cara gabung', false],
                ['vobi-team', 'Foto tim', false],
                ['vobi-event', 'Foto event', false],
                ['vobi-event2', 'Foto event 2', false],
                ['vobi-palette', 'Palette / mood', false],
                ['card1', 'Video kartu 1 (cadangan)', true],
                ['card2', 'Video kartu 2 (cadangan)', true],
                ['card3', 'Video kartu 3 (cadangan)', true],
            ],
        ];
    }

    protected function keys(): array
    {
        $keys = [];
        foreach ($this->media() as $items) {
            foreach ($items as [$role, , $isVideo]) {
                $keys[] = ($isVideo ? 'media_vid_' : 'media_img_') . $role;
            }
        }

        return $keys;
    }

    protected function formSchema(): array
    {
        $sections = [];
        foreach ($this->media() as $group => $items) {
            $fields = [];
            foreach ($items as [$role, $label, $isVideo]) {
                $key = ($isVideo ? 'media_vid_' : 'media_img_') . $role;
                $upload = Forms\Components\FileUpload::make($key)
                    ->label($label)
                    ->directory('media')
                    ->disk('public')
                    ->downloadable();

                if ($isVideo) {
                    $upload->acceptedFileTypes(['video/mp4', 'video/webm'])
                        ->helperText('Format MP4/WebM. Kosongkan = pakai video bawaan.');
                } else {
                    $upload->image()->imageEditor()
                        ->helperText('Kosongkan = pakai gambar bawaan.');
                }

                $fields[] = $upload;
            }
            $sections[] = Section::make($group)->columns(2)->schema($fields)->collapsible();
        }

        return $sections;
    }
}
