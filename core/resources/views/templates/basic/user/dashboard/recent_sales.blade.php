@php
    $recentProducts = $author->products()->approved()->latest()->take(6)->get();
@endphp
<div class="col-12">
    <h6 class="mb-0">@lang('Latest Products')</h6>
</div>
<div class="col-md-12">
    <div class="card custom--card">
        <div class="card-body">
            <div class="row gy-4">
                @forelse ($recentProducts as $product)
                    <div class="col-xl-4 col-sm-6">
                        <x-product :product="$product" />
                    </div>
                @empty
                    <x-empty-list title="No products found" />
                @endforelse
            </div>
        </div>
    </div>
</div>
