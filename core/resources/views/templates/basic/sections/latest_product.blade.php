@php
    $latestProductContent = getContent('latest_product.content', true);
    $categories = App\Models\Category::active()
        ->with([
            'products' => function ($query) {
                $query->approved()->allActive()->where('is_free', Status::DISABLE)->orderBy('id','desc');
            },
            'products.author',
            'products.users',
        ])
        ->get();

    $latestProductsQuery = App\Models\Product::with('author')->approved()->allActive()->where('is_free', Status::DISABLE);
    $latestProductCount  = (clone $latestProductsQuery)->count();
    $latestProducts      = $latestProductsQuery->latest()->limit(8)->get();
@endphp
<section class="latest-template latest-template--reframed pt-60 pb-120">
    <div class="container">
        <div class="section-heading latest-template--reframed__heading">
            <span class="latest-template--reframed__eyebrow">@lang('Fresh Signals')</span>
            <h4 class="section-heading__title">{{ __(@$latestProductContent->data_values->title) }}</h4>
            <p class="section-heading__desc">{{ __(@$latestProductContent->data_values->subtitle) }}</p>
        </div>

        <ul class="nav custom--tab nav-pills latest-template--reframed__tabs mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-all-items-tab" data-bs-toggle="pill" data-bs-target="#pills-all-items" type="button"
                    role="tab" aria-controls="pills-all-items" aria-selected="true">@lang('All Items')</button>
            </li>
            @foreach ($categories as $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-{{ $category->id }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $category->id }}"
                        type="button" role="tab" aria-controls="pills-{{ $category->id }}"
                        aria-selected="false">{{ __($category->name) }}</button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content latest-template--reframed__content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all-items" role="tabpanel" aria-labelledby="pills-all-items-tab" tabindex="0">
                <div class="row gy-4">
                    @foreach ($latestProducts as $product)
                        <div class="col-lg-3 col-sm-6 col-xsm-6">
                            <x-product :product="$product" />
                        </div>
                    @endforeach
                </div>
            </div>

            @foreach ($categories as $category)
                <div class="tab-pane fade" id="pills-{{ $category->id }}" role="tabpanel" aria-labelledby="pills-{{ $category->id }}-tab"
                    tabindex="0">
                    <div class="row gy-4">
                        @forelse ($category->products->take(8) as $product)
                            <div class="col-lg-3 col-sm-6 col-xsm-6">
                                <x-product :product="$product" />
                            </div>
                        @empty
                        <x-empty-list title="No product found" />
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
        @if ($latestProductCount > 8)
        <div class="text-center view-all-btn">
            <a href="{{ route('products') }}?sort_by=new_item" class="btn btn--sm btn-outline--base">@lang('View All Items')</a>
        </div>
        @endif
    </div>
    @php
        echo getAds('728x90');
    @endphp
</section>

@push('style')
    <style>
        .latest-template--reframed__heading {
            max-width: 68rem;
            margin-bottom: 26px;
        }

        .latest-template--reframed__eyebrow {
            display: inline-flex;
            margin-bottom: 16px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(0, 216, 255, 0.08);
            color: #0a8fb4;
            font-size: 1.2rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .latest-template--reframed__tabs {
            gap: 10px;
            padding: 12px;
            border-radius: 22px;
            background: rgba(243, 247, 253, 0.95);
        }

        .latest-template--reframed__tabs .nav-link {
            border-radius: 999px;
            padding: 12px 18px;
        }

        .latest-template--reframed__content {
            margin-top: 18px;
            padding: 22px;
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 1), rgba(248, 251, 255, 0.96));
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.06);
        }
    </style>
@endpush
