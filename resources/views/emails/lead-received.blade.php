<x-mail::message>
# {{ $typeLabel }}

Ada pesan baru masuk dari website VOBI.

<x-mail::panel>
**Nama:** {{ $lead->name }}<br>
**Email:** {{ $lead->email ?: '—' }}<br>
**WhatsApp:** {{ $lead->phone ?: '—' }}
@if($lead->subject)
<br>**Subjek:** {{ $lead->subject }}
@endif
</x-mail::panel>

@if($lead->message)
**Pesan:**

{{ $lead->message }}
@endif

@if($campaign)
---

## Campaign yang diajukan
**{{ $campaign->title }}** — {{ $campaign->price_short }}
{{ $campaign->category }} · {{ $campaign->service }}

@if($campaign->pic_name || $campaign->pic_phone || $campaign->pic_email)
<x-mail::panel>
**PIC Penanggung Jawab:** {{ $campaign->pic_name ?: '—' }}
@if($campaign->pic_phone)
<br>**WhatsApp PIC:** {{ $campaign->pic_phone }}
@endif
@if($campaign->pic_email)
<br>**Email PIC:** {{ $campaign->pic_email }}
@endif
</x-mail::panel>

> Tolong teruskan lead ini ke PIC di atas.
@else
> ⚠️ Campaign ini belum punya PIC — set dulu di admin.
@endif
@endif

@if($lead->email)
<x-mail::button :url="'mailto:'.$lead->email">
Balas via Email
</x-mail::button>
@endif

Masuk: {{ $lead->created_at?->format('d M Y H:i') }} · Lihat semua lead di [panel admin]({{ url('/admin/leads') }}).

Terima kasih,<br>
Website {{ config('app.name') }}
</x-mail::message>
