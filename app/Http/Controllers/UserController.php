<?php

namespace App\Http\Controllers;

use App\Enums\Suffix;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.users.index');
    }

    public function getData(Request $request)
    {
        $query = User::select([
            'id',
            'prefixname',
            'firstname',
            'middlename',
            'lastname',
            'suffixname',
            'username',
            'email',
            'type',
            'deleted_at',
            'photo'
        ])->withTrashed(); // Include soft deleted users

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function ($user) {
                return $user->fullname; // Using accessor from User model
            })
            ->addColumn('avatar', function ($user) {
                return '<img src="'.$user->avatar.'" width="50" class="rounded-circle">';
            })
            ->addColumn('status', function ($user) {
                return $user->deleted_at ?
                    '<span class="badge bg-danger">Inactive</span>' :
                    '<span class="badge bg-success">Active</span>';
            })
            ->addColumn('actions', function ($user) {
                return view('admin.users.actions', ['user' => $user])->render();
            })
            ->rawColumns(['avatar', 'status', 'actions'])
            ->make(true);
    }

    public function create(){

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
    // Validate the request data
        $validated = $request->validate([
            'prefixname' => ['nullable', 'string', 'max:255', 'in:Mr,Mrs,Ms'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
           'suffixname' => 'nullable|in:'.implode(',', Suffix::values()),
             'type' => 'required|in:'.implode(',', UserType::values()),
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            // 'type' => ['required', 'string', 'in:user,admin,manager'],
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('user-photos', 'public');
                $validated['photo'] = $path;
            }

            // Hash the password
            $validated['password'] = Hash::make($validated['password']);

            // Create the user
            $user = User::create($validated);

            // Optionally send email verification
            if (config('auth.must_verify_email')) {
                $user->sendEmailVerificationNotification();
            }

            return redirect()
                ->route('users-index')
                ->with('success', 'User created successfully!');

        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Failed to create user. Please try again.');
        }
   }

   public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'userTypes' => UserType::options(),
            'suffixes' => Suffix::cases()
        ]);
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'prefixname' => 'nullable|in:Mr,Mrs,Ms',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffixname' => 'nullable|in:'.implode(',', Suffix::values()),
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:'.implode(',', UserType::values()),
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $validated['photo'] = $request->file('photo')->store('user-photos');
        }

        $user->update($validated);

        return redirect()->route('users.show', $user)
            ->with('success', 'User updated successfully');
    }

    public function checkUsername(Request $request)
    {
        $exists = User::where('username', $request->username)->exists();
        return response()->json(['valid' => !$exists]);
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        return response()->json(['valid' => !$exists]);
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(10);
        return view('users-index', compact('users'));
    }

    /**
     * Restore a soft-deleted user
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users-index')
            ->with('success', 'User restored successfully');
    }

    /**
     * Permanently delete a user
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        // Delete associated photo if exists
        if ($user->photo) {
            Storage::delete($user->photo);
        }

        $user->forceDelete();

        return redirect()->route('users-index')
            ->with('success', 'User permanently deleted');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    /**
     * Soft delete a user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users-index')
            ->with('success', 'User moved to trash');
    }
}
