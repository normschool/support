<div class="row">
    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.common.name') . ':', 'name') }}<span class="text-danger">*</span>
        {{ html()->text('name')->class('form-control')->required()->autofocus('true') }}
    </div>
    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.common.email') . ':', 'email') }}<span class="text-danger">*</span>
        {{ html()->email('email')->class('form-control')->attribute('required', )->id('editEmail') }}
    </div>
    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">
        {{ html()->label(__('messages.common.phone') . ':', 'phone') }}<span class="text-danger">*</span><br>
        <div class="d-flex">
            <div class="region-code">
                <button type="button" class="btn btn-default mr-0 f16 dropdown-toggle region-code-button"
                        id="dropdownMenuButton" data-toggle="dropdown">
                <span class="flag {{ (isset($user) && !empty($user->region_code_flag)) ? $user->region_code_flag : 'in' }}"
                      id="btnFlag"></span>
                    <span class="btn-cc">&nbsp;&nbsp;{{ isset($user) ? '+'.$user->region_code : '+91' }}&nbsp;&nbsp;</span>
                    <span class="caretButton"></span>
                </button>
                <div class="region-code-div" aria-labelledby="dropdownMenuButton">
                    <ul class="f16 dropdown-menu region-code-ul">
                        <div class="region-code-ul-input-div"><input type="text" class="form-control search-country"/>
                        </div>
                        <div class="region-code-ul-div"></div>
                    </ul>
                </div>
            </div>
            <input type="tel" class="form-control" name="phone" id="phoneNumber"
                   value="{{ isset($user) ? $user->phone :null }}"
                   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required/>
            <input type="hidden" name="region_code" id="regionCode"
                   value="{{ isset($user) ? $user->region_code : null }}"/>
            <input type="hidden" name="region_code_flag" id="regionCodeFlag"
                   value="{{ isset($user) ? $user->region_code_flag : null }}"/>
        </div>
    </div>
    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-12">
        {{ html()->label(__('messages.user.gender') . ':', 'gender') }}<br>
        <div class="selectgroup selectgroup-pills">
            <label class="selectgroup-item">
                {{ html()->radio('gender', true, \App\Models\User::MALE)->class('selectgroup-input') }}
                <span class="selectgroup-button selectgroup-button-icon gender-pill" data-toggle="tooltip"
                      data-placement="bottom" title="{{ __('messages.common.male') }}"><i class="fa fa-male"></i></span>
            </label>
            <label class="selectgroup-item">
                {{ html()->radio('gender', false, \App\Models\User::FEMALE)->class('selectgroup-input') }}
                <span class="selectgroup-button selectgroup-button-icon gender-pill" data-toggle="tooltip"
                      data-placement="bottom" title="{{ __('messages.common.female') }}"><i class="fa fa-female"></i></span>
            </label>
        </div>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-4 col-sm-12">
        <span id="userProfilePictureValidationErrorsBox" class="text-danger d-none"></span>
        <div class="d-flex">
            <div>
                {{ html()->label(__('messages.user.profile') . ':', 'profile_picture') }}
                <label class="image__file-upload text-white"> {{ __('messages.common.choose') }}
                    {{ html()->file('image')->id('userProfilePicture')->class('d-none') }}
                </label>
            </div>
            <div>
                <img id='userProfilePicturePreview' class="thumbnail-preview user-profile-img"
                     src="{{ $user->photo_url ? $user->photo_url : asset('assets/img/infyom-logo.png')}}">
            </div>
        </div>
    </div>
    <div class="form-group col-sm-12 custom-editor">
        {{ html()->label(__('messages.user.about') . ':', 'about') }}
        {{ html()->textarea('about', $user->description)->id('editAbout')->class('form-control')->rows('5') }}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
        <a href="{{ $isAgent ? route('agent.index') : route('customer.index') }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
