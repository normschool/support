@extends('settings.index')
@section('title')
    {{ __('messages.setting.general') }}
@endsection
@section('section')
    {{ html()->form('POST', route('settings.update'))->acceptsFiles()->id('settingForm')->attribute('autocomplete', 'off')->open() }}
    <div class="row mt-3">
        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            {{ html()->label(__('messages.setting.application_name') . ':', 'application_name') }}<span
                    class="text-danger">*</span>
            {{ html()->text('application_name', $setting['application_name'])->class('form-control')->required()->id('application_name') }}
        </div>
        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            {{ html()->label(__('messages.setting.email') . ':', 'email') }}<span class="text-danger">*</span>
            {{ html()->email('email', $setting['email'])->class('form-control')->attribute('required', )->id('email') }}
        </div>
        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            {{ html()->label(__('messages.common.phone') . ':', 'phone') }}<span class="text-danger">*</span><br>
            <div class="d-flex">
                <div class="region-code">
                    <button type="button" class="btn btn-default mr-0 f16 dropdown-toggle region-code-button"
                            id="dropdownMenuButton" data-toggle="dropdown">
                <span class="flag {{ (isset($setting['region_code_flag'])) && !empty($setting['region_code_flag']) ? $setting['region_code_flag'] : 'in' }}"
                      id="btnFlag"></span>
                        <span class="btn-cc">&nbsp;&nbsp;{{ isset($setting['region_code']) ? '+'.$setting['region_code'] : '+91' }}&nbsp;&nbsp;</span>
                        <span class="caretButton"></span>
                    </button>
                    <div class="region-code-div" aria-labelledby="dropdownMenuButton">
                        <ul class="f16 dropdown-menu region-code-ul">
                            <div class="region-code-ul-input-div"><input type="text"
                                                                         class="form-control search-country"/>
                            </div>
                            <div class="region-code-ul-div"></div>
                        </ul>
                    </div>
                </div>
                <input type="tel" class="form-control" name="phone" id="phoneNumber"
                       value="{{ $setting['phone'] ?? null }}"
                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required/>
                <input type="hidden" name="region_code" id="regionCode" value="{{ $setting['region_code'] ?? null }}"/>
                <input type="hidden" name="region_code_flag" id="regionCodeFlag"
                       value="{{ $setting['region_code_flag'] ?? null }}"/>
            </div>
        </div>
        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            {{ html()->label(__('messages.setting.default_country_code') . ':', 'default_country_code')->class('form-label') }}
            <span class="required"></span>
            <div class="d-flex">
                <div class="default-country-data">
                    <button type="button" class="btn btn-default mr-0 f16 dropdown-toggle region-code-button"
                            id="dropdownMenuButton" data-toggle="dropdown">
                <span class="flag {{ (isset($setting['default_country_code'])) && !empty($setting['default_country_code']) ? $setting['default_country_code'] : 'in' }}"
                      id="btnFlag"></span>
                        <span class="btn-cc">&nbsp;&nbsp;{{ isset($setting['default_region_code']) ? '+'.$setting['default_region_code'] : '+91' }}&nbsp;&nbsp;</span>
                        <span class="caretButton"></span>
                    </button>
                    <div class="region-code-div" aria-labelledby="dropdownMenuButton">
                        <ul class="f16 dropdown-menu region-code-ul">
                            <div class="region-code-ul-input-div-items"><input type="text"
                                                                               class="form-control search-country"/>
                            </div>
                            <div class="region-code-ul-div-items"></div>
                        </ul>
                    </div>
                </div>
                <input type="tel" class="form-control " id="defaultCountryData"
                       value=""
                       readonly required/>
                <input type="hidden" name="default_region_code" id="defaultRegionCode"
                       value="{{ $setting['default_region_code'] ?? null }}"/>
                <input type="hidden" name="default_country_code" id="defaultCountryCode"
                       value="{{ $setting['default_country_code'] ?? null }}"/>
            </div>
        </div>

        <div class="form-group col-sm-12">
            {{ html()->label(__('messages.setting.about_us') . ':', 'about_us') }}<span
                    class="text-danger">*</span>
            {{ html()->textarea('about_us', $setting['about_us'])->class('form-control address-height')->id('aboutUs')->required()->attribute('row', 4) }}
        </div>
        <div class="form-group col-sm-12">
            {{ html()->label(__('messages.setting.address') . ':', 'company_address') }}<span class="text-danger">*</span>
            {{ html()->textarea('address', $setting['address'])->class('form-control address-height')->attribute('row', 4)->required()->id('company_address') }}
        </div>
        {{--        <div class="form-group col-sm-12">--}}
        {{--            {{ html()->label(__('messages.setting.company_description') . ':', 'company_description') }}<span--}}
        {{--                    class="text-danger">*</span>--}}
        {{--            {{ html()->textarea('company_description', $setting['company_description'])->class('form-control')->id('company_description') }}--}}
        {{--        </div>--}}
    </div>
    <div class="row">
        <!-- Logo Field -->
        <div class="form-group col-sm-5">
            <div class="row">
                <div class="px-3">
                    {{ html()->label(__('messages.setting.logo') . ':', 'app_logo') }}<span class="text-danger">*</span>
                    <span data-toggle="tooltip" data-html="true"
                          title="{{ __('messages.setting.logo_tooltip') }}"><i
                                class="fas fa-question-circle"></i></span>
                    <label class="image__file-upload text-white"> {{ __('messages.setting.choose') }}
                        {{ html()->file('logo')->id('logo')->class('d-none') }}
                    </label>
                </div>
                <div class="col-sm-5 col-md-5 col-xl-6 col-5 pl-2 mt-1">
                    <img id='logoPreview' class="img-thumbnail thumbnail-preview"
                         src="{{($setting['logo']) ? asset($setting['logo']) : asset('assets/img/infyom-logo.png')}}">
                </div>
            </div>
        </div>
        <div class="form-group col-sm-5">
            <div class="row">
                <div class="px-3">
                    {{ html()->label(__('messages.setting.favicon') . ':', 'favicon') }}<span class="text-danger">*</span>
                    <span data-toggle="tooltip" data-html="true"
                          title="{{ __('messages.setting.fav_icon_tooltip') }}"><i
                                class="fas fa-question-circle"></i></span>
                    <label class="image__file-upload text-white"> {{ __('messages.setting.choose') }}
                        {{ html()->file('favicon')->id('favicon')->class('d-none') }}
                    </label>
                </div>
                <div class="col-sm-5 col-md-5 col-xl-5 col-5 pl-2 mt-1">
                    <img id='faviconPreview' class="img-thumbnail thumbnail-preview"
                         src="{{ ($setting['favicon']) ? asset($setting['favicon']) : asset('assets/img/infyom-logo.png') }}">
                </div>
            </div>
        </div>
        <div class="col-sm-2 form-group ">
            <div class="row">
                <div class="col-sm-12 col-md-12 form-group">
                    {{ html()->label(__('messages.setting.current_version') . ':', 'version') }}
                    <br>
                    <span>{{ $currentVersion }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
            <a href="{{ route('settings.index') }}"
               class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection
@push('scripts')
    <script>
        let isEdit = true
        let phoneNo = "{{ old('region_code').old('phone') }}"
        let utilsScript = "{{asset('assets/js/inttel/js/utils.min.js')}}"
    </script>
@endpush
