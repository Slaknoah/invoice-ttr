<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Route;

class UserUpdateRequest extends FormRequest
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
        if(Route::currentRouteName() === 'updateAuthUser') {
            $user_id = auth()->user()->id;
        } else {
            $user_id = $this->user->id;
        }
        return [
            'name'      => 'string|max:255',
            'email'     => ['string', 'email', Rule::unique('users')->ignore($user_id)],
            'password'  => 'nullable|string|min:6',
            'password_confirmation' => 'same:password',
            'phone'     => ['nullable', new PhoneNumber()],
            'avatar'    => 'file|image|mimes:jpeg,png,gif,jpg|max:2048',
            'role'      => 'nullable||string',
            'isVerified'=> 'boolean'
        ];
    }
}
