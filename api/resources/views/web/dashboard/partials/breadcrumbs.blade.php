@unless ($breadcrumbs->isEmpty())
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb__item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                <li class="breadcrumb__separator"><p>/</p></li>
            @else
                <li class="breadcrumb__item active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>
@endunless
