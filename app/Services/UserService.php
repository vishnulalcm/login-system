<?php

namespace App\Services;

use App\Enums\UserType;
use App\Enums\Suffix;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    protected $model;
    protected $request;

    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function listForDataTables()
    {
        return $this->model->withTrashed()->latest();
    }

    public function rules($id = null): array
    {
        return [
            'prefixname' => 'nullable|in:Mr,Mrs,Ms',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffixname' => 'nullable|in:'.implode(',', Suffix::values()),
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:'.implode(',', UserType::values()),
        ];
    }

    public function list(): LengthAwarePaginator
    {
        return $this->model->latest()->paginate(10);
    }

    public function store(array $attributes): Model
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = $this->hash($attributes['password']);
        }

        if ($this->request->hasFile('photo')) {
            $attributes['photo'] = $this->upload($this->request->file('photo'));
        }

        return $this->model->create($attributes);
    }

    public function find(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function update(int $id, array $attributes): bool
    {
        $user = $this->find($id);

        if (isset($attributes['password'])) {
            $attributes['password'] = $this->hash($attributes['password']);
        }

        if ($this->request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $attributes['photo'] = $this->upload($this->request->file('photo'));
        }

        return $user->update($attributes);
    }

    public function destroy($id): void
    {
        $this->model->whereIn('id', (array)$id)->delete();
    }

    public function listTrashed(): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()->latest()->paginate(10);
    }

    public function restore($id): void
    {
        $this->model->onlyTrashed()->whereIn('id', (array)$id)->restore();
    }

    public function delete($id): void
    {
        $users = $this->model->onlyTrashed()->whereIn('id', (array)$id)->get();

        foreach ($users as $user) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $user->forceDelete();
        }
    }

    public function hash(string $key): string
    {
        return Hash::make($key);
    }

    public function upload(UploadedFile $file): ?string
    {
        return $file->store('user-photos');
    }

    public function saveUserDetails(User $user)
    {
        // Save full name
        $user->details()->updateOrCreate(
            ['key' => 'full_name'],
            ['value' => $user->fullname, 'type' => 'bio']
        );

        // Save middle initial
        $middleInitial = $user->middlename ? strtoupper(substr($user->middlename, 0, 1)) . '.' : null;
        if ($middleInitial) {
            $user->details()->updateOrCreate(
                ['key' => 'middle_initial'],
                ['value' => $middleInitial, 'type' => 'bio']
            );
        }

        // Save avatar path if exists
        if ($user->photo) {
            $user->details()->updateOrCreate(
                ['key' => 'avatar'],
                ['value' => $user->photo, 'type' => 'image']
            );
        }

        // Save gender based on prefixname
        $gender = match($user->prefixname) {
            'Mr' => 'male',
            'Mrs', 'Ms' => 'female',
            default => null
        };

        if ($gender) {
            $user->details()->updateOrCreate(
                ['key' => 'gender'],
                ['value' => $gender, 'type' => 'bio']
            );
        }
}
}
