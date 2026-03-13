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

    $overviewStats = [
        [
            'label' => 'Approved Resources',
            'value' => App\Models\Product::approved()->allActive()->count(),
        ],
        [
            'label' => 'Featured Categories',
            'value' => App\Models\Category::active()->featured()->count(),
        ],
        [
            'label' => 'Verified Authors',
            'value' => App\Models\User::active()->author()->count(),
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
                <div class="col-xl-7">
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
                <div class="col-xl-5">
                    <div class="catalogue-overview__stack">
                        <div class="catalogue-overview__stats">
                            @foreach ($overviewStats as $stat)
                                <article class="catalogue-overview__stat-card">
                                    <span class="catalogue-overview__stat-value">{{ number_format($stat['value']) }}</span>
                                    <span class="catalogue-overview__stat-label">@lang($stat['label'])</span>
                                </article>
                            @endforeach
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
            padding: 34px;
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
            margin: 18px 0 14px;
            color: hsl(var(--white));
            font-size: clamp(2.8rem, 4vw, 4.8rem);
            line-height: 1.05;
        }

        .catalogue-overview__desc {
            max-width: 58rem;
            margin-bottom: 28px;
            color: rgba(255, 255, 255, 0.72);
            font-size: 1.7rem;
            line-height: 1.7;
        }

        .catalogue-overview__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 28px;
        }

        .catalogue-overview__category-block {
            padding-top: 18px;
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
            gap: 18px;
            height: 100%;
        }

        .catalogue-overview__stats {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .catalogue-overview__stat-card,
        .catalogue-overview__author-card {
            padding: 22px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
        }

        .catalogue-overview__stat-value {
            display: block;
            color: hsl(var(--white));
            font-size: 2.7rem;
            font-weight: 700;
            line-height: 1;
        }

        .catalogue-overview__stat-label {
            display: block;
            margin-top: 10px;
            color: rgba(255, 255, 255, 0.62);
            font-size: 1.35rem;
            line-height: 1.5;
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

        @media screen and (max-width: 991px) {
            .catalogue-overview__shell {
                padding: 24px;
                border-radius: 24px;
            }

            .catalogue-overview__stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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
