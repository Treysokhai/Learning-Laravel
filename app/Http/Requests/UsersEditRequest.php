<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
class UsersEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');
        return [
            'name'     => 'required',
            'email'    => 'required|unique:users,email,'.$user->id,
            'role_id'  => 'required',
            'photo_id' => 'image|max:500000'
        ];
    }
}
