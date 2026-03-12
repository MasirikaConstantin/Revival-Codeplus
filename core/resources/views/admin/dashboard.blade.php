@extends('admin.layouts.app')

@section('panel')
    @php
        $pendingProducts = \App\Models\Product::pending()->count();
        $approvedProducts = \App\Models\Product::approved()->count();
        $reviewers = \App\Models\Reviewer::count();
        $featuredProducts = \App\Models\Product::where('is_featured', \App\Constants\Status::YES)->count();
    @endphp

    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.users.all') }}" icon="las la-users" title="Total Users"
                      value="{{ $widget['total_users'] }}" bg="primary" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.users.active') }}" icon="las la-user-check" title="Active Users"
                      value="{{ $widget['verified_users'] }}" bg="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.users.email.unverified') }}" icon="lar la-envelope"
                      title="Email Unverified Users" value="{{ $widget['email_unverified_users'] }}" bg="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="6" link="{{ route('admin.users.mobile.unverified') }}" icon="las la-comment-slash"
                      title="Mobile Unverified Users" value="{{ $widget['mobile_unverified_users'] }}" bg="warning" />
        </div>
    </div>

    <div class="row gy-4 mt-2">
        <div class="col-12">
            <div class="alert alert-info mb-0">
                @lang('Catalogue mode is active. Sales, payments, withdrawals, refunds, and transaction widgets are hidden from this dashboard.')
            </div>
        </div>
    </div>

    <div class="row gy-4 mt-2">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" link="{{ route('admin.product.pending') }}" icon="las la-hourglass-half f-size--56"
                      title="Pending Products" value="{{ $pendingProducts }}" bg="warning" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" link="{{ route('admin.product.approved') }}" icon="las la-check-circle f-size--56"
                      title="Approved Products" value="{{ $approvedProducts }}" bg="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" link="{{ route('admin.reviewer.all') }}" icon="las la-user-shield f-size--56"
                      title="Reviewers" value="{{ $reviewers }}" bg="info" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="7" link="{{ route('admin.product.approved') }}" icon="las la-star f-size--56"
                      title="Featured Products" value="{{ $featuredProducts }}" bg="primary" />
        </div>
    </div>

    <div class="row gy-4 mt-2">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">@lang('Catalogue Workflow')</h5>
                    <p class="text-muted mb-3">@lang('Use the reviewer queue to approve showcase products, then feature selected items from the approved list.')</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.product.pending') }}" class="btn btn-outline--warning">@lang('Review Pending Products')</a>
                        <a href="{{ route('admin.reviewer.all') }}" class="btn btn-outline--info">@lang('Manage Reviewers')</a>
                        <a href="{{ route('admin.product.approved') }}" class="btn btn-outline--success">@lang('Browse Approved Products')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">@lang('Frontend Content')</h5>
                    <p class="text-muted mb-3">@lang('Homepage sections now surface the latest catalogue items instead of sales-driven rankings.')</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.frontend.sections', 'marketplace') }}" class="btn btn-outline--primary">@lang('Edit Marketplace Section')</a>
                        <a href="{{ route('admin.frontend.sections', 'weekly_selling_product') }}" class="btn btn-outline--primary">@lang('Edit Latest Products Section')</a>
                        <a href="{{ route('admin.frontend.manage.pages') }}" class="btn btn-outline--dark">@lang('Manage Pages')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
