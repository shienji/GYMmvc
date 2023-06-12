<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_email' => 'required',
            'user_password' => 'required'
        ];
    }

    public function getCredentials()
    {
        // The form field for providing username or password
        // have name of "username", however, in order to support
        // logging users in with both (username and email)
        // we have to check if user has entered one or another
        $username = $this->get('user_email');

        if ($this->$username) {
            return [
                'user_email' => $username,
                'user_password' => $this->get('user_password')
            ];
        }

        return $this->only('user_email', 'user_password');
    }
    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    // private function isEmail($param)
    // {
    //     $factory = $this->container->make(ValidationFactory::class);

    //     return !$factory->make(
    //         ['user_email' => $param],
    //         ['user_email' => 'user_email']
    //     )->fails();
    // }
}
