<?php

namespace Tests\Feature;

use App\Repositories\UserRepositoryInterface;
use App\Services\AuthServiceInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;


class AuthTest extends TestCase
{
    use DatabaseMigrations;

    protected $userRepository;
    protected $authService;

    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->make(UserRepositoryInterface::class);
        $this->authService = $this->app->make(AuthServiceInterface::class);
        $this->faker = Faker::create();
    }

    public function test_register()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(200)
            ->assertJson(['user' => ['name' => $userData['name'], 'email' => $userData['email']]]);
    }

    public function test_login_with_valid_credentials()
    {
        $user = $this->userRepository->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ]);

        $credentials = [
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ];

        $response = $this->json('POST', '/api/login', $credentials);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function test_login_with_invalid_credentials()
    {
        $credentials = [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ];

        $response = $this->json('POST', '/api/login', $credentials);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Invalid credentials']);
    }
}
