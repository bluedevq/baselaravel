<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @if(count($breadcrumbs))
            @foreach($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ $breadcrumb->url }}"><span>{{ $breadcrumb->title }}</span></a>
                    </li>
                @else
                    <li class="breadcrumb-item" aria-current="page"><span>{{ $breadcrumb->title }}</span></li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>
