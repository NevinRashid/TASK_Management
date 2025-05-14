<?php

namespace App\Http\Requests\Task;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        $this->user()->can('create');
        return true;
    }

    /**
     * Prepare the data for validation.
     * 
     * @return void
     */
    protected function prepareForValidation(){
    
        $this->merge([
                'title'         => Str::ucfirst($this->title),
                'description'  => Str::ucfirst($this->description),
                ]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
            'title'             => ['required','string','max:255'],
            'description'       => ['required','string','max:1000'],
            'start_date'        => ['nullable','date'],
            'due_date'          => ['nullable','date'],
            'actual_start_date' => ['nullable','date'],
            'actual_end_date'   => ['nullable','date'],
            'status_id'         => ['required','exists:statuses,id'],
            'assigned_by'       => ['required','exists:users,id'],
            'assignee_ids'      => ['required','array'],
            'assignee_ids.*'    => ['integer','exists:users,id'],
        ];
        return $rules;
    }

    /**
     *  Get the error messages for the defined validation rules.
     * 
     *  @return array<string, string>
     */
    public function messages():array
    {
        return[
            'title.required'        => 'The title is required please',
            'title.max'             => 'The length of the title may not be more than 255 characters',
            'description.required'  => 'The description is required please',
            'status_id.required'    => 'The status is required please',
            'status_id.exists'      => 'The value entered does not exist in the statuses table.',
            'assigned_by.required'  => 'The task creator is required please',
            'assigned_by.exists'    => 'The value entered does not exist in the users table.',
            'assignee_ids.required' => 'The assignees is required please',
            'assignee_ids.array'    => 'The assignee ids field must be an array.',
            'assignee_ids.exists'   => 'The values entered does not exist in the users table.',
        ];
    }

    
    /**
    * Get custom attributes for validator errors.
    *
    * @return array<string, string>
    */
    public function attributes(): array
    {
        return [
            'status_id'     => 'status',
            'assigned_by'   => 'creator',
            'assignee_ids'  => 'assignees',
            ];
    }

    /**
     * Handle a failed validation attempt.
     * 
     * @param  \Illuminate\Validation\Validator  $validator
     * 
     * @return void
     */
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json
            ([
                'success' => false,
                'message' => 'Data validation error',
                'errors'  => $validator->errors()
            ] , 422));
    }
}


