<div class="product-card h-100 @if ($product->audio_temp_file) audio-card @endif ">
    <div class="product-card__thumb">
        @if ($product->audio_temp_file && in_array('mp3', $product->category->preview_file_types))
            <div class="audio-player-wrapper">
                <div class="d-flex align-items-center gap-1 audio-player-left">
                    <button id="play-button-{{ $product->id }}" class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <span id="current-time-{{ $product->id }}">00:00</span>
                </div>

                <div class="audio-player-middle" data-file-path="{{ asset(getFilePath('previewFile')) . '/' . productFilePath($product, 'temp_audio_file') . '/' . $product->audio_temp_file }}" id="waveform-{{ $product->id }}"></div>

                <div class="audio-player-time">
                    <span id="total-time-{{ $product->id }}">00:00</span>
                </div>
            </div>
        @else
            <a href="{{ route('product.details', $product->slug) }}" class="link" title="{{ __($product->title) }}">
                <img src="{{ getImage(getFilePath('productInlinePreview') . productFilePath($product, 'inline_preview_image'), getFileSize('productInlinePreview')) }}"
                     alt="@lang('Product Image')" class="product-image">
            </a>
        @endif


        @if ($product->isTrending())
            <span class="icon">
                {!! file_get_contents(asset('assets/images/trending.svg')) !!}
            </span>
        @endif
        <div class="collection-list">
            <x-product-save :product="$product" />
        </div>
    </div>
    <div class="product-card__content h-100">
        <div class="product-card__content-inner">
            <div class="product-card__top d-flex w-100 justify-content-between ">
                <div class="product-card-title-wrapper">
                    <h6 class="product-card__title">
                        <a href="{{ route('product.details', $product->slug) }}" class="link border-effect">
                            {{ __($product->title) }}
                        </a>
                    </h6>
                    <span class="product-card__author">@lang('by')
                        <a href="{{ route('user.profile', $product->author->username) }}"
                           class="link">{{ __($product->author->fullname) }}</a>
                    </span>
                </div>
                <span class="product-card__price">{{ __(@$product->category->name) }}</span>
            </div>
            <div class="collection-list list-style">
                <x-product-save :product="$product" />

            </div>
        </div>
        <div class="flex-between align-items-center">
            <div class="product-card__rating">
                @if (@$product->total_review >= gs('min_reviews'))
                    <div class="rating-list">
                        @php echo displayRating($product->avg_rating); @endphp
                    </div>
                @endif
                <span class="product-card__sales">{{ showDateTime($product->published_at ?? $product->created_at, 'd M Y') }}</span>
            </div>

            @if ($product->demo_url)
                <a href="{{ @$product->demo_url }}" target="_blank"
                   class="btn btn-outline--light btn--sm mt-1">@lang('Live Preview')</a>
            @endif
        </div>
    </div>
</div>
