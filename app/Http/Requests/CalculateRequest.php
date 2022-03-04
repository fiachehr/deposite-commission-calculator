<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateRequest extends FormRequest
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

        $dataType = FormRequest::all()['data'];
        return [
            'freeWithdrawLimit' => 'required|Numeric|min:1|not_in:0',
            'freeWithdrawAmountLimit' => 'required|Numeric|min:100|not_in:0',
            'depositCharge' => 'required|Numeric|min:0.001|not_in:0',
            'privateWithdrawCommission' => 'required|Numeric|min:0.001|not_in:0',
            'businessWithdrawCommission' => 'required|Numeric|min:0.001|not_in:0',
            'file' => $dataType == 'u' ? 'required|max:10000|mimes:csv,txt' : 'nullable',
            'countData' => $dataType == 'd' ? 'required|Numeric|min:1|max:5000|not_in:0' : 'nullable',
        ];
    }
}
