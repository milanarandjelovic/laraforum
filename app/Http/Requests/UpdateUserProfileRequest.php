<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'first_name'          => 'min:3|max:255',
            'last_name'           => 'min:3|max:255',
            'profile_description' => 'min:3',
            'personal_website'    => 'min:3|max:255|url',
            'twitter_username'    => 'min:3|max:255',
            'github_username'     => 'min:3|max:255',
            'place_of_employment' => 'min:3|max:255',
            'job_title'           => 'min:3|max:255',
            'hometown'            => 'min:3|max:255',
            'country_flag'        => 'numeric',
            'for_hire'            => 'boolean',
        ];
    }
}
