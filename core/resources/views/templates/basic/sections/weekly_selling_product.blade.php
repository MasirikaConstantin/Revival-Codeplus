@php
    $weeklyBestSelling         = getContent('weekly_selling_product.content', true);
    $weeklyBestSellingProducts = \App\Models\Product::approved()
        ->allActive()
        ->with('author')
        ->latest('published_at')
        ->limit(10)
        ->get();
@endphp

<section class="weekly-best-selling py-120 position-relative">
    <div class="blue-green"></div>
    <div class="blue-violet"></div>
    <div class="container">
        <div class="section-heading style-left flex-between gap-3">
            <div class="section-heading__inner">
                <h4 class="section-heading__title">@lang('Latest Products')</h4>
            </div>
            <a href="{{ route('products') }}" class="btn btn--sm btn-outline--base">@lang('View All Items')</a>
        </div>
        <div class="weekly-best-selling-slider">
            @foreach ($weeklyBestSellingProducts as $product)
                <x-product :product="$product" />
            @endforeach
        </div>
    </div>
</section>
