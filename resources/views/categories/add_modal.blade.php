<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.category.add_category') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ html()->form('POST', url()->current())->id('addNewForm')->attribute('autocomplete', 'off')->open() }}
            <div class="modal-body">
                <div class="alert alert-danger display-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.common.name') . ':', 'name') }}<span class="text-danger">*</span>
                        {{ html()->text('name')->class('form-control')->required() }}
                    </div>
                    <div class="form-group col-sm-12 position-relative">
                        {{ html()->label(__('messages.common.color') . ':', 'color') }}<span class="text-danger">*</span>
                        <div class="color-wrapper">
                        </div>
                        {{ html()->text('color', '')->id('color')->attribute('hidden', )->class('form-control color') }}
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
