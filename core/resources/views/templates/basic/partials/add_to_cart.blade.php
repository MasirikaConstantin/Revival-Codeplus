<div class="common-sidebar__item">
    <h6 class="common-sidebar__title">@lang('Catalogue Item')</h6>
    <div class="common-sidebar__content">
        <p class="mb-3">@lang('This product is presented as a showcase item. Purchasing, checkout, and source-code downloads are disabled.')</p>
        @if ($product->demo_url)
            <div class="common-sidebar__button">
                <a href="{{ $product->demo_url }}" target="_blank" class="btn btn--base w-100">@lang('Open Preview')</a>
            </div>
        @endif
    </div>
</div>
