@extends('settings.index')
@section('title')
    {{ __('messages.social_settings') }}
@endsection
@section('section')
    {{ html()->form('POST', route('settings.update'))->id('editForm')->attribute('autocomplete', 'off')->open() }}
    <div class="row mt-3">
        <div class="form-group col-sm-6">
            {{ html()->label(__('messages.setting.facebook_url') . ':', 'facebook_url') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-facebook-f facebook-fa-icon"></i>
                    </div>
                </div>
                {{ html()->text('facebook_url', $setting['facebook_url'])->class('form-control')->id('facebookUrl') }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ html()->label(__('messages.setting.twitter_url') . ':', 'twitter_url') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-twitter twitter-fa-icon"></i>
                    </div>
                </div>
                {{ html()->text('twitter_url', $setting['twitter_url'])->class('form-control')->id('twitterUrl') }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ html()->label(__('messages.setting.linkedIn_url') . ':', 'linkedIn_url') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-linkedin-in linkedin-fa-icon"></i>
                    </div>
                </div>
                {{ html()->text('linkedIn_url', $setting['linkedIn_url'])->class('form-control')->id('linkedInUrl') }}
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ html()->submit(__('messages.common.save'))->class('btn btn-primary')->id('btnSave')->data('loading-text', "<span class='spinner-border spinner-border-sm'></span>" . __('messages.placeholder.processing')) }}
            {{ html()->reset(__('messages.common.cancel'), ['class' => 'btn btn-light text-dark', 'id' => 'btn-reset']) }}
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection
