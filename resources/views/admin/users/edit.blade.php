@extends('admin.layouts.master')

@section('title', 'Edit User')

@section('content')
<div class="flex items-center flex-wrap justify-between gap20 mb-27">
    <h3>Edit User: {{ $user->fullname }}</h3>
    <div class="dropdown default">
        <a href="{{ route('users-index') }}" class="btn btn-lg btn-secondary">
            {{ __('Back') }}
        </a>
    </div>
</div>

<div class="wg-box">
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Personal Information Section -->
        <div class="body-title mb-3">Personal Information <span class="tf-color-1">*</span></div>

        <div class="row">
            <!-- Prefix Name -->
            <div class="col-md-2">
                <fieldset class="name">
                    <div class="body-title">Prefix</div>
                    {{-- <select class="form-control form-control-lg" name="prefixname" style="height: 50px; font-size: 16px;"> --}}

                        <select class="form-control form-control-lg rounded-select @error('prefixname') is-invalid @enderror"
                        name="type" style="height: 50px; font-size: 16px;">
                        <option value="">Select</option>
                        <option value="Mr" {{ old('prefixname', $user->prefixname) == 'Mr' ? 'selected' : '' }}>Mr</option>
                        <option value="Mrs" {{ old('prefixname', $user->prefixname) == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                        <option value="Ms" {{ old('prefixname', $user->prefixname) == 'Ms' ? 'selected' : '' }}>Ms</option>
                    </select>
                </fieldset>
            </div>

            <!-- First Name -->
            <div class="col-md-4">
                <fieldset class="name">
                    <div class="body-title">First Name <span class="tf-color-1">*</span></div>
                    <input class="form-control @error('firstname') is-invalid @enderror"
                           type="text"
                           placeholder="First Name"
                           name="firstname"
                           value="{{ old('firstname', $user->firstname) }}">
                    @error('firstname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- Middle Name -->
            <div class="col-md-3">
                <fieldset class="name">
                    <div class="body-title">Middle Name</div>
                    <input class="form-control @error('middlename') is-invalid @enderror"
                           type="text"
                           placeholder="Middle Name"
                           name="middlename"
                           value="{{ old('middlename', $user->middlename) }}">
                    @error('middlename') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- Last Name -->
            <div class="col-md-3">
                <fieldset class="name">
                    <div class="body-title">Last Name <span class="tf-color-1">*</span></div>
                    <input class="form-control @error('lastname') is-invalid @enderror"
                           type="text"
                           placeholder="Last Name"
                           name="lastname"
                           value="{{ old('lastname', $user->lastname) }}">
                    @error('lastname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>
        </div>

        <!-- Suffix Name -->
        <fieldset class="name">
            <div class="body-title">Suffix</div>
            <select class="form-control @error('suffixname') is-invalid @enderror" name="suffixname">
                <option value="">Select Suffix</option>
                @foreach($suffixes as $suffix)
                    <option value="{{ $suffix->value }}" {{ old('suffixname', $user->suffixname) == $suffix->value ? 'selected' : '' }}>
                        {{ $suffix->value }}
                    </option>
                @endforeach
            </select>
            @error('suffixname') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </fieldset>

        <!-- Account Information Section -->
        <div class="body-title mb-3 mt-4">Account Information <span class="tf-color-1">*</span></div>

        <div class="row">
            <!-- Username -->
            <div class="col-md-6">
                <fieldset class="name">
                    <div class="body-title">Username <span class="tf-color-1">*</span></div>
                    <input class="form-control @error('username') is-invalid @enderror"
                           type="text"
                           placeholder="Username"
                           name="username"
                           value="{{ old('username', $user->username) }}">
                    @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <fieldset class="name">
                    <div class="body-title">Email <span class="tf-color-1">*</span></div>
                    <input class="form-control @error('email') is-invalid @enderror"
                           type="email"
                           placeholder="Email"
                           name="email"
                           value="{{ old('email', $user->email) }}">
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>
        </div>

        <!-- User Type -->
        <fieldset class="name mt-4">
            <div class="body-title">User Type <span class="tf-color-1">*</span></div>
            <select class="form-control form-control-lg rounded-select @error('type') is-invalid @enderror"
                    name="type" style="height: 50px; font-size: 16px;">
                @foreach($userTypes as $value => $label)
                    <option value="{{ $value }}" {{ old('type', $user->type) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('type') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </fieldset>

        <!-- Profile Photo -->
        <fieldset class="name mt-4">
            <div class="body-title">Profile Photo</div>
            <div class="upload-image flex-grow">
                <div class="item img-preview-photo" style="{{ $user->photo ? '' : 'display: none;' }}">
                    <p>Recommended size: 300 x 300 (square)</p>
                    <img class="effect8 preview-img-photo"
                         src="{{ $user->photo ? asset('storage/' . $user->photo) : '' }}"
                         style="max-width: 150px; max-height: 150px; border-radius: 50%;">
                </div>
                <div class="item up-load">
                    <label class="uploadfile" for="photo">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <span class="body-text">Drop your image here or select
                            <span class="tf-color">click to browse</span>
                        </span>
                        <input type="file" id="photo" name="photo" accept="image/*" onchange="previewSelectedImage(event, 'photo')">
                    </label>
                </div>
            </div>
            @error('photo')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </fieldset>

        <div class="bot mt-4">
            <div></div>
            <button class="tf-button w208" type="submit">Update User</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewSelectedImage(event, key) {
        const file = event.target.files[0];
        if (!file) return;

        if (!file.type.match('image.*')) {
            alert('Please select an image file');
            event.target.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Image must be less than 2MB');
            event.target.value = '';
            return;
        }

        let reader = new FileReader();
        reader.onload = function() {
            const previewImg = document.querySelector('.preview-img-' + key);
            const previewContainer = document.querySelector('.img-preview-' + key);

            previewImg.src = reader.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush
@endsection
