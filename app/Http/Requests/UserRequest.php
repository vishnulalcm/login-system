<?php

namespace App\Http\Requests;

use App\Services\UserService;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $userService = app(UserService::class);
        $id = $this->route('user') ? $this->route('user')->id : null;
        return $userService->rules($id);
    }

    public function authorize()
    {
        return true;
    }
}
