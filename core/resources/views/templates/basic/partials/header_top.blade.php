@php
    $user = auth()->user();
@endphp

<div class="header-top header-top--futuristic">
    <div class="container">
        <div class="top-header__wrapper top-header__wrapper--futuristic flex-between">
            <a class="navbar-brand logo site-logo site-logo--futuristic d-lg-block d-none" href="{{ route('home') }}">
                <img src="{{ siteLogo() }}" alt="@lang('logo')" class="site-logo__image">
            </a>
            <div class="header-top__right header-top__right--futuristic flex-between gap-2">
                <div class="language_switcher language_switcher--futuristic">
                    @if (gs('multi_language'))
                        @php
                            $language = App\Models\Language::all();
                            $selectLang = $language->where('code', config('app.locale'))->first();
                            $currentLang = session('lang') ? $language->where('code', session('lang'))->first() : $language->where('is_default', Status::YES)->first();
                        @endphp
                        <div class="language_switcher__caption">
                            <span class="icon">
                                <img src="{{ getImage(getFilePath('language') . '/' . $currentLang->image, getFileSize('language')) }}"
                                     alt="@lang('image')">
                            </span>
                            <span class="text"> {{ __(@$selectLang->name) }} </span>
                        </div>
                        <div class="language_switcher__list">
                            @foreach ($language as $item)
                                <div class="language_switcher__item    @if (session('lang') == $item->code) selected @endif"
                                     data-value="{{ $item->code }}">
                                    <a href="{{ route('lang', $item->code) }}" class="thumb">
                                        <span class="icon">
                                            <img src="{{ getImage(getFilePath('language') . '/' . $item->image, getFileSize('language')) }}"
                                                 alt="@lang('image')">
                                        </span>
                                        <span class="text"> {{ __($item->name) }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


                <div class="flex-align gap-2">
                    @guest
                        <ul class="top-menu-list top-menu-list--futuristic flex-between">
                            <li class="top-menu-list__item">
                                <a href="{{ route('user.register') }}" class="top-menu-list__link top-menu-list__link--accent"> @lang('Register') </a>
                            </li>
                            <li class="top-menu-list__item">
                                <a href="{{ route('user.login') }}" class="top-menu-list__link top-menu-list__link--glass"> @lang('Login') </a>
                            </li>
                        </ul>
                    @endguest
                    @auth
                        <div class="profile-info profile-info--futuristic">
                            <button type="button" class="profile-info__button profile-info__button--futuristic flex-align">
                                <span class="profile-info__icon">
                                    <img src="{{ asset('assets/images/user/' . @$user->avatar) }}"
                                         alt="{{ @$user->username }}'s avatar" class="profile-info__avatar">
                                </span>
                                <span class="profile-info__content">
                                    <span class="profile-info__name">{{ @$user->username }} </span>
                                    <span class="profile-info__text"><span class="profile-info__signal"></span>@lang('Catalogue')</span>
                                </span>
                            </button>
                            <div class="profile-dropdown">
                                <div class="profile-info style-two flex-align">
                                    <span class="profile-info__icon">
                                        <img src="{{ asset('assets/images/user/' . @$user->avatar) }}"
                                             alt="{{ @$user->fullname }}'s avatar" class="profile-info__avatar">
                                    </span>
                                    <span class="profile-info__content">
                                        <span class="profile-info__name">{{ @$user->fullname }} </span>
                                        <span class="profile-info__text">{{ @$user->email }}</span>
                                    </span>
                                </div>

                                <ul class="profile-dropdown-list">
                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.home') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.home') }}">
                                            <span class="icon"><i class="la la-home"></i></span>
                                            @lang('Dashboard')
                                        </a>
                                    </li>
                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.profile.my') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.profile.my') }}">
                                            <span class="icon">
                                                <i class="la la-user"></i>
                                            </span>
                                            @lang('Profile')
                                        </a>
                                    </li>
                                    @if (auth()->check() && auth()->user()->isAuthor())
                                        <li class="profile-dropdown-list__item">
                                            <a href="{{ route('user.product.upload') }}"
                                               class="profile-dropdown-list__link {{ menuActive('user.product.upload') }}">
                                                <span class="icon"> <i class="la la-upload"></i></span>
                                                @lang('Upload Item')</a>
                                        </li>
                                    @endif
                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('ticket.index') }}"
                                           class="profile-dropdown-list__link {{ menuActive('ticket.*') }}">
                                            <span class="icon"><i class="la la-ticket"></i></span>
                                            @lang('Support Ticket')
                                        </a>
                                    </li>

                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.author.favorites') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.author.favorites') }}">
                                            <span class="icon"><i class="la la-heart-o"></i></span>@lang('Favorites')
                                        </a>
                                    </li>

                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.author.collections') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.author.collections') }}">
                                            <span class="icon"><i class="la la-copy"></i></span>@lang('Collections')
                                        </a>
                                    </li>

                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.api.key.index') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.api.key.*') }}">
                                            <span class="icon"><i class="las la-code"></i></span>
                                            @lang('API Key')
                                        </a>
                                    </li>

                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.profile.setting') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.profile.setting') }}">
                                            <span class="icon"> <i class="la la-gear"></i></span> @lang('Settings')</a>
                                    </li>
                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.twofactor') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.twofactor') }}">
                                            <span class="icon"> <i class="la la-fingerprint"></i></span>
                                            @lang('2FA Security')</a>
                                    </li>
                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.change.password') }}"
                                           class="profile-dropdown-list__link {{ menuActive('user.change.password') }}">
                                            <span class="icon"> <i class="la la-key"></i></span> @lang('Change Password')</a>
                                    </li>
                                    <li class="profile-dropdown-list__item">
                                        <a href="{{ route('user.logout') }}" class="profile-dropdown-list__link">
                                            <span class="icon"> <i class="la la-sign-out-alt"></i></span>
                                            @lang('Logout')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>

@push('style')
    <style>
        .header-top--futuristic {
            padding: 16px 0 !important;
            background:
                radial-gradient(circle at top left, rgba(0, 216, 255, 0.18), transparent 32%),
                radial-gradient(circle at top right, rgba(92, 120, 255, 0.18), transparent 28%),
                linear-gradient(180deg, rgba(5, 10, 24, 0.96), rgba(8, 15, 32, 0.92));
            border-bottom: 1px solid rgba(135, 160, 255, 0.14);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.28);
        }

        .header-top--futuristic::before {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0, 216, 255, 0.7), transparent);
            opacity: 0.8;
        }

        .top-header__wrapper--futuristic {
            gap: 20px;
            padding: 12px 18px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.04);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
        }

        .site-logo--futuristic {
            display: flex !important;
            align-items: center !important;
            padding: 0 !important;
            margin: 0 !important;
            position: relative;
        }

        .site-logo--futuristic::after {
            content: "";
            position: absolute;
            inset: -6px -10px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(0, 216, 255, 0.12), rgba(92, 120, 255, 0.04));
            z-index: -1;
        }

        .site-logo__image {
            height: 36px !important;
            max-height: 36px !important;
            max-width: 180px !important;
            width: auto !important;
            object-fit: contain !important;
            display: block !important;
        }

        .header-top__right--futuristic {
            gap: 14px !important;
            align-items: center;
        }

        .language_switcher--futuristic {
            padding: 0 18px 0 0;
        }

        .language_switcher--futuristic::after {
            color: rgba(255, 255, 255, 0.86);
            right: 2px;
        }

        .language_switcher--futuristic .language_switcher__caption {
            min-height: 44px;
            padding: 10px 14px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        .language_switcher--futuristic .language_switcher__caption .text {
            letter-spacing: 0.02em;
        }

        .language_switcher--futuristic .language_switcher__list {
            width: 148px;
            padding: 8px;
            border: 1px solid rgba(135, 160, 255, 0.16);
            border-radius: 18px;
            background: rgba(8, 15, 32, 0.92);
            box-shadow: 0 24px 50px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(16px);
        }

        .language_switcher--futuristic .language_switcher__list .text {
            color: hsl(var(--white));
        }

        .language_switcher--futuristic .language_switcher__item a {
            padding: 9px 10px;
            border-radius: 12px;
            gap: 8px;
        }

        .language_switcher--futuristic .language_switcher__item a:hover,
        .language_switcher--futuristic .language_switcher__item.selected {
            background: rgba(0, 216, 255, 0.12);
        }

        .top-menu-list--futuristic {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 0;
        }

        .top-menu-list--futuristic .top-menu-list__item {
            padding-right: 0;
        }

        .top-menu-list--futuristic .top-menu-list__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 10px 18px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        }

        .top-menu-list__link--accent {
            background: linear-gradient(135deg, rgba(0, 216, 255, 0.95), rgba(92, 120, 255, 0.9));
            color: #03111f !important;
            box-shadow: 0 12px 28px rgba(0, 216, 255, 0.25);
        }

        .top-menu-list__link--glass {
            background: rgba(255, 255, 255, 0.05);
            color: hsl(var(--white)) !important;
        }

        .top-menu-list--futuristic .top-menu-list__link:hover {
            transform: translateY(-1px);
            border-color: rgba(0, 216, 255, 0.34);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.18);
        }

        .profile-info--futuristic {
            margin-left: 0;
        }

        .profile-info__button--futuristic {
            padding: 8px 12px 8px 8px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
            transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        }

        .profile-info__button--futuristic:hover {
            transform: translateY(-1px);
            border-color: rgba(0, 216, 255, 0.3);
            background: rgba(255, 255, 255, 0.08);
        }

        .profile-info--futuristic .profile-info__icon {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(0, 216, 255, 0.26);
            background: linear-gradient(135deg, rgba(0, 216, 255, 0.14), rgba(92, 120, 255, 0.2));
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.04);
        }

        .profile-info--futuristic .profile-info__content {
            max-width: none;
            padding-left: 12px;
        }

        .profile-info--futuristic .profile-info__name {
            font-size: 0.95rem;
            letter-spacing: 0.01em;
        }

        .profile-info__signal {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 7px;
            border-radius: 50%;
            background: #26f7a6;
            box-shadow: 0 0 0 4px rgba(38, 247, 166, 0.14);
        }

        .profile-info--futuristic .profile-dropdown {
            margin-top: 16px;
            padding: 18px;
            border: 1px solid rgba(135, 160, 255, 0.14);
            border-radius: 20px;
            background: rgba(8, 15, 32, 0.94);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.32);
            backdrop-filter: blur(18px);
        }

        .profile-info--futuristic .profile-dropdown::before {
            background: rgba(8, 15, 32, 0.94);
            border-top: 1px solid rgba(135, 160, 255, 0.14);
            border-left: 1px solid rgba(135, 160, 255, 0.14);
        }

        .profile-info--futuristic .profile-info.style-two .profile-info__name,
        .profile-info--futuristic .profile-dropdown-list__link {
            color: hsl(var(--white));
        }

        .profile-info--futuristic .profile-info.style-two .profile-info__text {
            color: rgba(255, 255, 255, 0.66);
        }

        .profile-info--futuristic .profile-dropdown-list__link {
            border-radius: 12px;
        }

        .profile-info--futuristic .profile-dropdown-list__link:hover,
        .profile-info--futuristic .profile-dropdown-list__link.active {
            background: rgba(0, 216, 255, 0.12);
            color: #84f2ff;
        }

        @media screen and (max-width: 991px) {
            .header-top--futuristic {
                padding: 10px 0 !important;
            }

            .top-header__wrapper--futuristic {
                padding: 12px 14px;
                border-radius: 18px;
                flex-wrap: wrap;
            }

            .header-top__right--futuristic {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }
        }

        @media screen and (max-width: 575px) {
            .top-menu-list--futuristic {
                width: 100%;
                gap: 8px;
            }

            .top-menu-list--futuristic .top-menu-list__item {
                flex: 1;
            }

            .top-menu-list--futuristic .top-menu-list__link {
                width: 100%;
                padding-inline: 14px;
            }

            .language_switcher--futuristic .language_switcher__caption {
                min-height: 40px;
                padding: 8px 12px;
            }
        }
    </style>
@endpush
