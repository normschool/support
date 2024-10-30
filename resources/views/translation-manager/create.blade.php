<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.placeholder.new_language') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ html()->form('POST', url()->current())->id('addNewLanguage')->attribute('autocomplete', 'off')->open() }}
            <div class="modal-body">
                <div class="alert alert-danger display-none" id="validationErrorsBox"></div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.common.name') . ':', 'name') }}<span class="text-danger">*</span>
                        {{ html()->text('name')->class('form-control')->required()->attribute('onkeyup', 'if (/^$|\\s+/.test(this.value)) this.value = this.value.replace(/\\D/g,"")')->attribute('onkeypress', 'return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)') }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ html()->label('Code:', 'name') }}<span class="text-danger">*</span>
                        <span data-toggle="tooltip" data-html="true" data-original-title="Enter language short code. i.e: English = en.">
                            <i class="fas fa-question-circle"></i>
                        </span>
                        {{ html()->text('code')->class('form-control')->required()->maxlength('2')->attribute('onkeyup', 'if (/^$|\\s+/.test(this.value)) this.value = this.value.replace(/\\D/g,"")')->attribute('onkeypress', 'return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)') }}
                    </div>
                </div>
                
                <div class="text-right">
                    {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
                    <button type="button" id="btnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
