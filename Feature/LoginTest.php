<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    //use RefreshDatabase;


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
    }

    // Login Test using wrong email or password
    /** @test */
    public function email_or_password_wrong()
    {
        // Wrong Email
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_usr@gmail.com',
        'password'      => 'TestUser002'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'gagal',
            'message'    => 'Email atau password salah!'
        ]);
        
        // Wrong Password
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser01'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'gagal',
            'message'    => 'Email atau password salah!'
        ]);

        // Wrong Email & Password
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_usr@gmail.com',
        'password'      => 'TestUser01'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'gagal',
            'message'    => 'Email atau password salah!'
        ]);
    }

    // Login Test using Un-Verified Email
    /** @test */
    public function email_not_verified_yet()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user02@gmail.com',
        'password'      => 'TestUser003'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'gagal',
            'message'    => 'Email belum terverifikasi!'
        ]);
    }
}
