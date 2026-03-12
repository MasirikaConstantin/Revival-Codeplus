@php
    $user             = $author;
    $publishedProducts = $user->products()->approved()->count();
    $pendingProducts   = $user->products()->pending()->count();
    $favoriteCount     = $user->favoriteProducts()->count();
    $collectionCount   = $user->collections()->count();
    $bsColClass        = 'col-lg-3';
@endphp

<div class="row gy-3">
    @php
        $currentLevel = $user->currentAuthorLevel->first();
    @endphp
    <div class="{{ $bsColClass }} col-sm-6">
        <div class="dashboard-widget">
            <span class="dashboard-widget__icon--big"><i class="la la-database"></i></span>
            <h6 class="dashboard-widget__title">@lang('Author Level')</h6>
            <div class="dashboard-widget__content">
                <span class="dashboard-widget__icon"><i class="la la-database"></i></span>
                <div class="dashboard-widget__info">
                    <h5 class="dashboard-widget__amount"> {{ __(@$currentLevel->name ?? 'N/A')}}  </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $bsColClass }} col-sm-6">
        <div class="dashboard-widget">
            <span class="dashboard-widget__icon--big"><i class="las la-box-open"></i></span>
            <h6 class="dashboard-widget__title">@lang('Published Products')</h6>
            <div class="dashboard-widget__content">
                <span class="dashboard-widget__icon"><i class="las la-box-open"></i></span>
                <div class="dashboard-widget__info">
                    <h5 class="dashboard-widget__amount">{{ $publishedProducts }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $bsColClass }} col-sm-6">
        <div class="dashboard-widget">
            <span class="dashboard-widget__icon--big"><i class="las la-hourglass-half"></i></span>
            <h6 class="dashboard-widget__title">@lang('Pending Review')</h6>
            <div class="dashboard-widget__content">
                <span class="dashboard-widget__icon"><i class="las la-hourglass-half"></i></span>
                <div class="dashboard-widget__info">
                    <h5 class="dashboard-widget__amount">{{ $pendingProducts }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $bsColClass }} col-sm-6">
        <div class="dashboard-widget">
            <span class="dashboard-widget__icon--big"><i class="la la-heart-o"></i></span>
            <h6 class="dashboard-widget__title">@lang('Favorites')</h6>
            <div class="dashboard-widget__content">
                <span class="dashboard-widget__icon"><i class="la la-heart-o"></i></span>
                <div class="dashboard-widget__info">
                    <h5 class="dashboard-widget__amount">{{ $favoriteCount }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $bsColClass }} col-sm-6">
        <div class="dashboard-widget">
            <span class="dashboard-widget__icon--big"><i class="la la-copy"></i></span>
            <h6 class="dashboard-widget__title">@lang('Collections')</h6>
            <div class="dashboard-widget__content">
                <span class="dashboard-widget__icon"><i class="la la-copy"></i></span>
                <div class="dashboard-widget__info">
                    <h5 class="dashboard-widget__amount">{{ $collectionCount }}</h5>
                </div>
            </div>
        </div>
    </div>

</div>
