@extends('admin.layouts.master')

@section('title', 'User Management')

@section('content')

<div class="tf-section mb-30">
    <div class="wg-box">
        <div class="flex items-center justify-between">
            <h5>User Management</h5>
            <div class="dropdown default">
                <a href="{{ route('users-level-two.create') }}" class="btn btn-lg btn-secondary" id="add-button">
                    {{ __('Add User') }}
                </a>
            </div>
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="users_table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">{{ __('#') }}</th>
                            <th class="text-center" style="width: 80px;">{{ __('Avatar') }}</th>
                            <th class="text-center" style="width: 150px;">{{ __('Full Name') }}</th>
                            <th class="text-center" style="width: 120px;">{{ __('Username') }}</th>
                            <th class="text-center" style="width: 150px;">{{ __('Email') }}</th>
                            <th class="text-center" style="width: 100px;">{{ __('Type') }}</th>
                            <th class="text-center" style="width: 80px;">{{ __('Status') }}</th>
                            <th class="text-center" style="width: 120px;">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#users_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: '{{ route('users-level-two.data') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
                { data: 'avatar', name: 'avatar', orderable: false, searchable: false, className: 'text-center' },
                { data: 'fullname', name: 'fullname', className: 'text-center' },
                { data: 'username', name: 'username', className: 'text-center' },
                { data: 'email', name: 'email', className: 'text-center' },
                { data: 'type', name: 'type', className: 'text-center' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center' }
            ]
        });
    });
</script>
@endpush
