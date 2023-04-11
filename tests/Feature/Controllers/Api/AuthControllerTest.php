<?php

namespace Tests\Feature\Controllers\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the database with users
        User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password')
        ]);
    }

    /**
     * Test if user can be created.
     *
     * @return void
     */
    public function test_user_can_be_created()
    {
        $request = new UserRegisterRequest([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',

        ]);

        $response = $this->postJson(route('api.user.register'), $request->toArray());

        $response->assertStatus(200);
        $response->assertJson([
            'status' => true,
            'message' => 'User Created Successfully',
            'user_data' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.com'
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com'
        ]);
    }

    /** @test */
    public function it_logs_in_a_user_with_valid_credentials()
    {
        $email = 'testuser@example.com';
        $password = 'password';

        $request = new UserLoginRequest([
            'email' => $email,
            'password' => $password
        ]);

        $response = $this->postJson(route('api.user.login'), $request->toArray());
        $response->assertStatus(200);
        $response->assertJson([
            'status' => true,
            'message' => 'User Logged In Successfully'
        ]);
        $this->assertAuthenticated();
    }

    /** @test */
    public function it_does_not_log_in_a_user_with_invalid_credentials()
    {
        $email = 'testuser@example.com';
        $password = 'invalid_password';

        $request = new UserLoginRequest([
            'email' => $email,
            'password' => $password
        ]);

        $response = $this->postJson(route('api.user.login'), $request->toArray());
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email_or_password');
        $this->assertGuest();
    }
}
