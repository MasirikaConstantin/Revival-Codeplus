@extends($activeTemplate . 'layouts.frontend')

@section('content')

    @include($activeTemplate . 'sections.banner')
    @include($activeTemplate . 'sections.catalogue_overview')

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
    @include($activeTemplate . 'sections.discovery_journey')

    @include($activeTemplate . 'user.product.add_to_collection')
@endsection
