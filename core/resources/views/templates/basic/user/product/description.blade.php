<div id="screenshotsGallery" class="hidden">
    @foreach ($product->screenshots() as $screenshotPath)
        <a href="{{ getImage($screenshotPath) }}">@lang('Image')</a>
    @endforeach
</div>

<div id="previewVideo" class="mfp-hide">
    <div class="video-popup-wrapper">
        <button title="Close (Esc)" type="button" class="mfp-close">×</button>
        <video id="plyr-preview-player" playsinline controls>
            <source src="{{ getImage(getFilePath('previewVideo') . '/' . productFilePath($product, 'preview_video')) }}" type="video/mp4" />
        </video>
    </div>
</div>

<div class="product-details__inner @if ($product->audio_temp_file) audio-card @endif">
    <div class="product-details__thumb">
        @if ($product->audio_temp_file && in_array('mp3', $product->category->preview_file_types))
            <div class="audio-player-wrapper  @if ($product->demo_url == null && $product->category->file_type == 'audio') border-radius-add @endif">
                <div class="d-flex align-items-center gap-1 audio-player-left">
                    <button id="play-button-{{ $product->id }}" class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <span id="current-time-{{ $product->id }}">00:00</span>
                </div>

                <div class="audio-player-middle"
                     data-file-path="{{ asset(getFilePath('previewFile')) . '/' . productFilePath($product, 'temp_audio_file') . '/' . $product->audio_temp_file }}"
                     id="waveform-{{ $product->id }}"></div>

                <div class="audio-player-time">
                    <span id="total-time-{{ $product->id }}">00:00</span>
                </div>
            </div>
        @else
            <img src="{{ getImage(getFilePath('productPreview') . '/' . productFilePath($product, 'preview_image'), getFileSize('productPreview')) }}"
                 alt="@lang('Product Image')" />
        @endif
        <div class="product-details__buttons">
            @if ($product->category->file_type !== 'audio')
                @if ($product->demo_url)
                    <a href="{{ $product->demo_url }}" target="_blank" class="btn btn--base">@lang('Live Preview')</a>
                @endif
            @else
                <a href="{{ asset(getFilePath('previewFile')) . '/' . productFilePath($product, 'temp_audio_file') . '/' . $product->audio_temp_file }}" download="" class="btn btn--base">@lang('Download Preview')</a>
            @endif
            @if ($product->category->file_type !== 'audio')
                <a href="#" id="showScreenshots" class="btn btn-outline--base">@lang('Screenshots')</a>
                @if ($product->preview_video)
                    <a href="#" id="showPreviewVideo" class="btn btn-outline--base"><i class="las la-play"></i> @lang('Preview Video')</a>
                @endif
            @endif
        </div>
        @if ($product->isTrending())
            <span class="icon">
                {!! file_get_contents(asset('assets/images/trending.svg')) !!}
            </span>
        @endif
    </div>
    <div class="product-details__content">
        <div class="product-details-item">
            @php echo html_entity_decode($product->description); @endphp
        </div>
        <div class="product-details-item mb-3">
            <div class="product-details-item__title flex-between">
                <h6 class="mb-0">@lang('More items by') {{ @$product->author->fullname }}</h6>
                <a href="{{ route('user.profile', $product->author->username) }}"
                   class="text--base text-decoration-underline">
                    @lang('View author profile')
                </a>
            </div>
            <div class="more-product-thumbs">
                @foreach ($product->author->products()->approved()->where('id', '!=', $product->id)->orderBy('id', 'desc')->limit(8)->get() as $otherProduct)
                    <div class="more-product-thumbs__item">
                        <a href="{{ route('product.details', $otherProduct->slug) }}"
                           title="{{ __($otherProduct->title) }}">
                            <img src="{{ getImage(getFilePath('productThumbnail') . productFilePath($otherProduct, 'thumbnail')) }}"
                                 alt="@lang('Product Thumbnail')" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
