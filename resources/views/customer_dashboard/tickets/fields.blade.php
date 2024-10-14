<div class="row">
    {{ html()->hidden('email', Auth::user()->email) }}
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.ticket.ticket_title') . ':', 'title') }}<span class="text-danger">*</span>
        {{ html()->text('title')->class('form-control')->required()->autofocus('true')->id('title') }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.category.category') . ':', 'category_id') }}<span class="text-danger">*</span>
        {{ html()->select('category_id', $data['categories'])->id('categoryId')->class('form-control')->placeholder(__('messages.admin_dashboard.select_category'))->required() }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        <div class="selectgroup selectgroup-pills">
            {{ html()->label(__('messages.ticket.ticket_type') . ':', 'is_public') }}
            <div class="row ticket-type-add">
                <label class="selectgroup-item mb-0 ml-3 public-ticket-select-w">
                    <input type="radio" name="is_public" value="1" class="selectgroup-input">
                    <span
                            class="selectgroup-button ">{{ __('messages.ticket.is_public') }}</span>
                </label>
                <label class="selectgroup-item mb-0 private-ticket-add public-ticket-select-w">
                    <input type="radio" name="is_public" value="0" class="selectgroup-input" checked="">
                    <span
                            class="selectgroup-button custom-ticket-new">{{ __('messages.ticket.is_private') }}</span>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.ticket.attachments') . ':', 'attachment') }}
        <span><span id="attachment-counter">0</span> {{ strtolower(__('messages.ticket.attachments')) }}</span>
        <div class="d-flex">
            <a href="javascript:void(0)" id="attachmentButton" class="btn btn-primary px-8"
               data-toggle="modal" data-target="#addAttachment">
                {{ __('messages.ticket.attachments') }}
            </a>
        </div>
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ html()->label(__('messages.common.description') . ':', 'description') }}<span class="text-danger">*</span>
        {{ html()->textarea('description')->class('form-control')->id('details')->rows('5') }}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
        <a href="{{ route('customer.myTicket') }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
