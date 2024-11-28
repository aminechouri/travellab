@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="pt-100 pb-100">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3">
                    <button class="action-sidebar-open"><i class="las la-sliders-h"></i> @lang('Filter')</button>
                    <div class="action-sidebar">
                        <button class="action-sidebar-close"><i class="las la-times"></i></button>
                        <form action="{{ route('plans') }}" method="GET">
                            <div class="action-widget widget--shadow">
                                <h4 class="action-widget__title no-icon">@lang('Search')</h4>
                                <div class="action-widget__body">
                                    <input class="form--control form-control-sm" name="search" type="search" value="{{ request()->search }}" autocomplete="off" placeholder="@lang('Search here')">
                                </div>
                                <h6 class="action-widget__title mt-4 no-icon">@lang('Filter by price')</h6>
                                <div class="action-widget__body">
                                    <div class="row">
                                        <div class="col-6">
                                            <input class="form--control form-control-sm" name="min_price" type="text" value="{{ request()->min_price }}" autocomplete="off" placeholder="@lang('min')">
                                        </div>
                                        <div class="col-6">
                                            <input class="form--control form-control-sm" name="max_price" type="text" value="{{ request()->max_price }}" autocomplete="off" placeholder="@lang('max')">
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $selectedCategories = request('category_id', []);
                                    $selectedLocations = request('location_id', []);
                                @endphp

                                <h4 class="action-widget__title mt-4 no-icon">@lang('Category')</h4>
                                <div class="action-widget__body">
                                    @foreach (@$categories as $category)
                                        <div class="form-check d-flex justify-content-between">
                                            <div class="left">
                                                <input class="form-check-input" id="chekbox-{{ $category->id }}" name="category_id[]" type="checkbox" value="{{ $category->id }}" @if (in_array($category->id, $selectedCategories)) checked @endif>
                                                <label class="form-check-label" for="chekbox-{{ $category->id }}">
                                                    {{ __($category->name) }}
                                                </label>
                                            </div>
                                            <label class="fs--14px mt-1" for="chekbox-{{ $category->id }}">({{ $category->plans()->count() }})</label>
                                        </div><!-- form-check end -->
                                    @endforeach
                                </div>

                                <h4 class="action-widget__title mt-4 no-icon">@lang('Location')</h4>
                                <div class="action-widget__body">
                                    @foreach (@$locations as $location)
                                        <div class="form-check d-flex justify-content-between">
                                            <div class="left">
                                                <input class="form-check-input" id="chekbox-{{ $location->id }}" name="location_id[]" type="checkbox" value="{{ $location->id }}" @if (in_array($location->id, $selectedLocations)) checked @endif>
                                                <label class="form-check-label" for="chekbox-{{ $location->id }}">
                                                    {{ __($location->name) }}
                                                </label>
                                            </div>
                                            <label class="fs--14px mt-1" for="chekbox-{{ $location->id }}">({{ $location->plans()->count() }})</label>
                                        </div><!-- form-check end -->
                                    @endforeach
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-sm btn--base w-100" type="submit"> <i class="las la-filter"></i> @lang('Filter')</button>
                                    </div>
                                </div>
                            </div><!-- action-widget end -->
                        </form>
                        <div class="action-widget">
                            @php
                                echo getAdvertisement('270x385');
                            @endphp

                            @php
                                echo getAdvertisement('270x385');
                            @endphp
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">

                    <div class="row gy-4">

                        @forelse($plans as $plan)
                            @include($activeTemplate . 'partials.plan', ['col' => 'col-xl-4 col-sm-6'])
                        @empty
                            <div class="col-12 text-center">
                                @include($activeTemplate . 'partials.empty', ['message' => 'Tour plan not found!'])
                            </div>
                        @endforelse

                    </div>
                    <div class="py-3">
                        @php  echo getAdvertisement('728x90');  @endphp
                    </div>

                    <div class="text-end mt-5 pagination-md">
                        {{ paginateLinks($plans) }}
                    </div>

                    <div class="py-3">
                        @php  echo getAdvertisement('970x250');  @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection