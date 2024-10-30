@extends('web.app')
@section('title')
    {{ __('messages.ticket.public_tickets') }}
@endsection
@push('css')
    @vite('resources/assets/css/landing-page-style.css')
    <link href="{{ asset('theme-assets/css/animate.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    @livewireStyles
@endpush
@section('content')
    <div class="container wow fadeInUp ">
        <h2 class="text-center text-primary mt-5 mb-md-5 mb-3">{{ __('messages.ticket.public_tickets') }}</h2>
        @livewire('list-public-ticket')
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    @include('livewire.livewire-turbo')
    <script>
        let ticketStatus = "{{ \App\Models\Ticket::STATUS_ACTIVE }}"
    </script>
    <script src="{{ asset('theme-assets/js/wow.min.js') }}"></script>
    @vite('resources/assets/js/web/tickets.js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endpush
