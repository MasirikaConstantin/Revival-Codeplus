@php
    $categories = App\Models\Category::active()->withCount([
        'products' => function ($query) {
            $query->allActive()->approved()->with('author');
        },
    ])
        ->featured()
        ->orderByDesc('products_count')
        ->get();
@endphp
@if ($categories->count())
    <section class="category category--reframed pt-120 pb-60">
        <div class="container">
            <div class="section-heading category--reframed__heading">
                <span class="category--reframed__eyebrow">@lang('Category Radar')</span>
                <h4 class="section-heading__title">@lang('Start with the strongest content clusters')</h4>
                <p class="section-heading__desc">@lang('Featured categories act like shortcuts into the densest parts of the catalogue.')</p>
            </div>
            <div class="category__inner category--reframed__inner">
                <div class="category-item-slider">
                    @foreach ($categories as $category)
                        <div class="category-item">
                            <div class="category-item__thumb">
                                <img src="{{ getImage(getFilePath('category') . '/' . $category->image, getFileSize('category')) }}" alt="{{ __(@$category->name) }}" />
                            </div>
                            <div class="category-item__content">
                                <h6 class="category-item__title">
                                    <a href="{{ route('products', ['category' => $category->id]) }}" class="link">
                                        {{ __($category->name) }}
                                    </a>
                                </h6>
                                <span class="category-item__count">{{ number_format($category->products_count) }} @lang('items')</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

@push('style')
    <style>
        .category--reframed__heading {
            max-width: 62rem;
            margin-bottom: 28px;
        }

        .category--reframed__eyebrow {
            display: inline-flex;
            margin-bottom: 16px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(92, 120, 255, 0.08);
            color: hsl(var(--base));
            font-size: 1.2rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .category--reframed__inner {
            padding: 22px;
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(248, 250, 255, 1), rgba(241, 246, 255, 0.9));
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.06);
        }

        .category--reframed .category-item {
            padding: 14px;
            border-radius: 22px;
            background: hsl(var(--white));
            border: 1px solid rgba(15, 23, 42, 0.06);
        }

        .category--reframed .category-item__content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .category--reframed .category-item__count {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(92, 120, 255, 0.08);
            color: hsl(var(--base));
            font-size: 1.2rem;
            font-weight: 600;
        }
    </style>
@endpush
