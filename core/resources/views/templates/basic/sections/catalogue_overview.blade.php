@php
    $overviewCategories = App\Models\Category::active()
        ->featured()
        ->withCount([
            'products' => function ($query) {
                $query->approved()->allActive();
            },
        ])
        ->limit(5)
        ->get();

    $featuredCategoriesCount = App\Models\Category::active()->featured()->count();
    $activeCategoriesCount = App\Models\Category::active()->count();

    $overviewStats = [
        [
            'label' => 'Approved Resources',
            'value' => App\Models\Product::approved()->allActive()->count(),
            'accent' => 'cyan',
        ],
        [
            'label' => $featuredCategoriesCount ? 'Featured Categories' : 'Active Categories',
            'value' => $featuredCategoriesCount ?: $activeCategoriesCount,
            'accent' => 'blue',
        ],
        [
            'label' => 'Verified Authors',
            'value' => App\Models\User::active()->author()->count(),
            'accent' => 'mint',
        ],
    ];

    $featuredAuthor = App\Models\User::active()
        ->author()
        ->where('is_author_featured', Status::YES)
        ->withCount([
            'products' => function ($query) {
                $query->approved()->allActive();
            },
        ])
        ->latest()
        ->first();
@endphp

<section class="catalogue-overview py-60">
    <div class="container">
        <div class="catalogue-overview__shell">
            <div class="row g-4 align-items-stretch">
                <div class="col-xxl-7 col-xl-12">
                    <div class="catalogue-overview__lead">
                        <span class="catalogue-overview__eyebrow">@lang('Signal Layers')</span>
                        <h2 class="catalogue-overview__title">@lang('A cleaner way to explore digital work')</h2>
                        <p class="catalogue-overview__desc">
                            @lang('Explore by format, category and author profile.')
                            @lang('Built for discovery, not checkout.')
                        </p>
                        <div class="catalogue-overview__actions">
                            <a href="{{ route('products') }}" class="btn btn--base">@lang('Browse Catalogue')</a>
                            @if ($featuredAuthor)
                                <a href="{{ route('user.portfolio', $featuredAuthor->username) }}" class="btn btn-outline--base">
                                    @lang('Meet the Community')
                                </a>
                            @endif
                        </div>

                        @if ($overviewCategories->count())
                            <div class="catalogue-overview__category-block">
                                <span class="catalogue-overview__label">@lang('Jump into a category')</span>
                                <div class="catalogue-overview__chips">
                                    @foreach ($overviewCategories as $category)
                                        <a href="{{ route('products', ['category' => $category->id]) }}" class="catalogue-overview__chip">
                                            <span>{{ __($category->name) }}</span>
                                            <strong>{{ $category->products_count }}</strong>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-12">
                    <div class="catalogue-overview__stack">
                        <div class="catalogue-overview__stats-panel">
                            <div class="catalogue-overview__stats-head">
                                <span class="catalogue-overview__stats-kicker">@lang('Catalogue Pulse')</span>
                                <p class="catalogue-overview__stats-copy">@lang('A quick snapshot of what is live in the catalogue right now.')</p>
                            </div>
                            <div class="catalogue-overview__stats">
                                @foreach ($overviewStats as $stat)
                                    <article class="catalogue-overview__stat-card catalogue-overview__stat-card--{{ $stat['accent'] }}">
                                        <span class="catalogue-overview__stat-label">@lang($stat['label'])</span>
                                        <span class="catalogue-overview__stat-value">{{ number_format($stat['value']) }}</span>
                                    </article>
                                @endforeach
                            </div>
                        </div>

                        @if ($featuredAuthor)
                            <article class="catalogue-overview__author-card">
                                <div class="catalogue-overview__author-head">
                                    <span class="catalogue-overview__author-avatar">
                                        <img src="{{ asset('assets/images/user/' . $featuredAuthor->avatar) }}" alt="{{ $featuredAuthor->username }}">
                                    </span>
                                    <div>
                                        <span class="catalogue-overview__author-kicker">@lang('Featured Author')</span>
                                        <h3 class="catalogue-overview__author-name">{{ $featuredAuthor->fullname }}</h3>
                                    </div>
                                </div>
                                <p class="catalogue-overview__author-meta">
                                    {{ number_format($featuredAuthor->products_count) }} @lang('approved items in portfolio')
                                </p>
                                <a href="{{ route('user.portfolio', $featuredAuthor->username) }}" class="catalogue-overview__author-link">
                                    @lang('View Portfolio')
                                </a>
                            </article>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('style')
    <style>
        .catalogue-overview__shell {
            position: relative;
            padding: 42px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 34px;
            background:
                radial-gradient(circle at top right, rgba(0, 216, 255, 0.12), transparent 28%),
                linear-gradient(180deg, rgba(10, 17, 35, 0.98), rgba(12, 21, 40, 0.96));
            box-shadow: 0 28px 80px rgba(2, 8, 20, 0.28);
            overflow: hidden;
        }

        .catalogue-overview__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
            color: #80f1ff;
            font-size: 1.2rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .catalogue-overview__title {
            max-width: 9.5em;
            margin: 20px 0 18px;
            color: hsl(var(--white));
            font-size: clamp(2.8rem, 4vw, 4.8rem);
            line-height: 1.08;
        }

        .catalogue-overview__desc {
            max-width: 58rem;
            margin-bottom: 32px;
            color: rgba(255, 255, 255, 0.72);
            font-size: 1.9rem;
            line-height: 1.8;
        }

        .catalogue-overview__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 34px;
        }

        .catalogue-overview__category-block {
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .catalogue-overview__label {
            display: block;
            margin-bottom: 14px;
            color: rgba(255, 255, 255, 0.58);
            font-size: 1.3rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .catalogue-overview__chips {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .catalogue-overview__chip {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: hsl(var(--white));
            transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        }

        .catalogue-overview__chip strong {
            color: #80f1ff;
            font-weight: 700;
        }

        .catalogue-overview__chip:hover {
            transform: translateY(-1px);
            color: hsl(var(--white));
            border-color: rgba(128, 241, 255, 0.4);
            background: rgba(128, 241, 255, 0.08);
        }

        .catalogue-overview__stack {
            display: grid;
            gap: 20px;
            height: 100%;
        }

        .catalogue-overview__stats-panel {
            padding: 24px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
        }

        .catalogue-overview__stats-head {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 18px;
        }

        .catalogue-overview__stats-kicker {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(128, 241, 255, 0.08);
            color: #80f1ff;
            font-size: 1.15rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .catalogue-overview__stats-copy {
            margin: 0;
            color: rgba(255, 255, 255, 0.62);
            font-size: 1.45rem;
            line-height: 1.7;
        }

        .catalogue-overview__stats {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .catalogue-overview__stat-card,
        .catalogue-overview__author-card {
            padding: 24px 22px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
        }

        .catalogue-overview__stat-card {
            position: relative;
            overflow: hidden;
            min-height: 170px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.07), rgba(255, 255, 255, 0.03));
        }

        .catalogue-overview__stat-card::before {
            content: "";
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 3px;
            opacity: 0.9;
        }

        .catalogue-overview__stat-card--cyan::before {
            background: linear-gradient(90deg, #46e7ff, transparent);
        }

        .catalogue-overview__stat-card--blue::before {
            background: linear-gradient(90deg, #7e8dff, transparent);
        }

        .catalogue-overview__stat-card--mint::before {
            background: linear-gradient(90deg, #59f5c0, transparent);
        }

        .catalogue-overview__stat-value {
            display: block;
            color: hsl(var(--white));
            font-size: 3.6rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .catalogue-overview__stat-label {
            display: block;
            margin-top: 0;
            color: rgba(255, 255, 255, 0.62);
            font-size: 1.45rem;
            line-height: 1.6;
            max-width: 12ch;
        }

        .catalogue-overview__author-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .catalogue-overview__author-avatar {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(128, 241, 255, 0.24);
        }

        .catalogue-overview__author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .catalogue-overview__author-kicker {
            display: block;
            margin-bottom: 4px;
            color: #80f1ff;
            font-size: 1.25rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .catalogue-overview__author-name {
            margin: 0;
            color: hsl(var(--white));
            font-size: 2rem;
        }

        .catalogue-overview__author-meta {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 12px;
        }

        .catalogue-overview__author-link {
            color: #80f1ff;
            font-weight: 600;
        }

        @media screen and (max-width: 1399px) {
            .catalogue-overview__stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .catalogue-overview__title {
                max-width: 12em;
            }
        }

        @media screen and (max-width: 1199px) {
            .catalogue-overview__stats {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 991px) {
            .catalogue-overview__shell {
                padding: 24px;
                border-radius: 24px;
            }

            .catalogue-overview__stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .catalogue-overview__desc {
                font-size: 1.7rem;
            }
        }

        @media screen and (max-width: 575px) {
            .catalogue-overview__actions,
            .catalogue-overview__chips {
                display: grid;
            }

            .catalogue-overview__stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush
