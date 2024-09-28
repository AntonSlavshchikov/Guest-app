<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Guest;

use App\Http\Requests\ApiRequest;

class CreateRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'phone'],
            'email' => ['nullable', 'email'],
            'country' => ['nullable', 'string'],
        ];
    }
}
