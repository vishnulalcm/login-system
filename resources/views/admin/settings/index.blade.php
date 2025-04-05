@extends('admin.layouts.master')

@section('title', isset($pageTitle) ? $pageTitle : 'Page Title Here')

@section('content')

<div class="flex items-center flex-wrap justify-between gap20 mb-27">
    <h3>Setting</h3>
</div>

<!-- new-category -->
<div class="wg-box">

    <form class="form-new-product form-style-1" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <fieldset class="name">
            <div class="body-title">Company Name<span class="tf-color-1">*</span></div>
            <input class="flex-grow @error('company_name') is-invalid @enderror" type="text" placeholder="Company Name" name="company_name" value="{{ old('company_name', $settings->company_name ?? '') }}">
            @error('company_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Email <span class="tf-color-1">*</span></div>
            <input class="flex-grow @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" value="{{ old('email', $settings->company_email ?? '') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Company Phone <span class="tf-color-1">*</span></div>
            <input class="flex-grow @error('company_phone') is-invalid @enderror" type="text" placeholder="Company Phone" name="company_phone" value="{{ old('company_phone', $settings->company_phone ?? '') }}">
            @error('company_phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Company Phone (Landline)</div>
            <input class="flex-grow @error('company_phone_landline') is-invalid @enderror" type="text" placeholder="Company Phone Landline" name="company_phone_landline" value="{{ old('company_phone_landline', $settings->company_phone_landline ?? '') }}">
            @error('company_phone_landline')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Company Address <span class="tf-color-1">*</span></div>
            <textarea class="flex-grow @error('company_address') is-invalid @enderror summernote" placeholder="Company Address" name="company_address">{{ old('company_address', $settings->company_address ?? '') }}</textarea>
            @error('company_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Company Logo</div>
            <div class="upload-image flex-grow">
                <div class="item img-preview-logo" style="{{ !empty($settings->logo) ? '' : 'display: none;' }}">
                    <p>Recommended size: 200 x 200</p>
                    <img class="effect8 preview-img-logo"
                        src="{{ !empty($settings->logo) ? asset('storage/' . $settings->logo) : '' }}"
                        style="max-width: 150px; max-height: 150px;">
                </div>
                <div class="item up-load">
                    <label class="uploadfile" for="logo">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <span class="body-text">Drop your images here or select
                            <span class="tf-color">click to browse</span>
                        </span>
                        <input type="file" id="logo" name="logo" accept="image/*" onchange="previewSelectedImage(event, 'logo')">
                    </label>
                </div>
            </div>
            @error('logo')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Favicon</div>
            <div class="upload-image flex-grow">
                <div class="item img-preview-favicon" style="{{ !empty($settings->favicon) ? '' : 'display: none;' }}">
                    <p>Recommended size: 32 x 32</p>
                    <img class="effect8 preview-img-favicon"
                        src="{{ !empty($settings->favicon) ? asset('storage/' . $settings->favicon) : '' }}"
                        style="max-width: 50px; max-height: 50px;">
                </div>
                <div class="item up-load">
                    <label class="uploadfile" for="favicon">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <span class="body-text">Drop your images here or select
                            <span class="tf-color">click to browse</span>
                        </span>
                        <input type="file" id="favicon" name="favicon" accept="image/*" onchange="previewSelectedImage(event, 'favicon')">
                    </label>
                </div>
            </div>
            @error('favicon')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">About Us</div>
            <textarea class="flex-grow @error('about_us') is-invalid @enderror summernote" name="about_us">{{ old('about_us', $settings->about_us ?? '') }}</textarea>
            @error('about_us')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Privacy Policy</div>
            <textarea class="flex-grow @error('privacy_policy') is-invalid @enderror summernote" name="privacy_policy">{{ old('privacy_policy', $settings->privacy_policy ?? '') }}</textarea>
            @error('privacy_policy')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="name">
            <div class="body-title">Terms of Service</div>
            <textarea class="flex-grow @error('terms_of_service') is-invalid @enderror summernote" name="terms_of_service">{{ old('terms_of_service', $settings->terms_of_service ?? '') }}</textarea>
            @error('terms_of_service')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>

        <div class="bot">
            <button class="tf-button w208" type="submit">Update</button>
        </div>
    </form>
</div>

@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            minHeight: 150,
            maxHeight: 400,
            focus: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
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
