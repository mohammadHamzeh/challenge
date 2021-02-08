<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Controllers\Api\V1\Contract\ApiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'repository_id'=>'required|exists:repositories,id',
            'tags'=>'required|array'
        ];
    }
}
