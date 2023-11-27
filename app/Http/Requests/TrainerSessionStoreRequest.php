<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerSessionStoreRequest extends FormRequest
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
            'member_id'             => 'required|exists:members,id',
            'trainer_id'            => 'required|exists:personal_trainers,id',
            'start_date'            => 'required|string',
            'trainer_package_id'    => 'required|exists:trainer_packages,id',
            'user_id'               => '',
            'description'           => ''
        ];
    }
}
