<div id="createCustomerModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content left-margin">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.customer.add_customer') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ html()->form('POST', url()->current())->id('createCustomer')->acceptsFiles()->attribute('autocomplete', 'off')->open() }}
            <div class="modal-body">
                {{ html()->hidden('role', getCustomerRoleId()) }}
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ html()->label(__('messages.common.name') . ':', 'name') }}<span
                                class="text-danger">*</span>
                        {{ html()->text('name')->id('customerFirstName')->class('form-control')->required() }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ html()->label(__('messages.common.email') . ':', 'email') }}<span class="text-danger">*</span>
                        {{ html()->email('email')->id('customerEmail')->class('form-control')->attribute('required', ) }}
                    </div>

                    <div class="form-group col-sm-6">
                        {{ html()->label(__('messages.common.password') . ':', 'password') }}<span
                                class="text-danger">*</span>
                        <div class="input-group">
                            <input name="password" type="password" id="password"
                                   class="form-control">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="javascript:void(0)" class="" onclick="showPassword('password')">
                                        <i class="fa fa-eye-slash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        {{ html()->label(__('messages.common.confirm_password') . ':', 'password_confirmation') }}<span
                                class="text-danger">*</span>
                        <div class="input-group">
                            <input name="password_confirmation" type="password" id="confirmPassword"
                                   class="form-control" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="javascript:void(0)" class="" onclick="showPassword('confirmPassword')">
                                        <i class="fa fa-eye-slash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
                    <button type="button" class="btn btn-light left-margin"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
