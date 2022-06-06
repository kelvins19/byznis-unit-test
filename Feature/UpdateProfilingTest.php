<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProfilingTest extends TestCase
{
    // Success Login Test 
    /** @test */
    public function success_login()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser002'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
    }

    // Success Update Profile
    /** @test */
    public function success_update_profile()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser002'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/update-profiling',
        ['token'    => $token,
        'password'  => 'TestUser002',
        'hubungan'  => 'keluarga'
        ]);

        $user->assertStatus(201)->assertJson([
            'status'     => 'berhasil',
            'message'    => 'Profil berhasil diubah!'
        ]);
    }

    // Fail Update Profile (Wrong Password)
    /** @test */
    public function fail_update_profile_wrong_password()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser002'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/update-profiling',
        ['token'    => $token,
        'password'  => 'TestUser02',
        'hubungan'  => 'keluarga'
        ]);

        $user->assertStatus(400)->assertJson([
            'status'     => 'gagal',
            'message'    => 'Kata sandi salah!'
        ]);
    }

    // Fail Update Profile 
    /** @test */
    public function fail_update_profile()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser002'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/update-profiling',
        ['token'    => $token,
        'password'  => 'TestUser002',
        'nomor_ponsel'  => '123'
        ]);

        $user->assertStatus(401)->assertJson([
            'status'     => 'gagal',
            'message'    => 'data user profiling gagal ditambahkan'
        ]);
    }
}
