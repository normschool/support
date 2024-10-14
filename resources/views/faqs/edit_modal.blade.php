<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.faq.edit_faq') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ html()->form('POST', url()->current())->id('editForm')->attribute('autocomplete', 'off')->open() }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ html()->hidden('faqId')->id('faqId') }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.faq.title') . ':', 'title') }}<span class="text-danger">*</span>
                        {{ html()->text('title')->class('form-control')->required()->id('editTitle') }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.faq.description') . ':', 'description') }}<span
                                class="text-danger">*</span>
                        {{ html()->textarea('description')->class('form-control')->id('editDescription')->rows('5') }}
                    </div>
                </div>
                <div class="text-right">
                    {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnEditSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
                    <button type="button" id="btnEditCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
