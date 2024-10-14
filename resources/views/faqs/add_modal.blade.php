<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="faqHeader">{{ __('messages.faq.new_faq') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ html()->form('POST', url()->current())->id('addNewForm')->attribute('autocomplete', 'off')->acceptsFiles()->open() }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.faq.title') . ':', 'title') }}<span class="text-danger">*</span>
                        {{ html()->text('title')->class('form-control')->required() }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.faq.description') . ':', 'description') }}<span
                                class="text-danger">*</span>
                        {{ html()->textarea('description')->class('form-control')->id('description')->rows('5') }}
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
