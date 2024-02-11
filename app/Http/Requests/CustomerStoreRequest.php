<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('put')) {
            return [
                'status'        => 'required',
            ];
        }else{
            return [
                'name'          => 'required',
                'phone'         => 'required',
                'address'       => 'required',
                'status'        => 'required',
                'package_id'    => 'required',
                'ktpImage'      => 'required',
                'houseImage'    => 'required',
                'created_by'    => 'required',
            ];
        }
    }
}
