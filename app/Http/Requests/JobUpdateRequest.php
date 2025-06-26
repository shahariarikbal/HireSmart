<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'job_type' => 'required|string|max:50',
            'experience_level' => 'required|string|max:50',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary_min' => 'required|numeric',
            'salary_max' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The job title is required.',
            'job_type.required' => 'The job type is required.',
            'experience_level.required' => 'The experience level is required.',
            'is_active.required' => 'The active status is required.',
            'avatar.image' => 'The avatar must be an image file.',
            'description.required' => 'The job description is required.',
            'location.required' => 'The job location is required.',
            'salary_min.required' => 'The minimum salary is required.',
            'salary_max.required' => 'The maximum salary is required.',
        ];
    }
}
