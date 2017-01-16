<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateVoteRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:up,down',
        ];
    }
}
