@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-5">{{ __('Profile') }}</h2>
            <div class="mb-4">
                @include('profile.partials.update-profile-information-form')
            </div>
            @if(Auth::check() && Auth::id() === $user->id)
                <div class="mb-4">
                    @include('profile.partials.update-password-form')
                </div>
            @endif
            <div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
