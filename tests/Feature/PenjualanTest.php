<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kendaraan;
use App\Models\Penjualan;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Tymon\JWTAuth\Facades\JWTAuth;

class PenjualanTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreatePenjualan()
    {
        $user = UserFactory::new()->create();
        $token = JWTAuth::fromUser($user);

        $authMock = Mockery::mock(AuthManager::class);
        $authMock->shouldReceive('user')->andReturn($user);
        $this->app->instance(AuthManager::class, $authMock);

        $kendaraan = Kendaraan::factory()->create();

        $response = $this->post("/api/beli-kendaraan", [
            "id_kendaraan" => $kendaraan->id,
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);


        $response->assertStatus(201);
    }

    public function testGetAllPenjualan()
    {
        $user = UserFactory::new()->create();
        $token = JWTAuth::fromUser($user);

        $authMock = Mockery::mock(AuthManager::class);
        $authMock->shouldReceive('user')->andReturn($user);
        $this->app->instance(AuthManager::class, $authMock);

        Penjualan::factory()->count(10)->create();

        $response = $this->get("/api/transaksi", [
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

        $penjualan = Penjualan::factory()->create();
        $id = $penjualan->id;
        $url = '/api/kendaraan-detail/' . $id;

        $response = $this->get($url, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
    }

}


