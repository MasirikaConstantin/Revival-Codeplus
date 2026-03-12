@extends($activeTemplate . 'layouts.frontend')

@section('content')
    @php
        $selectedCategory = $categories->firstWhere('id', request()->category);
    @endphp
    <section class="upload-product pt-60 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-10 mb-4">
                    <form method="POST" action="{{ route('user.product.save') }}" class="upload-product-item-wrapper"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ request()->category }}" name="category">
                        <input type="hidden" value="{{ request()->sub_category }}" name="sub_category">
                        <div class="upload-product-item">
                            <h6 class="upload-product-item__title">@lang('Title & Description')</h6>
                            <div class="form-group">
                                <label class="form--label text-dark">@lang('Title')</label>
                                <input type="text" class="form--control form--control--sm" name="title"
                                       value="{{ old('title') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form--label text-dark">@lang('Description')</label>
                                <textarea class="form--control form--control--sm nicEdit" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="upload-product-item">
                            @php
                                $accept = '.png, .jpg, .jpeg';
                                if ($selectedCategory->file_type === 'audio') {
                                    $fileTypes = '.' . implode(', .', $selectedCategory->preview_file_types);
                                }
                            @endphp

                            <h6 class="upload-product-item__title">@lang('Files')</h6>
                            <div class="form-group">
                                <label class="form--label">@lang('Thumbnail Image')</label>
                                <input type="file" class="form--control form--control--sm" name="thumbnail"
                                       accept="{{ $accept }}">
                                <span class="alert-message fs-14">@lang('Supported Files:') {{ $accept }}. @lang('Image size must be')
                                    <b>{{ getFileSize('productThumbnail') }}</b> @lang('px')</b></span>
                            </div>
                            <div class="form-group">
                                @if ($selectedCategory->file_type == 'audio')
                                    <label for="previewFile" class="form--label">@lang('Preview File')</label>
                                    <input type="file" class="form--control form--control--sm" name="preview_file"
                                           accept="{{ $fileTypes }}">
                                    <span class="alert-message fs-14">@lang('Supported Files:') {{ $fileTypes }}.
                                        @lang('(mp3 for max size is')
                                        <b>{{ $selectedCategory->file_size }}</b> @lang('MB)')
                                    </span>
                                @else
                                    <label for="previewImage" class="form--label">@lang('Preview Image')</label>
                                    <input type="file" class="form--control form--control--sm" name="preview_image"
                                           accept="{{ $accept }}">
                                    <span class="alert-message fs-14">@lang('Supported Files:') {{ $accept }}.
                                        @lang('Image size must be')
                                        <b>{{ getFileSize('productPreview') }}</b> @lang('px')</b></span>
                                @endif
                            </div>
                            @if ($selectedCategory->file_type !== 'audio')
                                <div class="form-group">
                                    <label for="screenshots" class="form--label">
                                        @lang('Screenshots')
                                        <a href="#" class="common-sidebar__info ms-1" data-bs-toggle="tooltip"
                                           data-bs-placement="top" data-bs-title="@lang('Upload a zip file by selecting images only. Please dont\'t make any folder.')"><i
                                               class="icon-Info"></i></a>
                                    </label>
                                    <input type="file" class="form--control form--control--sm" name="screenshots"
                                           accept=".zip" />
                                    <span class="alert-message fs-14">@lang('Upload a zip file of screenshots')</span>
                                </div>
                            @endif

                            @if ($selectedCategory->file_type !== 'audio')
                                <div class="form-group">
                                    <label for="demo_url" class="form--label">@lang('Preview Video')</label>
                                    <input type="file" class="form--control form--control--sm" name="preview_video"
                                           accept="video/*">
                                    <span class="alert-message fs-14">@lang('File size shouldn\'t be more than 100 MB')</span>
                                </div>
                            @endif

                        </div>
                        @if ($selectedCategory->file_type != 'audio')
                            <div class="upload-product-item">
                                <h6 class="upload-product-item__title">@lang('Product Attributes')</h6>
                                <div class="row">
                                    @if ($form)
                                        <x-viser-form identifier="id" :identifierValue="$form->id" />
                                    @endif

                                    <div class="col-sm-12 col-xsm-12">
                                        <div class="form-group">
                                            <label for="demo_url" class="form--label">@lang('Demo Url')</label>
                                            <input type="url" class="form--control form--control--sm"
                                                   value="{{ old('demo_url') }}" name="demo_url"
                                                   {{ $selectedCategory->file_type != 'audio' ? 'required' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="upload-product-item">
                            <h6 class="upload-product-item__title">@lang('Tag & Support')</h6>
                            <div class="form-group select2-parent position-relative">
                                <label for="Category" class="form--label">@lang('Tags')</label>
                                <select name="tags[]" class="form--control form--control--sm select2 select2-auto-tokenize"
                                        multiple="multiple" required>
                                    @foreach (old('tags', []) as $tag)
                                        <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="upload-product-item">
                            <h6 class="upload-product-item__title">@lang('Message to the Reviewer')</h6>
                            <div class="form-group">
                                <label class="form--label">@lang('Your Message')</label>
                                <textarea name="message" class="form--control form--control--sm">{{ old('message', '') }}</textarea>
                            </div>
                            <div class="form-group">
                                @php
                                    $uploadTerm = getContent('upload_term.content', true);
                                    $uploadTerm = @$uploadTerm->data_values;
                                @endphp

                                <div class="form--check mt-2">
                                    <input class="form-check-input" type="checkbox" id="medium" required>
                                    <label class="form-check-label"
                                           for="medium">{{ __(@$uploadTerm->details) }}</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn--base btn--sm w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
                <div class="col-xxl-4 col-xl-4">
                    <form action="{{ route('user.product.upload') }}" method="GET"
                          class="upload-product-item-wrapper">
                        <div class="upload-product-item">
                            <h6 class="upload-product-item__title">@lang('Switch Category')</h6>
                            <div class="form-group">
                                <label class="form--label">@lang('Category')</label>
                                <select class="select form--control form--control--sm category select2" name="category"
                                        required>
                                    <option value="">@lang('Select One')</option>
                                    @foreach ($categories as $category)
                                        <option data-subcategories="{{ $category->subCategories }}"
                                                value="{{ $category->id }}" @selected(request()->category == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Subcategory')</label>
                                <select name="sub_category" class="select form--control form--control--sm select2"
                                        required>
                                    <option value="">@lang('Select One')</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn--sm  btn--base">@lang('Switch')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .select2 .selection {
            display: block !important;
        }
    </style>
@endpush

@push('script')
    <script>
        bkLib.onDomLoaded(function() {
            $(".nicEdit").each(function(index) {
                $(this).attr("id", "nicEditor" + index);
                new nicEditor({
                    fullPanel: true
                }).panelInstance('nicEditor' + index, {
                    hasPanel: true
                });
            });
        });

        (function($) {
            "use strict";
            $('.select2-auto-tokenize').select2({
                dropdownParent: $('.select2-parent'),
                tags: true,
                tokenSeparators: [',']
            });

            $('.category').on('change', function() {
                let subcategories = $(this).find(':selected').data('subcategories');
                let html = '';

                $.each(subcategories, function(index, subcategory) {
                    html += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                });

                $('[name=sub_category]').html(html);
            });
            $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                $('.nicEdit-main').focus();
            });

            let subCategoryId = @json(request()->sub_category);

            let subcategories = $('[name=category]').find(':selected').data('subcategories');
            refreshSubCategories();

            $('.category').on('change', function() {
                subcategories = $(this).find(':selected').data('subcategories');
                refreshSubCategories();
            });


            function refreshSubCategories() {
                let html = '';
                $.each(subcategories, function(index, subcategory) {
                    html +=
                        `<option ${subCategoryId == subcategory.id ? 'selected' : ''} value="${subcategory.id}">${subcategory.name}</option>`;
                });
                $('[name=sub_category]').html(html);
            }

        })(jQuery);
    </script>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/nicEdit.js') }}"></script>
@endpush
