<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;

class ForgotPasswordTest extends TestCase
{
    // Unregistered Email Test 
    /** @test */
    public function not_registered_email()
    {
        $user = $this->json('POST', 'api/v1/forgot-password',
        ['email'        => 'test_user003@gmail.com',
        ]);

        $user->assertStatus(500)->assertJson([
            'status'     => 'gagal',
            'message'    => 'email kamu tidak terdaftar, coba lagi.'
        ]);
    }

    
    // True Email & Wrong Code Test 
    /** @test */
    /*
    public function registered_email_wrong_code()
    {
        $user = $this->json('POST', 'api/v1/forgot-password',
        ['email'        => 'kelvin@byznis.id',
        ]);

        /*
        $user = $this->json('POST', 'api/v1/forgot-password/#',
        [
            'token'        => '123456',
        ]);
        
        $user->assertStatus(500)->assertJson([
            'status'     => 'berhasil',
            'message'    => 'berhasil! periksa email kamu sekarang.'
        ]);
    }*/
    
}
