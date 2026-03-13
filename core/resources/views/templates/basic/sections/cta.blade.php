@php
    $cta = getContent('cta.content',true);
@endphp
<section class="cta">
    <div class="cta__inner cta__inner--reframed">
        <img src="{{ asset($activeTemplateTrue.'images/cta-line-shape.png') }}" alt="@lang('Image')" class="cta__line-shape">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-6">
                   <div class="cta-content pt-120">
                        <div class="section-heading style-left">
                            <span class="cta__eyebrow">@lang('Next Move')</span>
                            <h4 class="section-heading__title">{{ __(@$cta->data_values->title) }}</h4>
                            <p class="section-heading__desc">{{ __(@$cta->data_values->subtitle) }}</p>
                        </div>
                        <div class="cta__actions">
                            <a href="{{ route('user.register') }}" class="btn btn--base">@lang('Create Acccount')</a>
                            <a href="{{ route('products') }}" class="btn btn-outline--base">@lang('Browse Catalogue')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cta-thumb">
                        <img src="{{ frontendImage('cta', @$cta->data_values->image,'635x570') }}" alt="@lang('Image')">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('style')
    <style>
        .cta__inner--reframed {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at top right, rgba(0, 216, 255, 0.18), transparent 28%),
                linear-gradient(135deg, rgba(9, 17, 35, 0.98), rgba(14, 24, 46, 0.96));
        }

        .cta__eyebrow {
            display: inline-flex;
            margin-bottom: 16px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            color: #80f1ff;
            font-size: 1.2rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .cta__inner--reframed .section-heading__title,
        .cta__inner--reframed .section-heading__desc {
            color: hsl(var(--white));
        }

        .cta__inner--reframed .section-heading__desc {
            color: rgba(255, 255, 255, 0.72);
        }

        .cta__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }
    </style>
@endpush
