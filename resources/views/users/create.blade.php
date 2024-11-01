@extends('layouts.app')
@section('title')
    {{ $isAgent ? __('messages.agent.add_agent') : __('messages.customer.add_customer') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mr-3">{{ $isAgent ? __('messages.agent.add_agent') : __('messages.customer.add_customer') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ $isAgent ? route('agent.index') : route('customer.index') }}"
                   class="btn btn-primary form-btn float-right my-sm-0 my-1">{{__('messages.common.back')}}</a>
            </div>
        </div>
        <div class="section-body">
            @include('layouts.errors')
            <div class="card">
                <div class="card-body">
                    {{ html()->form('POST', route('user.store'))->acceptsFiles()->id('addusersForm')->attribute('autocomplete', 'off')->open() }}

                    @include('users.fields')

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let isEdit = false;
        let phoneNo = "{{ old('region_code').old('phone') }}";
        let utilsScript = "{{asset('assets/js/inttel/js/utils.min.js')}}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/users/create_edit.js')}}"></script>
@endpush
