@extends('admin.layouts.master')

@section('title', isset($pageTitle) ? $pageTitle : 'User Profile')

@section('content')

<div class="flex items-center flex-wrap justify-between gap20 mb-27">
    <h3>User Profile</h3>
</div>

<div class="wg-box">
    <form class="form-style-1" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset class="name">
            <div class="body-title">Name <span class="tf-color-1">*</span></div>
            <input class="flex-grow @error('name') is-invalid @enderror" type="text" placeholder="Full Name" name="name" value="{{ old('name', $user->name ?? '') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Email <span class="tf-color-1">*</span></div>
            <input class="flex-grow @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" value="{{ old('email', $user->email ?? '') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Current Password</div>
            <input class="flex-grow @error('current_password') is-invalid @enderror" type="password" placeholder="Current Password" name="current_password">
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">New Password</div>
            <input class="flex-grow @error('new_password') is-invalid @enderror" type="password" placeholder="New Password" name="new_password">
            @error('new_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Confirm New Password</div>
            <input class="flex-grow" type="password" placeholder="Confirm New Password" name="new_password_confirmation">
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Profile Picture</div>
            <div class="upload-image flex-grow">
                <div class="item img-preview-profile" style="{{ !empty($user->profile_picture) ? '' : 'display: none;' }}">
                    <img class="effect8 preview-img-profile" src="{{ !empty($user->profile_picture) ? asset('storage/' . $user->profile_picture) : '' }}" style="max-width: 150px; max-height: 150px;">
                </div>
                <div class="item up-load">
                    <label class="uploadfile" for="profile_picture">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <span class="body-text">Drop your image here or <span class="tf-color">click to browse</span></span>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewSelectedImage(event, 'profile')">
                    </label>
                </div>
            </div>
            @error('profile_picture')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </fieldset>

        <div class="bot">
            <button class="tf-button w208" type="submit">Update</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    function previewSelectedImage(event, key) {
        let reader = new FileReader();
        reader.onload = function () {
            document.querySelector('.preview-img-' + key).src = reader.result;
            document.querySelector('.img-preview-' + key).style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
