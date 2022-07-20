<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:3',
            'postcode' => 'required|numeric',
            'city' => 'required',
            'local' => 'required',
            
        ];

        if($this->getMethod()=='POST'){
            $rules += [
                'email' => 'required|string|unique:companies,email',
                'data_image' => 'required'
            ];
        }

        if ($this->getMethod() == 'PUT') {
            $rules += [
                'email' => 'required|string|unique:companies,email,' . $this->company->id,
            ];
        }

        return $rules;
    }
}
