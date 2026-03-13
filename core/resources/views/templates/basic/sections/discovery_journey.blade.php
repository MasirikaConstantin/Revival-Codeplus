@php
    $journeyAuthors = App\Models\User::active()
        ->author()
        ->latest()
        ->limit(3)
        ->get();

    $journeyCards = [
        [
            'step' => '01',
            'title' => 'Scan the catalogue',
            'details' => 'Move through categories, tags and curated collections without pricing noise.',
        ],
        [
            'step' => '02',
            'title' => 'Review the signals',
            'details' => 'Use previews, screenshots and author profiles to compare what deserves attention.',
        ],
        [
            'step' => '03',
            'title' => 'Follow the creators',
            'details' => 'Jump from a product to its portfolio and keep exploring the strongest contributors.',
        ],
    ];
@endphp

<section class="discovery-journey py-120">
    <div class="container">
        <div class="section-heading discovery-journey__heading">
            <span class="discovery-journey__eyebrow">@lang('Discovery Flow')</span>
            <h4 class="section-heading__title">@lang('A homepage that guides instead of overwhelming')</h4>
            <p class="section-heading__desc">@lang('Every block on the page should help the visitor narrow the field, not just scroll past more cards.')</p>
        </div>

        <div class="row g-4">
            <div class="col-xl-8">
                <div class="discovery-journey__grid">
                    @foreach ($journeyCards as $card)
                        <article class="discovery-journey__card">
                            <span class="discovery-journey__step">{{ $card['step'] }}</span>
                            <h5 class="discovery-journey__title">@lang($card['title'])</h5>
                            <p class="discovery-journey__desc">@lang($card['details'])</p>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-4">
                <aside class="discovery-journey__aside">
                    <h5 class="discovery-journey__aside-title">@lang('Recently active authors')</h5>
                    <div class="discovery-journey__author-list">
                        @foreach ($journeyAuthors as $author)
                            <a href="{{ route('user.portfolio', $author->username) }}" class="discovery-journey__author-item">
                                <span class="discovery-journey__author-avatar">
                                    <img src="{{ asset('assets/images/user/' . $author->avatar) }}" alt="{{ $author->username }}">
                                </span>
                                <span class="discovery-journey__author-copy">
                                    <strong>{{ $author->fullname }}</strong>
                                    <small>{{ '@' . $author->username }}</small>
                                </span>
                                <span class="discovery-journey__author-arrow"><i class="las la-arrow-right"></i></span>
                            </a>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@push('style')
    <style>
        .discovery-journey {
            position: relative;
            background:
                radial-gradient(circle at 10% 0%, rgba(92, 120, 255, 0.08), transparent 30%),
                linear-gradient(180deg, rgba(245, 249, 255, 0.88), rgba(255, 255, 255, 1));
        }

        .discovery-journey__heading {
            max-width: 72rem;
            margin-bottom: 40px;
        }

        .discovery-journey__eyebrow {
            display: inline-flex;
            align-items: center;
            margin-bottom: 18px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(92, 120, 255, 0.08);
            color: hsl(var(--base));
            font-size: 1.2rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .discovery-journey__grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .discovery-journey__card,
        .discovery-journey__aside {
            height: 100%;
            padding: 24px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
        }

        .discovery-journey__step {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            margin-bottom: 18px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(0, 216, 255, 0.14), rgba(92, 120, 255, 0.16));
            color: hsl(var(--base));
            font-weight: 700;
        }

        .discovery-journey__title {
            margin-bottom: 10px;
            font-size: 2rem;
        }

        .discovery-journey__desc {
            margin-bottom: 0;
            color: hsl(var(--body-color));
            line-height: 1.75;
        }

        .discovery-journey__aside-title {
            margin-bottom: 18px;
            font-size: 2rem;
        }

        .discovery-journey__author-list {
            display: grid;
            gap: 12px;
        }

        .discovery-journey__author-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 18px;
            background: rgba(244, 247, 252, 0.9);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .discovery-journey__author-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
        }

        .discovery-journey__author-avatar {
            width: 48px;
            height: 48px;
            overflow: hidden;
            border-radius: 16px;
        }

        .discovery-journey__author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .discovery-journey__author-copy {
            display: flex;
            flex: 1;
            flex-direction: column;
        }

        .discovery-journey__author-copy strong {
            color: hsl(var(--heading-color));
            font-weight: 600;
        }

        .discovery-journey__author-copy small {
            color: hsl(var(--body-color));
        }

        .discovery-journey__author-arrow {
            color: hsl(var(--base));
            font-size: 1.8rem;
        }

        @media screen and (max-width: 1199px) {
            .discovery-journey__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush
