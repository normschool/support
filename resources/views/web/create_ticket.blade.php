@extends('web.app')
@section('title')
    {{ __('messages.ticket.submit_ticket') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('theme-assets/css/dropzone.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/ticket.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center card-primary shadow large-card">
            <h2 class="display-sm-2 my-md-4 my-2 text-center">{{ __('messages.ticket.submit_ticket') }}</h2>
            <div class="card-body col-12 mt-0 pt-0">
                <form method="POST" action="{{ route('web.ticket.store') }}" autocomplete="off"
                      enctype="multipart/form-data"
                      id="webTicketForm">
                    @csrf
                    @include('flash::message')
                    @include('layouts.errors')
                    @if(!Auth::user())
                        <div class="row col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="registration-title pt-2 pb-2 mb-3 d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="registration-title-heading mb-0">{{ __('messages.common.for_registration') }}</h6>
                                <a href="{{ route('login') }}">{{ __('messages.web.already_have_an_account') }}</a>
                            </div>
                        </div>
                    @endif
                    @if(!Auth::user())
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-12">
                                {{ html()->label(__('messages.common.name') . ':', 'name') }}<span
                                        class="text-danger">*</span>
                                {{ html()->text('user_name')->class('form-control')->required()->attribute('tabindex', 1)->id('user-name')->placeholder(__('messages.web.enter_name')) }}
                            </div>
                            <div class="form-group  col-lg-6 col-md-12 col-sm-12 col-12">
                                {{ html()->label(__('messages.common.email') . ':', 'email') }}<span
                                        class="text-danger">*</span>
                                {{ html()->email('email')->class('form-control')->attribute('required', )->attribute('tabindex', 2)->attribute('placeholder', __('messages.web.enter_mail')) }}
                            </div>
                            <div class="form-group  col-lg-6 col-md-12 col-sm-12 col-12">
                                {{ html()->label(__('messages.common.password') . ':', 'password') }}<span
                                        class="text-danger">*</span>
                                <div class="input-group">
                                    {{ html()->password('password')->class('form-control')->attribute('required', )->id('password')->attribute('tabindex', 3)->attribute('placeholder', __('messages.login.enter_password')) }}
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <a href="javascript:void(0)" class=""
                                               onclick="showPassword('password')">
                                                <i class="fa fa-eye-slash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-12">
                                {{ html()->label(__('messages.common.confirm_password') . ':', 'confirm_password') }}<span
                                        class="text-danger">*</span>
                                <div class="input-group">
                                    {{ html()->password('confirm_password')->class('form-control')->attribute('required', )->id('confirmPassword')->attribute('tabindex', 4)->attribute('placeholder', __('messages.login.enter_confirm_password')) }}
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <a href="javascript:void(0)" class=""
                                               onclick="showPassword('confirmPassword')">
                                                <i class="fa fa-eye-slash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!Auth::user())
                        <div class="row col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="title-ticket pt-2 pb-2 mb-3">{{ __('messages.ticket.create_ticket') }}</h6>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-12">
                                {{ html()->label(__('messages.ticket.ticket_title') . ':', 'title') }}<span
                                        class="text-danger">*</span>
                                {{ html()->text('title')->class('form-control')->required()->attribute('tabindex', 5)->id('ticket-title')->placeholder(__('messages.web.enter_ticket_title')) }}
                            </div>
                            <div class="form-group  col-lg-6 col-md-12 col-sm-12 col-12">
                                {{ html()->label(__('messages.category.category') . ':', 'category_id') }}<span
                                        class="text-danger">*</span>
                                {{ html()->select('category_id', $category)->id('categoryId')->class('form-control')->placeholder(__('messages.admin_dashboard.select_category'))->required()->attribute('tabindex', 6) }}
                            </div>
                            <div class="form-group  col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="selectgroup selectgroup-pills">
                                    {{ html()->label(__('messages.ticket.ticket_type') . ':', 'is_public') }}<br>
                                    <label class="selectgroup-item mb-0">
                                        <input type="radio" name="is_public" value="1" class="selectgroup-input">
                                        <span class="selectgroup-button auto-height mb-2"><span><i class="fas fa-users"></i>&nbsp;</span>{{ __('messages.ticket.is_public') }}</span>
                                    </label>
                                    <label class="selectgroup-item mb-0">
                                        <input type="radio" name="is_public" value="0" class="selectgroup-input"
                                               checked="">
                                        <span class="selectgroup-button auto-height"><span><i class="fas fa-lock"></i>&nbsp;</span>{{ __('messages.ticket.is_private') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group  col-lg-6 col-md-12 col-sm-12 col-12">
                                {{ html()->label(__('messages.ticket.attachments') . ':', 'attachments') }}
                                <span><span id="attachment-counter">0</span> {{ strtolower(__('messages.ticket.attachments')) }}</span>
                                <div class="d-flex">
                                    <a href="javascript:void(0)" id="attachmentButton" class="btn btn-primary px-8"
                                       data-toggle="modal" data-target="#addAttachment">
                                        {{ __('messages.ticket.attachments') }}
                                    </a>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                {{ html()->label(__('messages.common.description') . ':', 'description') }}<span
                                        class="text-danger">*</span>
                                {{ html()->textarea('description')->class('form-control')->id('details')->rows('5') }}
                            </div>
                            <div class="text-center col-12 mt-2 mb-3">
                                <button type="submit" class="btn btn-rounded btn-primary mt-1 font-weight-bold btn-lg">
                                    {{ __('messages.ticket.submit_ticket') }}
                                </button>
                            </div>
                        </div>

                    @endif
                    @if(Auth::user())
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="title-ticket pl-2 pt-2 pb-2 mb-3">{{ __('messages.common.for_ticket') }}</h6>
                                <div class="form-group col-xl-12 col-md-12 col-sm-12">
                                    {{ html()->label(__('messages.ticket.ticket_title') . ':', 'title') }}<span
                                            class="text-danger">*</span>
                                    {{ html()->text('title')->class('form-control')->required()->attribute('tabindex', 5)->id('ticket-title')->placeholder(__('messages.web.enter_ticket_title')) }}
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group col-xl-12 col-md-12 col-sm-12">
                                            <div class="selectgroup selectgroup-pills">
                                                {{ html()->label(__('messages.ticket.ticket_type') . ':', 'is_public') }}
                                                <br>
                                                <label class="selectgroup-item mb-1">
                                                    <input type="radio" name="is_public" value="1"
                                                           class="selectgroup-input">
                                                    <span class="selectgroup-button auto-height"><span><i class="fas fa-users"></i>&nbsp;</span>{{ __('messages.ticket.is_public') }}</span>
                                                </label>
                                                <label class="selectgroup-item mb-0">
                                                    <input type="radio" name="is_public" value="0"
                                                           class="selectgroup-input" checked="">
                                                    <span class="selectgroup-button auto-height"><span><i class="fas fa-lock"></i>&nbsp;</span>{{ __('messages.ticket.is_private') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group col-xl-12 col-md-12 col-sm-12">
                                            {{ html()->label(__('messages.category.category') . ':', 'category_id') }}<span
                                                    class="text-danger">*</span>
                                            {{ html()->select('category_id', $category)->id('webCategoryId')->class('form-control')->placeholder(__('messages.admin_dashboard.select_category'))->required()->attribute('tabindex', 6) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    @if(Auth::user()->hasRole('Admin|Agent'))
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                            <div class="form-group col-xl-12 col-md-12 col-sm-12">
                                                {{ html()->label(__('messages.customer.customer') . ':', 'customer_id') }}<span
                                                        class="text-danger">*</span>
                                                {{ html()->select('customer_id', $customers)->id('customerId')->class('form-control')->placeholder(__('messages.user.select_customer'))->required() }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group col-xl-12 col-md-12 col-sm-12">
                                            {{ html()->label(__('messages.ticket.attachments') . ':', 'attachments') }}
                                            <span><span id="attachment-counter">0</span> {{ strtolower(__('messages.ticket.attachments')) }}</span>
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" id="attachmentButton" class="btn btn-primary px-8"
                                                   data-toggle="modal" data-target="#addAttachment">
                                                    {{ __('messages.ticket.attachments') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    {{ html()->label(__('messages.common.description') . ':', 'description') }}<span
                                            class="text-danger">*</span>
                                    {{ html()->textarea('description')->class('form-control')->id('details')->rows('5') }}
                                </div>
                            </div>
                            <div class="text-center col-12 mt-2 mb-3">
                                <button type="submit" class="btn btn-rounded btn-primary mt-1 font-weight-bold btn-lg">
                                    {{ __('messages.ticket.submit_ticket') }}
                                </button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <!-- Attachment Modal -->
    <div class="modal fade" id="addAttachment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.upload_files') }}</h5>
                    <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('web.ticket.store') }}"
                          class="dropzone ticket-attachment-dropzone"
                          id="addAttachmentDropzone">
                        {{ csrf_field() }}
                    </form>
                    <div class="d-flex mt-3 float-right">
                        <button id="save-file"
                                class="upload-file-btn btn btn-primary mr-2">{{ __('messages.upload_files') }}</button>
                        <button type="reset" id="cancel-upload-file"
                                class="upload-file-btn btn btn-light text-dark">{{ __('messages.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    @vite('resources/assets/js/tickets/create_edit.js')
@endpush
