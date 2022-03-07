<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ApiRegisterTest extends TestCase
{
    use DatabaseMigrations;

    const VALID_EMAIL = 'test@email.com';
    const VALID_PASSWORD = '12345678';
    const VALID_NAME = 'Felippe Miguel';
    const INVALID_NAME = '';
    const INVALID_EMAIL = 'testemailcom';
    const INVALID_PASSWORD = '123';

    public function test_register_user_without_name()
    {
        $response = $this->postJson('/api/register', [
            'email' => self::VALID_EMAIL,
            'password' => self::VALID_PASSWORD,
        ]);

        $response->assertStatus(422);
    }

    public function test_register_user_without_email()
    {
        $response = $this->postJson('/api/register', [
            'name' => self::VALID_NAME,
            'password' => self::VALID_PASSWORD,
        ]);

        $response->assertStatus(422);
    }

    public function test_register_user_without_password()
    {
        $response = $this->postJson('/api/register', [
            'name' => self::VALID_NAME,
            'email' => self::VALID_EMAIL,
        ]);

        $response->assertStatus(422);
    }

    public function test_register_user_without_valid_name()
    {
        $response = $this->postJson('/api/register', [
            'name' => self::INVALID_NAME,
            'email' => self::VALID_EMAIL,
            'password' => self::VALID_PASSWORD,
        ]);

        $response->assertStatus(422);
    }

    public function test_register_user_without_valid_email()
    {
        $response = $this->postJson('/api/register', [
            'name' => self::VALID_NAME,
            'email' => self::INVALID_EMAIL,
            'password' => self::VALID_PASSWORD,
        ]);

        $response->assertStatus(422);
    }

    public function test_register_user_without_valid_password()
    {
        $response = $this->postJson('/api/register', [
            'name' => self::VALID_NAME,
            'email' => self::VALID_EMAIL,
            'password' => self::INVALID_PASSWORD,
        ]);

        $response->assertStatus(422);
    }

    public function test_register_user_successfully()
    {
        $response = $this->postJson('/api/register', [
            'name' => self::VALID_NAME,
            'email' => self::VALID_EMAIL,
            'password' => self::VALID_PASSWORD,
        ]);

        $response->assertStatus(201);
    }

    public function test_login_successfully()
    {
        $response = $this->postJson('/api/login', [
            'email' => self::VALID_EMAIL,
            'password' => self::VALID_PASSWORD,
        ]);

        $response->assertStatus(200);
    }
}
