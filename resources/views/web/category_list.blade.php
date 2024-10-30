@extends('web.app')
@section('title')
    {{ __('messages.category.categories') }}
@endsection
@push('css')
    @vite('resources/assets/css/landing-page-style.css')
    <link href="{{ asset('theme-assets/css/animate.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    @livewireStyles
@endpush
@section('content')
    <div class="container wow fadeInUp">
        @livewire('list-categories')
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    @include('livewire.livewire-turbo')
    <script src="{{ asset('theme-assets/js/wow.min.js') }}"></script>
    @vite('resources/assets/js/web/tickets.js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endpush
