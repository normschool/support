@extends('customer_dashboard.app')
@section('title')
    {{ __('messages.ticket.add_ticket') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('theme-assets/css/dropzone.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/ticket.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mr-3">{{ __('messages.ticket.add_ticket') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('customer.myTicket') }}"
                   class="btn btn-primary form-btn float-right my-sm-0 my-1">{{__('messages.common.back')}}</a>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.errors')
            <div class="card">
                <div class="card-body">
                    {{ html()->form('POST', route('customer.ticket.store'))->acceptsFiles()->id('addTicketForm')->attribute('autocomplete', 'off')->open() }}

                    @include('customer_dashboard.tickets.fields')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>

        @include('customer_dashboard.tickets.ticket_attachment_modal')
    </section>

@endsection
@push('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ mix('assets/js/customer_dashboard/tickets.js')}}"></script>
@endpush
