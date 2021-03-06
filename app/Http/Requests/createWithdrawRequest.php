<?php

namespace App\Http\Requests;

use App\Rules\ReachedMaximum;
use App\Rules\DepositBalanceReachedMinimum;
use Illuminate\Foundation\Http\FormRequest;

class createWithdrawRequest extends FormRequest
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
            //
            'student_id' => 'required',
            'amount' => ['required','numeric','min:0','not_in:0', new ReachedMaximum($this->all()), new DepositBalanceReachedMinimum($this->all())],
        ];
    }
}
