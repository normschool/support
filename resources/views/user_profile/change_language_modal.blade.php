<div id="changeLanguageModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content left-margin">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.user_language.change_language') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
                {{ csrf_field() }}
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="changeLanguageValidationErrorsBox"></div>
                {{ html()->form('POST', url()->current())->id('changeLanguageForm')->open() }}
                <div class="row">
                    <div class="form-group col-12">
                        {{ html()->label(__('messages.user_language.language') . ':', 'default_language') }}<span
                                class="text-danger">*</span>
                        {{ html()->select('default_language', LANGUAGES, getLoggedInUser()->default_language)->id('defaultLanguage')->class('form-control')->required() }}
                    </div>
                </div>
                <div class="text-right">
                    {{ html()->submit(__('messages.common.save'))->class('btn btn-primary mr-2')->id('btnLanguageChange')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
                    <button type="button" class="btn btn-light left-margin"
                            data-dismiss="modal">{{ __('messages.common.cancel') }} </button>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>
