@php
    $bestSelling = getContent('marketplace.content', true);
    $bestSellingProducts = \App\Models\Product::approved()
        ->allActive()
        ->with('author')
        ->latest('published_at')
        ->limit(5)
        ->get();
@endphp
<section class="browse-best-selling py-120 overflow-hidden">
    <div class="container">
        <div class="section-heading style-left flex-between gap-3">
            <div class="section-heading__inner">
                <h4 class="section-heading__title">{{ __(@$bestSelling->data_values->title) }}</h4>
            </div>
            <a href="{{ route('products') }}" class="btn btn-outline--base btn--sm">@lang('View All Items')</a>
        </div>
        <div class="browse-best-selling-slider">
            @foreach ($bestSellingProducts as $product)
                <x-product :product="$product" />
            @endforeach
        </div>
    </div>
</section>
