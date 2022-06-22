<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
        $orderRules = [
            'paper_type_id' => 'required',
            'discipline_id' => 'required',
            'topic' => 'required|max:255',
            'citation_id' => 'required',
            'academic_level_id' => 'required',
            'deadline_id' => 'required',
            'pages' => 'required|digits_between:1,3',
            'spacing' => 'required',
            'payment_method' => 'required|sometimes',
            'charts' => 'integer',
            'ppt_slides' => 'integer',
            'totalAmount' => 'numeric|min:1',
            'instructions' => 'required',
            'sources' => 'integer',
        ];

        $userRules = [
            'name' => 'max:255',
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    $query->where('website_id', websiteId());
                }),
            ],
            'password' => 'confirmed|min:8',
        ];

        if (Auth::guest()) {
            return array_merge($orderRules, $userRules);
        }

        return $orderRules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'paper_type_id.required' => 'Paper type is required',
            'field_id.required' => 'Discipline is required',
            'citation_id.required' => 'Citation is required',
            'academic_level_id.required' => 'Academic level is required',
            'deadline_id.required' => 'Deadline is required',
        ];
    }
}
