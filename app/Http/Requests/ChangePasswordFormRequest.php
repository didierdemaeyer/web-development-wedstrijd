<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePasswordFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(\Auth::user()->getAuthPassword()) {
            return [
                'old_password'         => 'required',
                'new_password'         => 'required|min:4',
                'confirm_new_password' => 'required|same:new_password',
            ];
        } else {
            return [
                'new_password'         => 'required|min:4',
                'confirm_new_password' => 'required|same:new_password',
            ];
        }
    }
}
