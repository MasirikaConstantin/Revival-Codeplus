@php
    $banner = getContent('banner.content', true);
    $bannerElements = getContent('banner.element');
@endphp
<section class="banner bg-img" data-background-image="{{ frontendImage('banner', 'bg.png', '1920x850') }}">
    <div class="container">
        <div class="banner-wrapper d-flex">
            <div class="banner-content">
                <span class="banner-content__eyebrow">@lang('Digital Catalogue')</span>
                <h1 class="banner-content__title">@lang('Explore 23,000+ Digital Resources')</h1>
                <p class="banner-content__desc">@lang('Browse templates, media, assets and showcase products in a streamlined catalogue experience.')</p>
                <form action="{{ route('products') }}" class="search-box">
                    <input type="text" class="form--control" name="search" placeholder="@lang('Search resources, categories or authors')">
                    <button type="submit" class="btn btn--base search-box__btn">
                        <span class="icon"><i class="icon-Search"></i></span>
                        @lang('Search')
                    </button>
                </form>
                <ul class="banner-highlights">
                    <li class="banner-highlights__item">@lang('Curated categories')</li>
                    <li class="banner-highlights__item">@lang('Preview-first experience')</li>
                    <li class="banner-highlights__item">@lang('Author showcases')</li>
                </ul>
                <ul class="tech-list flex-align">
                    @foreach ($bannerElements as $bannerElement)
                        <li class="tech-list__item flex-center">
                            <img src="{{ frontendImage('banner', @$bannerElement->data_values->tech_image, '20x20') }}" alt="@lang('Image')" class="icon">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="banner-thumb d-none d-lg-block">
                <img src="{{ frontendImage('banner', @$banner->data_values->image, '680x450') }}" alt="@lang('Image')">
                <img src="{{ asset($activeTemplateTrue . 'images/curve-shape.png') }}" alt="@lang('Image')" class="banner-thumb__element one">
                <img src="{{ asset($activeTemplateTrue . 'images/banner-shape2.png') }}" alt="@lang('Image')" class="banner-thumb__element two">
                <div class="design-qty flex-center">
                    <div class="design-qty__content">
                        <span class="design-qty__icon"> <img src="{{ frontendImage('banner',@$banner->data_values->counter_image, '30x20') }}" alt="@lang('Image')"></span>
                        <span class="design-qty__number text--base">@lang('Catalogue Mode')</span>
                        <span class="design-qty__text">@lang('No checkout, just discovery and preview')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('style')
    <style>
        .banner-content__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            margin-bottom: 18px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            color: hsl(var(--base));
            font-size: 1.4rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            backdrop-filter: blur(8px);
        }

        .banner-content__desc {
            max-width: 62rem;
        }

        .banner-highlights {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin: 24px 0 0;
            padding: 0;
            list-style: none;
        }

        .banner-highlights__item {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            color: hsl(var(--white));
            font-size: 1.4rem;
            font-weight: 500;
            line-height: 1.4;
        }

        @media screen and (max-width: 575px) {
            .banner-content__eyebrow {
                font-size: 1.2rem;
                letter-spacing: 0.06em;
            }

            .banner-highlights {
                gap: 10px;
            }

            .banner-highlights__item {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush
