<?php

namespace App\Http\Controllers;

use App\Enums\Suffix;
use App\Enums\UserType;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserControllerLevelTwo extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        // $users = $this->userService->list();
        // , compact('users')
        return view('admin.users_level_two.index');
    }

    public function data()
    {
        $users = $this->userService->listForDataTables();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('avatar', function($user) {
                return $user->photo
                    ? '<img src="'.asset('storage/'.$user->photo).'" class="rounded-circle" width="40" height="40">'
                    : '<div class="avatar-placeholder rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                          <i class="fas fa-user"></i>
                       </div>';
            })
            ->addColumn('fullname', function($user) {
                return $user->fullname;
            })
            ->addColumn('type', function($user) {
                return ucfirst($user->type);
            })
            ->addColumn('status', function($user) {
                return $user->deleted_at
                    ? '<span class="badge bg-danger">Inactive</span>'
                    : '<span class="badge bg-success">Active</span>';
            })
            ->addColumn('actions', function($user) {
                return view('admin.users_level_two.actions', compact('user'))->render();
            })
            ->rawColumns(['avatar', 'status', 'actions'])
            ->make(true);
    }


    public function create()
    {

        return view('admin.users_level_two.create', [
            'userTypes' => UserType::options(),
            'suffixes' => Suffix::cases()
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->store($request->validated());
        return redirect()->route('users-level-two.show', $user)->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = $this->userService->find($id);
        return view('admin.users_level_two.show', compact('user'));
    }

    public function edit($id)
    {

        $user = $this->userService->find($id);
        return view('admin.users_level_two.edit', [
            'user' => $user,
            'userTypes' => UserType::options(),
            'suffixes' => Suffix::cases()
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $this->userService->update($id, $request->validated());
        return redirect()->route('users-level-one-index', $id)->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $this->userService->destroy($id);
        return redirect()->route('users-level-one-index')->with('success', 'User moved to trash');
    }

    public function trashed()
    {
     dd(54554);
        $users = $this->userService->listTrashed();
        return view('admin.users.trashed', compact('users'));
    }

    public function restore($id)
    {
        $this->userService->restore($id);
        return redirect()->route('users-level-one-index')->with('success', 'User restored successfully');
    }

    public function forceDelete($id)
    {
        $this->userService->delete($id);
        return redirect()->route('users-level-one-index')->with('success', 'User permanently deleted');
    }
}


