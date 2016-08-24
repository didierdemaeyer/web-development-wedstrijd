<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateSettingsFormRequest extends Request
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
        $user = \Auth::user();
        $required_info = session('required_info');

        $rules = [
            'email' => 'required|email|unique:users,email,'.$user->id,
            'firstname' => 'required',
            'lastname' => 'required',
        ];

        if ($required_info == 'full') {
            $rules = array_merge($rules, [
                'address' => 'required',
                'city' => 'required',
                'postcode' => 'required',
                'country' => 'required',
            ]);
        }

        return $rules;
    }
}
