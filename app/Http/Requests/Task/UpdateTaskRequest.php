<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        $this->user()->can('update',$this->task);
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
            'title'             => ['nullable','string','max:255'],
            'description'       => ['nullable','string','max:1000'],
            'start_date'        => ['nullable','date'],
            'due_date'          => ['nullable','date'],
            'actual_start_date' => ['nullable','date'],
            'actual_end_date'   => ['nullable','date'],
            'status_id'         => ['nullable','exists:statuses,id'],
            'assigned_by'       => ['nullable','exists:users,id'],
            'assignee_ids'      => ['nullable','array'],
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
            'title.max'             => 'The length of the title may not be more than 255 characters',
            'status_id.exists'      => 'The value entered does not exist in the statuses table.',
            'assigned_by.exists'    => 'The value entered does not exist in the users table.',
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



