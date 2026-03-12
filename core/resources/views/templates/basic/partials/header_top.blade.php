@php
    $user = auth()->user();
@endphp

<div class="header-top" style="padding:10px 0;">
    <div class="container">
        <div class="top-header__wrapper flex-between">
            <a class="navbar-brand logo site-logo d-lg-block d-none" href="{{ route('home') }}" style="display:flex;align-items:center;max-height:40px;padding:0;">
                <img src="{{ siteLogo() }}" alt="@lang('logo')" style="height:36px;max-height:36px;max-width:180px;width:auto;object-fit:contain;">
            </a>
            <div class="header-top__right flex-between gap-2">
                <div class="language_switcher">
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
                        <ul class="top-menu-list flex-between">
                            <li class="top-menu-list__item">
                                <a href="{{ route('user.register') }}" class="top-menu-list__link"> @lang('Register') </a>
                            </li>
                            <li class="top-menu-list__item">
                                <a href="{{ route('user.login') }}" class="top-menu-list__link"> @lang('Login') </a>
                            </li>
                        </ul>
                    @endguest
                    @auth
                        <div class="profile-info">
                            <button type="button" class="profile-info__button flex-align">
                                <span class="profile-info__icon">
                                    <img src="{{ asset('assets/images/user/' . @$user->avatar) }}"
                                         alt="{{ @$user->username }}'s avatar" class="profile-info__avatar">
                                </span>
                                <span class="profile-info__content">
                                    <span class="profile-info__name">{{ @$user->username }} </span>
                                    <span class="profile-info__text">@lang('Catalogue')</span>
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
