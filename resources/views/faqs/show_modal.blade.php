<div class="modal fade" tabindex="-1" role="dialog" id="showModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.faq.faq_details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ html()->form('POST', url()->current())->id('showForm')->open() }}
            <div class="modal-body">
                <div class="row details-page">
                    <div class="form-group col-sm-12">
                        {{ html()->label(__('messages.faq.title') . ':', 'name') }}<br>
                        <span id="showName"></span>
                    </div>
                    <div class="form-group col-sm-12 faqs-description">
                        {{ html()->label(__('messages.faq.description') . ':', 'description') }}<br>
                        <span id="showDescription"></span>
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
