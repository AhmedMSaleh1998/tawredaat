@extends('Admin.index')
@section('orderStatus-active', 'm-menu__item--active m-menu__item--open')
@section('orderStatus-create-active', 'm-menu__item--active')
@section('page-title', 'Order Status|Create')
@section('content')
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            {{ $MainTitle }}
                        </h3>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <div class="m-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--begin::Portlet-->
                                <div class="m-portlet">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon m--hide">
                                                    <i class="la la-gear"></i>
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    {{ $SubTitle }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Form-->
                                    <form method="POST" action="{{ route('order_statuses.store') }}"
                                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                        @csrf
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6">
                                                    <label>Name in english</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input name="name_en" value="{{ old('name_en') }}" required
                                                            type="text" class="form-control m-input"
                                                            placeholder="Enter name in english...">
                                                    </div>
                                                    @error('name_en')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Name in arabic</label>
                                                    <input type="text" value="{{ old('name_ar') }}" name="name_ar"
                                                        required class="form-control m-input"
                                                        placeholder="Enter name in arabic...">
                                                    @error('name_ar')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6">
                                                    <label>Status Color</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input name="color" value="{{ old('color') }}" required
                                                            type="color" class=" m-input" placeholder="Color">
                                                    </div>
                                                    @error('color')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-6">

                                                    <label class="" for="check">Is Active</label>
                                                    <input type="checkbox" id="check" name="is_active" value="1"
                                                        class="form-control m-input">
                                                    @error('is_active')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                            <div class="m-form__actions m-form__actions--solid">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                    </div>
                                                    <div class="col-lg-6 m--align-right">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Portlet-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End::Section-->
            </div>
        </div>
    </div>
@endsection
<!-- end:: Body -->
