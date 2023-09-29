@php
    $txt_common_name = 'Common name';
    $txt_organization = 'Organization';
    $txt_country_name = 'Country name';
    $txt_state_or_province_name = 'State or province name';
@endphp

<div class="table certificate-table">
    <div class="cell header">
        <div>{{ $txt_common_name }}</div>
        <div>{{ $txt_organization }}</div>
        <div>{{ $txt_country_name }}</div>
        <div>{{ $txt_state_or_province_name }}</div>
        <div>Expires on</div>
        <div></div>
    </div>
    @forelse($certificates as $certificate)
        <div class="cell row">
            <div class="col"><span class="col__header">{{ $txt_common_name }}</span><span class="col__content bold">{{ $certificate->common_name }}</span></div>
            <div class="col"><span class="col__header">{{ $txt_organization }}</span><span class="col__content">{{ $certificate->organization }}</span></div>
            <div class="col"><span class="col__header">{{ $txt_country_name }}</span><span class="col__content">{{ $certificate->country_name }}</span></div>
            <div class="col"><span class="col__header">{{ $txt_state_or_province_name }}</span><span class="col__content">{{ $certificate->state_or_province_name }}</span></div>
            <div class="certificate-table__expire-col">
                <p><span class="status {{ $certificate->hasExpired() ? 'status--danger' : ($certificate->expireSoon() ? 'status--warning' : '')}}"></span> {{ $certificate->expires_on->format('d M, Y') }}</p>
                <p>({{ date_diff($certificate->expires_on, new DateTime())->days }} days left)</p></div>
            <div class="certificate-table__actions"><a href="{{ route('dashboard.certificates.show', ['certificate' => $certificate]) }}"><i class="fa-solid fa-xl fa-magnifying-glass"></i></a></div>
        </div>
    @empty
        <div class="cell cell--empty row">
            <div class="muted">No certificates found.</div>
        </div>
    @endforelse
</div>
