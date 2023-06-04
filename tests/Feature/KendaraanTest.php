<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Factories\UserFactory;
use Illuminate\Auth\AuthManager;
use Mockery;

class KendaraanTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;
    public function testCreateMobil()
    {
        $user = UserFactory::new()->create();


        $token = JWTAuth::fromUser($user);

        $authMock = Mockery::mock(AuthManager::class);
        $authMock->shouldReceive('user')->andReturn($user);
        $this->app->instance(AuthManager::class, $authMock);

        $response = $this->post('/api/kendaraan/mobil', [
            'nama' => 'Mobil Test',
            'tahun_kendaraan' => 2023,
            'warna' => 'merah',
            'harga' => 100000000,
            'mesin' => '2000 cc',
            'kapasitas_penumpang' => 5,
            'tipe' => 'sedan',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test creating a motor.
     *
     * @return void
     */
    public function testCreateMotor()
    {
        $user = UserFactory::new()->create();

        $token = JWTAuth::fromUser($user);

        $authMock = Mockery::mock(AuthManager::class);
        $authMock->shouldReceive('user')->andReturn($user);
        $this->app->instance(AuthManager::class, $authMock);

        $response = $this->post('/api/kendaraan/motor', [
            'nama' => 'Motor Test',
            'tahun_kendaraan' => 2023,
            'warna' => 'biru',
            'harga' => 50000000,
            'mesin' => '150 cc',
            'tipe_suspensi' => 'teleskopik',
            'tipe_transmisi' => 'manual',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
    }


    public function testGetAll()
    {
        $user = UserFactory::new()->create();

        $token = JWTAuth::fromUser($user);

        $authMock = Mockery::mock(AuthManager::class);
        $authMock->shouldReceive('user')->andReturn($user);
        $this->app->instance(AuthManager::class, $authMock);

        $response = $this->get('/api/kendaraan', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
    }

    public function testGetById()
    {
        $user = UserFactory::new()->create();
        $token = JWTAuth::fromUser($user);

        $authMock = Mockery::mock(AuthManager::class);
        $authMock->shouldReceive('user')->andReturn($user);
        $this->app->instance(AuthManager::class, $authMock);

        $kendaraan = Kendaraan::factory()->create();
        $id = $kendaraan->id;
        $url = '/api/kendaraan-detail/' . $id;

        $response = $this->get($url, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
    }
}




