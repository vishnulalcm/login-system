@extends('admin.layouts.master')

@section('title', 'Create New User')

@section('content')

<div class="flex items-center flex-wrap justify-between gap20 mb-27">
    <h3>Create New User</h3>
    <div class="dropdown default">
        <a href="{{ route('users-index') }}" class="btn btn-lg btn-secondary" id="add-button">
            {{ __('Back') }}
        </a>
    </div>
</div>

<!-- user-create-form -->
<div class="wg-box">
    <form id="form-user" class="form-new-product form-style-1" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Personal Information Section -->
        <div class="body-title mb-3">Personal Information <span class="tf-color-1">*</span></div>

        <div class="row">
            <!-- Prefix Name -->
            <div class="col-md-2">
                <fieldset class="name">
                    <div class="body-title">Suffix</div>
                    <select class="form-control {{ $errors->has('suffixname') ? ' is-invalid' : '' }}"
                            name="suffixname">
                        <option value="">Select Suffix</option>
                        @foreach(\App\Enums\Suffix::cases() as $suffix)
                            <option value="{{ $suffix->value }}" {{ old('suffixname') == $suffix->value ? 'selected' : '' }}>
                                {{ $suffix->value }}
                            </option>
                        @endforeach
                    </select>
                    @error('suffixname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- First Name -->
            <div class="col-md-4">
                <fieldset class="name">
                    <div class="body-title">First Name <span class="tf-color-1">*</span></div>
                    <input class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                           type="text"
                           placeholder="First Name"
                           name="firstname"
                           value="{{ old('firstname') }}">
                    @error('firstname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- Middle Name -->
            <div class="col-md-3">
                <fieldset class="name">
                    <div class="body-title">Middle Name</div>
                    <input class="form-control {{ $errors->has('middlename') ? ' is-invalid' : '' }}"
                           type="text"
                           placeholder="Middle Name"
                           name="middlename"
                           value="{{ old('middlename') }}">
                    @error('middlename') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- Last Name -->
            <div class="col-md-3">
                <fieldset class="name">
                    <div class="body-title">Last Name <span class="tf-color-1">*</span></div>
                    <input class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                           type="text"
                           placeholder="Last Name"
                           name="lastname"
                           value="{{ old('lastname') }}">
                    @error('lastname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>
        </div>

        <!-- Suffix Name -->
        <fieldset class="name">
            <div class="body-title">Suffix</div>
            <input class="form-control {{ $errors->has('suffixname') ? ' is-invalid' : '' }}"
                   type="text"
                   placeholder="Suffix (e.g., Jr, Sr)"
                   name="suffixname"
                   value="{{ old('suffixname') }}">
            @error('suffixname') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </fieldset>

        <!-- Account Information Section -->
        <div class="body-title mb-3 mt-4">Account Information <span class="tf-color-1">*</span></div>

        <div class="row">
            <!-- Username -->
            <div class="col-md-6">
                <fieldset class="name">
                    <div class="body-title">Username <span class="tf-color-1">*</span></div>
                    <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                           type="text"
                           placeholder="Username"
                           name="username"
                           value="{{ old('username') }}">
                    @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <fieldset class="name">
                    <div class="body-title">Email <span class="tf-color-1">*</span></div>
                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                           type="email"
                           placeholder="Email"
                           name="email"
                           value="{{ old('email') }}">
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>
        </div>

        <div class="row">
            <!-- Password -->
            <div class="col-md-6">
                <fieldset class="name">
                    <div class="body-title">Password <span class="tf-color-1">*</span></div>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                           type="password"
                           placeholder="Password"
                           name="password">
                    @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </fieldset>
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6">
                <fieldset class="name">
                    <div class="body-title">Confirm Password <span class="tf-color-1">*</span></div>
                    <input class="form-control"
                           type="password"
                           placeholder="Confirm Password"
                           name="password_confirmation">
                </fieldset>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="body-title mb-3 mt-4">Additional Information</div>

        <!-- Profile Photo -->
        <fieldset class="name">
            <div class="body-title">Profile Photo</div>
            <div class="upload-image flex-grow">
                <div class="item img-preview-photo" style="display: none;">
                    <p>Recommended size: 300 x 300 (square)</p>
                    <img class="effect8 preview-img-photo"
                        src=""
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

        <!-- User Type -->
        <fieldset class="name">
            <div class="body-title">User Type <span class="tf-color-1">*</span></div>
            <select class="form-control form-control-lg rounded-select {{ $errors->has('type') ? ' is-invalid' : '' }}"
                    name="type" style="height: 50px; font-size: 16px;">
                @foreach(\App\Enums\UserType::options() as $value => $label)
                    <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('type') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </fieldset>

        <div class="bot mt-4">
            <div></div>
            <button class="tf-button w208" type="submit">Create User</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    function previewSelectedImage(event, key) {
        const file = event.target.files[0];
        if (!file) return;

        // Validate file type
        if (!file.type.match('image.*')) {
            alert('Please select an image file');
            event.target.value = '';
            return;
        }

        // Validate file size (2MB max)
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

    $(document).ready(function() {
        $('#form-user').validate({
            rules: {
                firstname: { required: true },
                lastname: { required: true },
                username: {
                    required: true,
                    minlength: 3,
                    remote: {
                        url: '{{ route('users.check-username') }}',
                        type: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            username: function() {
                                return $('input[name="username"]').val();
                            }
                        }
                    }
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: '{{ route('users.check-email') }}',
                        type: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            email: function() {
                                return $('input[name="email"]').val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: 'input[name="password"]'
                },
                type: { required: true }
            },
            messages: {
                username: {
                    remote: "This username is already taken"
                },
                email: {
                    remote: "This email is already registered"
                },
                password_confirmation: {
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('fieldset').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush
