@extends('admin.layouts.master')

@section('title', 'View User: ' . $user->fullname)

@section('content')
<div class="flex items-center flex-wrap justify-between gap20 mb-27">
    <h3>User Details: {{ $user->fullname }}</h3>
    <div class="dropdown default">
        <a href="{{ route('users-level-one-index') }}" class="btn btn-lg btn-secondary">
            {{ __('Back to Users') }}
        </a>
    </div>
</div>

<div class="wg-box">
    <div class="row">
        <div class="col-md-3">
            <div class="user-photo-container text-center mb-4">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->avatar) }}"
                         class="img-thumbnail rounded-circle"
                         style="width: 200px; height: 200px; object-fit: cover;">
                @else
                    <div class="no-photo rounded-circle bg-light d-flex align-items-center justify-content-center"
                         style="width: 200px; height: 200px; margin: 0 auto;">
                        <i class="fas fa-user fa-5x text-muted"></i>
                    </div>
                @endif
            </div>
        </div>



        <div class="col-md-9">
            <div class="user-details">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="detail-title">Name</h5>
                        <p class="detail-content">
                            {{ $user->prefixname }} {{ $user->firstname }}
                            {{ $user->middlename }} {{ $user->lastname }} {{ $user->suffixname }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="detail-title">Username</h5>
                        <p class="detail-content">{{ $user->username }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="detail-title">Email</h5>
                        <p class="detail-content">{{ $user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="detail-title">User Type</h5>
                        <p class="detail-content">
                            {{ \App\Enums\UserType::from($user->type)->label() }}
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="detail-title">Created At</h5>
                        <p class="detail-content">{{ $user->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="detail-title">Last Updated</h5>
                        <p class="detail-content">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                @if($user->deleted_at)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="detail-title">Deleted At</h5>
                            <p class="detail-content text-danger">{{ $user->deleted_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                @endif

                {{-- <div class="d-flex justify-content-end mt-4">
                    @include('admin.users.partials.actions', ['user' => $user])
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
