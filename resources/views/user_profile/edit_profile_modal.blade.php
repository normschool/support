<div id="editProfileModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content left-margin">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.user.edit_profile') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ html()->form('POST', url()->current())->id('editProfileForm')->acceptsFiles()->attribute('autocomplete', 'off')->open() }}
            <div class="modal-body">
                {{ html()->hidden('user_id')->id('editUserId') }}
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ html()->label(__('messages.common.name') . ':', 'name') }}<span
                                class="text-danger">*</span>
                        {{ html()->text('name')->id('firstName')->class('form-control')->required() }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ html()->label(__('messages.common.email') . ':', 'email') }}<span class="text-danger">*</span>
                        {{ html()->email('email')->id('userEmail')->class('form-control')->attribute('required', ) }}
                    </div>

                    <div class="form-group col-sm-6">
                        <span id="profilePictureValidationErrorsBox" class="text-danger d-none"></span>
                        <div class="row">
                            <div class="col-4 col-sm-4 col-xl-3">
                                {{ html()->label(__('messages.user.profile') . ':', 'profile_picture') }}
                                <label class="image__file-upload text-white"> {{ __('messages.common.choose') }}
                                    {{ html()->file('image')->id('profilePicture')->class('d-none') }}
                                </label>
                            </div>
                            <div class="col-3 pl-0 mt-1 float-right">
                                <img id='profilePicturePreview' class="thumbnail-preview w-75 user-edit-profile-img"
                                     src="{{ asset('assets/img/infyom-logo.png') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        {{ html()->label(__('messages.common.phone') . ':', 'phone') }}<span
                                class="text-danger">*</span><br>
                        <div class="d-flex">
                            <div class="region-code">
                                <button type="button"
                                        class="btn btn-default mr-0 f16 dropdown-toggle region-code-button"
                                        id="dropdownMenuButton" data-toggle="dropdown">
                                    <span class="flag edit_profile_flag" id="btnFlag"></span>
                                    <span class="btn-cc editProfileBtnCc">&nbsp;&nbsp;+91&nbsp;&nbsp;</span>
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
                            <input type="tel" class="form-control" name="phone" id="userPhone"
                                   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                   required/>
                            <input type="hidden" name="region_code" class="edit_profile_region_code" id="regionCode"
                                   value="91"/>
                            <input type="hidden" name="region_code_flag" class="edit_profile_region_code_flag"
                                   id="regionCodeFlag" value="in"/>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnPrEditSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
                    <button type="button" class="btn btn-light left-margin"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
