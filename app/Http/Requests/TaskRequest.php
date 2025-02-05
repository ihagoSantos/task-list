<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Summary of TaskRequest
 *
 * Used to validate the request for the Task model
 * Created with the command: 'php artisan make:request TaskRequest'
 */
class TaskRequest extends FormRequest
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
        // create and update validations for tasks
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'required',
        ];
    }
}
