<?php

namespace tests\Feature\Api;

use App\Models\Guest;
use Tests\TestCase;

class GuestTest extends TestCase
{
    const string PHONE = '+79514113558';

    public function test_get_all()
    {
        $this->json('GET', '/api/guest')->assertStatus(200);
    }

    public function test_create_validation()
    {
        $this->json('POST', '/api/guest', [], ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    public function test_create()
    {
        $guestData = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'phone' => self::PHONE
        ];

        $this->json('POST', '/api/guest', $guestData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_create_unique()
    {
        $guestData = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'phone' => self::PHONE
        ];

        $this->json('POST', '/api/guest', $guestData, ['Accept' => 'application/json'])
            ->assertStatus(500);
    }

    public function test_update()
    {
        $guestData = [
            'email' => 'test@test.ru'
        ];

        $guest = Guest::where('phone', self::PHONE)->first();

        $this->json('PATCH', '/api/guest/' . $guest->id, $guestData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_delete()
    {
        $guest = Guest::where('phone', self::PHONE)->first();

        $this->json('DELETE', '/api/guest/' . $guest->id, [],['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
