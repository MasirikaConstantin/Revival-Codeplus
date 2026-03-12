@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="product-details pt-60 pb-120">
        <div class="container">
            @include($activeTemplate . 'user.product.top')
            <div class="row gy-4">
                <div class="col-lg-8">
                    @include($activeTemplate . 'user.product.description')
                    @php
                        echo getAds('728x90');
                    @endphp
                </div>
                @include($activeTemplate . 'partials.common_sidebar')
            </div>
        </div>
        {{-- SHARE MODAL --}}
        <div id="shareModal" class="modal fade custom--modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header align-items-start">
                        <div class="modal-title">
                            <h5 class="m-0">@lang('Share On')</h5>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mx-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                       target="_blank" class="icon-circle bg-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mx-2">
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                                       target="_blank" class="icon-circle bg-linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mx-2">
                                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"
                                       class="icon-circle bg-x">
                                        <i class="fab fa-x-twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <input type="text" class="form-control form--control  copyText" readonly=""
                                       value="{{ url()->current() }}">
                                <button class="input-group-text c--p coptBtn">
                                    <i class="las la-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .icon-circle:hover {
            transform: scale(1.1);
            color: hsl(var(--white));
        }

        .bg-facebook {
            background-color: #3b5998;
        }

        .bg-linkedin {
            background-color: #0077b5;
        }

        .bg-x {
            background-color: #000000;
        }

        .video-popup-wrapper {
            position: relative;
            max-width: 800px;
            width: 90%;
            margin: 0 auto;
        }

        #plyr-preview-player {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Optional: tweak the Magnific Popup content */
        .mfp-content {
            padding: 20px;
            box-sizing: border-box;
        }

        .mfp-bg {
            background: rgba(0, 0, 0, 0.85);
            /* dark background */
        }

        .mfp-close {
            position: absolute;
            top: 0;
            right: 0;
            color: #979797 !important;
            font-size: 28px;
            z-index: 9999;
            background: none;
            border: none;
            cursor: pointer;
            opacity: 1;
        }

        .plyr--video .plyr__control:focus-visible,
        .plyr--video .plyr__control:hover,
        .plyr--video .plyr__control[aria-expanded=true] {
            background: hsl(var(--base));
            background: var(--plyr-video-control-background-hover, var(--plyr-color-main, var(--plyr-color-main, hsl(var(--base)); )));
            color: #fff;
            color: var(--plyr-video-control-color-hover, #fff);
        }

        .input-group-text.coptBtn {
            background: hsl(var(--base));
            color: hsl(var(--white));
            border: 1px solid transparent;
            font-size: 20px;
        }

        .custom--modal .modal-header .close:hover i {
            color: hsl(var(--danger));
        }
        @media (max-width: 991px) {
            .product-details-top__inner .custom-tab {
                gap: 12px !important;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            $('#showScreenshots').on('click', function(event) {
                event.preventDefault();

                $('#screenshotsGallery').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                }).magnificPopup('open');
            });


            const player = new Plyr('#plyr-preview-player', {
                controls: ['play', 'mute', 'fullscreen']
            });

            $('#showPreviewVideo').on('click', function(event) {
                event.preventDefault();

                $.magnificPopup.open({
                    items: {
                        src: '#previewVideo',
                        type: 'inline'
                    },
                    callbacks: {
                        open: function() {
                            player.play(); // auto play when popup opens
                        },
                        close: function() {
                            player.pause(); // pause when popup closes
                        }
                    }
                });
            });


            $('.share-button').on('click', function(e) {
                const modal = $('#shareModal');
                modal.modal('show');
            });

            $('.coptBtn').on('click', function(e) {
                var copyText = $(this).siblings('.copyText')[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                copyText.blur();

                notify('success', "Copied to the clipboard");
            });

        })(jQuery);
    </script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/plyr.css') }}" />
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/vendor/magnific-popup.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/plyr.polyfilled.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/vendor/jquery.magnific-popup.min.js') }}"></script>
@endpush
