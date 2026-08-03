<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    /**
     * Handle "Cara Gabung" submissions — Creator or Brand.
     */
    public function gabung(Request $request)
    {
        $data = $request->validate([
            'type'    => ['required', Rule::in(['creator', 'brand'])],
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email', 'max:160'],
            'phone'   => ['required', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:3000'],
            'website' => ['nullable', 'size:0'], // honeypot anti-spam
        ], [], [
            'name' => 'nama', 'email' => 'email', 'phone' => 'nomor WhatsApp',
        ]);

        $lead = Lead::create([
            'type'        => $data['type'],
            'name'        => $data['name'],
            'email'       => $data['email'],
            'phone'       => $data['phone'],
            'subject'     => $data['subject'] ?? null,
            'message'     => $data['message'] ?? null,
            'source_page' => 'gabung',
            'status'      => 'baru',
        ]);

        notify_lead($lead);

        return back()->with('ok', $data['type'] === 'creator'
            ? 'Terima kasih! Pendaftaran creator kamu sudah masuk. Tim VOBI akan menghubungi kamu secepatnya.'
            : 'Terima kasih! Permintaan kerjasama brand kamu sudah masuk. Tim kami akan segera menghubungi.')
            ->withFragment('form');
    }

    /**
     * Handle consultation / contact form.
     */
    public function kontak(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email', 'max:160'],
            'phone'   => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:3000'],
            'website' => ['nullable', 'size:0'], // honeypot anti-spam
        ]);

        $lead = Lead::create([
            'type'        => 'consultation',
            'name'        => $data['name'],
            'email'       => $data['email'],
            'phone'       => $data['phone'] ?? null,
            'subject'     => $data['subject'] ?? null,
            'message'     => $data['message'],
            'source_page' => 'kontak',
            'status'      => 'baru',
        ]);

        notify_lead($lead);

        return back()->with('ok', 'Pesan kamu sudah terkirim. Terima kasih — tim VOBI akan segera merespons.')
            ->withFragment('form');
    }

    /**
     * Handle "Ajak Kerjasama" dari Creator directory.
     */
    public function marketplace(Request $request)
    {
        $data = $request->validate([
            'creator' => ['required', 'string', 'max:160'],
            'name'    => ['required', 'string', 'max:120'],
            'brand'   => ['nullable', 'string', 'max:160'],
            'email'   => ['required', 'email', 'max:160'],
            'phone'   => ['required', 'string', 'max:40'],
            'message' => ['nullable', 'string', 'max:3000'],
            'website' => ['nullable', 'size:0'], // honeypot anti-spam
        ], [], ['name' => 'nama', 'email' => 'email', 'phone' => 'nomor WhatsApp']);

        $lead = Lead::create([
            'type'        => 'marketplace',
            'name'        => $data['name'],
            'email'       => $data['email'],
            'phone'       => $data['phone'],
            'subject'     => 'Ajak Kerjasama: ' . $data['creator'] . ($data['brand'] ? ' (' . $data['brand'] . ')' : ''),
            'message'     => $data['message'] ?? null,
            'source_page' => 'marketplace',
            'status'      => 'baru',
            'meta'        => ['creator' => $data['creator'], 'brand' => $data['brand'] ?? null],
        ]);

        notify_lead($lead);

        return back()->with('ok', 'Permintaan kerjasama dengan ' . $data['creator'] . ' sudah masuk. Tim VOBI akan segera menghubungi kamu!')
            ->withFragment('katalog');
    }

    /**
     * Handle pengajuan paket Campaign — email menyertakan PIC campaign.
     */
    public function campaign(Request $request, Campaign $campaign)
    {
        abort_unless($campaign->is_live, 404);

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'brand'   => ['nullable', 'string', 'max:160'],
            'email'   => ['required', 'email', 'max:160'],
            'phone'   => ['required', 'string', 'max:40'],
            'message' => ['nullable', 'string', 'max:3000'],
            'website' => ['nullable', 'size:0'], // honeypot anti-spam
        ], [], ['name' => 'nama', 'email' => 'email', 'phone' => 'nomor WhatsApp']);

        $lead = Lead::create([
            'type'        => 'campaign',
            'name'        => $data['name'],
            'email'       => $data['email'],
            'phone'       => $data['phone'],
            'subject'     => 'Pengajuan Campaign: ' . $campaign->title . ($data['brand'] ? ' (' . $data['brand'] . ')' : ''),
            'message'     => $data['message'] ?? null,
            'source_page' => 'campaign',
            'status'      => 'baru',
            'meta'        => [
                'campaign_id'   => $campaign->id,
                'campaign'      => $campaign->title,
                'brand'         => $data['brand'] ?? null,
                'pic_name'      => $campaign->pic_name,
                'pic_phone'     => $campaign->pic_phone,
                'pic_email'     => $campaign->pic_email,
            ],
        ]);

        notify_lead($lead, $campaign);

        return back()->with('ok', 'Pengajuan paket "' . $campaign->title . '" sudah masuk. Tim VOBI akan segera menghubungi kamu!')
            ->withFragment('form');
    }
}
