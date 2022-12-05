<?php

namespace App\Http\Requests;

use App\Models\AdditionalHourStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdditionalHourRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'hours' => [
                'required',
                'numeric'
            ],
            'status' => [
                'required',
                Rule::exists(AdditionalHourStatus::class, 'id')
            ],
            'reason' => [
                'string',
                'required'
            ],
            'date' => [
                'string',
                'required',
            ]
        ];
    }
}
