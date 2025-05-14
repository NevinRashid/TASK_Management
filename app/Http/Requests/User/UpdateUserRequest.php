<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->user()->can('update',$this->user);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'      => ['nullable','string','max:255'],
            'email'     => ['nullable','email',Rule::unique('users')->ignore($this->route('user')),'max:255'],
            'role'      => ['nullable','string','in:project_manager,admin,user','max:255'],
            'password'  => ['nullable','string','min:8','max:16','confirmed',
                            Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()
                            ]
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
            'name.max'                 => 'The length of the name may not be more than 255 characters',
            'email.email'              => 'Please adhere to the email format (example@gmail.com)',
            'email.unique'             => 'The email must be unique and not duplicate. Please use another email',
            'email.max'                => 'The length of the email may not be more than 255 characters',
            'password.min'             => 'Password must be at least 8 characters long',
            'password.max'             => 'The length of the password may not be more than 16 characters',
            'password.confirmed'       => 'Password must be confirmed',
            'password.letters'         => 'Password must contain at least one character',
            'password.mixed'           => 'Password must contain at least one uppercase letter and one lowercase letter',
            'password.numbers'         => 'Password must contain at least one number',
            'password.symbols'         => 'Password must contain at least one character',
            'password.uncompromised'   => 'You should choose a more secure password',
            'role.max'                 => 'The length of the role may not be more than 255 characters',
            'role.in'                  => 'The role You must be one of (project_manager,admin,user)',
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
            'name'      => 'user name',
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

