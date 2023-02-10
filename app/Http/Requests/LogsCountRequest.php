<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class LogsCountRequest extends FormRequest
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

    /*
     * convert statusCode to int before validation
     */
    public function prepareForValidation()
    {
        $this->merge([
            'statusCode' => !is_null($this->input('statusCode')) ? (int)$this->input('statusCode') : null,
            'startDate' => !is_null($this->input('startDate')) ? Carbon::parse($this->input('startDate')) : null,
            'endDate' => !is_null($this->input('endDate')) ? Carbon::parse($this->input('endDate')) : null
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'serviceNames' =>  'nullable|min:3|string',
            'statusCode' =>  'nullable|int|min:100|max:599',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'serviceNames.min' => 'serviceNames must be at least 3 character',
            'statusCode.min' => 'statusCode must be at least 100',
            'statusCode.max' => 'statusCode must be maximum 599',
            'startDate.date' => 'startDate must be date time type',
            'endDate.date' => 'endDate must be date time type',
            'endDate.after_or_equal' => 'The endDate must be less than the startDate'
        ];
    }

}
