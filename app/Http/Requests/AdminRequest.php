<?php

namespace App\Http\Requests\Admin;

class AdminRequest extends FormResponseShape
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => 'required|min:2',
                        'phone' => 'digits_between:9,14|unique:admins,phone',
                        'email' => 'required|email|unique:admins,email',
                        'image' => 'mimes:jpeg,jpg,png',
                        'role_id' => 'required|exists:roles,id',
                        'password' => 'required|confirmed|min:6'
                    ];
                }
            case 'PATCH':
            case 'PUT':
                {
                    return [
                        'name' => 'required|min:2',
                        'phone' => 'digits_between:9,14|unique:admins,phone,'.$this->segment(3),
                        'email' => 'required|email|unique:admins,email,' . $this->segment(3),
                        'image' => 'mimes:jpeg,jpg,png',
                        'role_id' => 'exists:roles,id',
                        'password' => 'nullable|confirmed|min:6'
                    ];
                }
            default:
                break;
        }
    }
}
