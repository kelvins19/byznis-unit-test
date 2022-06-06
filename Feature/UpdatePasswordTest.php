<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;

class UpdatePasswordTest extends TestCase
{
    /*
        Before running this test,
        Change the value of password_lama first in success_login(), invalid_new_password(),
        different_new_password(), and success_update() test to the newest password, which is
        'TestUser002'. This rules should also be applied in another test that is using this credentials.
    */


    // Success Login Test 
    /** @test */
    public function success_login()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser001'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
    }

    // Wrong Old PasswordTest 
    /** @test */
    public function wrong_old_password()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser001'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/ubah-password',
         ['token' => $token,
         'password_lama' => 'TestUser003',
         'password_baru' => 'TestUser002',
         'confirm_password_baru' => 'TestUser002'
         ]);
 
         $user->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => ['password_lama' => 'kata sandi lama tidak sesuai']
         ]);
    }

    // Invalid New Password Test 
    /** @test */
    public function invalid_password()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser001'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/ubah-password',
         ['token' => $token,
         'password_lama' => 'TestUser001',
         'password_baru' => 'TestUs',
         'confirm_password_baru' => 'TestUs'
         ]);
 
         $user->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => ['password_baru' => ['Minimal 8 karakter']]
         ]);
    }

    // Different Password Test 
    /** @test */
    public function different_new_password()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser001'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/ubah-password',
         ['token' => $token,
         'password_lama' => 'TestUser001',
         'password_baru' => 'TestUser002',
         'confirm_password_baru' => 'TestUser004'
         ]);
 
         $user->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => ['password_baru' => ['Password tidak sama'], 'confirm_password_baru' => ['Password tidak sama']]
         ]);
    }

    // Success Update Password Test 
    /** @test */
    public function success_update()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser001'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/ubah-password',
         ['token' => $token,
         'password_lama' => 'TestUser001',
         'password_baru' => 'TestUser002',
         'confirm_password_baru' => 'TestUser002'
         ]);
 
         $user->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'password berhasil diganti'
         ]);
    }
}
