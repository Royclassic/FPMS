<?php

namespace App\Http\Requests\User;

use App\Http\Requests\CoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends CoreRequest
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
        return [
            "name" => "required",
            "email" => "required|email|unique:users",
            "admission_staff_no"=>"required|unique:users",
            "phone"=>"required|unique:users"
        ];
    }
}
