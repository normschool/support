<div id="changePasswordModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content border-radius">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.user.change_password') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ html()->form('POST', url()->current())->id('changePasswordForm')->open() }}
            <div class="modal-body">
                <div class="alert alert-danger" id="passwordValidationErrorBox"></div>
                {{ html()->hidden('user_id')->id('pfUserId') }}
                {{ html()->hidden('is_active', 1) }}
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.user.current_password') . ':', 'current password') }}<span
                                class="text-danger">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfCurrentPassword" type="password"
                                   name="password_current" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="javascript:void(0)" class="text-dark"
                                       onclick="showPassword('pfCurrentPassword')">
                                        <i class="fa fa-eye-slash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.user.new_password') . ':', 'password') }}<span
                                class="text-danger">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewPassword" type="password"
                                   name="password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="javascript:void(0)" class="text-dark"
                                       onclick="showPassword('pfNewPassword')">
                                        <i class="fa fa-eye-slash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.common.confirm_password') . ':', 'password_confirmation') }}<span
                                class="text-danger">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewConfirmPassword" type="password"
                                   name="password_confirmation" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="javascript:void(0)" class="text-dark"
                                       onclick="showPassword('pfNewConfirmPassword')">
                                        <i class="fa fa-eye-slash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnPrPasswordEditSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
                    <button type="button" class="btn btn-light border-radius"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
