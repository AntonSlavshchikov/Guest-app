<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Guest;

use App\Http\Requests\ApiRequest;

class UpdateRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'country' => ['nullable', 'string'],
        ];
    }
}
