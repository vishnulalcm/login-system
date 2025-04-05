


<div class="d-flex justify-content-center">
    @if($user->deleted_at)
        {{-- Restore button for soft-deleted users --}}
        <form action="{{ route('users-level-two.restore', $user->id) }}" method="POST" class="mx-1">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-success" title="Restore">
                <i class="fas fa-undo"></i> Restore
            </button>
        </form>

        {{-- Permanent delete button --}}
        <form action="{{ route('users-level-two.force-delete', $user->id) }}" method="POST" class="mx-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Delete Permanently"
                    onclick="return confirm('Are you sure you want to permanently delete this user?')">
                <i class="fas fa-trash"></i> Delete Permanently
            </button>
        </form>
    @else
        {{-- View button --}}
        <a href="{{ route('users-level-two.show', $user->id) }}" class="btn btn-sm btn-info mx-1" title="View">
            <i class="fas fa-eye"></i> View
        </a>

        {{-- Edit button --}}
        <a href="{{ route('users-level-two.edit', $user->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit">
            <i class="fas fa-edit"></i> Edit
        </a>

        {{-- Delete button --}}
        <form action="{{ route('users-level-two.destroy', $user->id) }}" method="POST" class="mx-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                    onclick="return confirm('Are you sure you want to move this user to trash?')">
                <i class="fas fa-trash-alt"></i> Delete
            </button>
        </form>
    @endif
</div>
