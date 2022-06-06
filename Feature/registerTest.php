<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;

class registerTest extends TestCase
{
    //use RefreshDatabase;
    use WithFaker;

    // Test for Successful Register
    /** @test */
   public function success_register()
   {
       $password = $this->faker->unique()->password;
       
       $response = $this->json('POST', 'api/v1/register',
       ['name'              => $this->faker->name,
       'email'              => $this->faker->unique()->safeEmail,
       'password'           => $password,
       'confirm_password'   => $password]);

       $response->assertStatus(201)->assertJson([
           'status'     => 'berhasil',
           'message'    => 'Pendaftaran berhasil!, silahkan konfirmasi email anda!'
       ]);
   }

   // Test for Successful Register Without Name
    /** @test */
    public function success_register_with_noname()
    {
        $password = $this->faker->unique()->password;

        $response = $this->json('POST', 'api/v1/register',
        ['name'              => '',
        'email'              => $this->faker->unique()->safeEmail,
        'password'           => $password,
        'confirm_password'   => $password]);
 
        $response->assertStatus(400)->assertJson([
            'status'     => 'gagal',
            'message'    => 'Pendaftaran berhasil!, silahkan konfirmasi email anda!'
        ]);
    }

   // Test for Empty Email
   /** @test */
   public function email_empty()
   {
    $password = $this->faker->unique()->password;

       $response = $this->json('POST', 'api/v1/register',
       ['name'              => $this->faker->name,
       'email'              => '',
       'password'           => $password,
       'confirm_password'   => $password]);

       $response->assertStatus(400)->assertJson([
        'status'     => 'gagal',
        'message'    => ['email' => ['Kolom wajib diisi']]
    ]);
   }

   // Test for Invalid Email
   /** @test */
   public function email_invalid()
   {
    $password = $this->faker->unique()->password;
    $invalidEmail = ['you@example,com', 'bad_user.org', 'example@bad+user.com'];
   
       $response = $this->json('POST', 'api/v1/register',
       ['name'              => $this->faker->name,
       'email'              => $invalidEmail,
       'password'           => $password,
       'confirm_password'   => $password]);

       $response->assertStatus(400)->assertJson([
        'status'     => 'gagal',
        'message'    => ['email' => ['Email tidak valid']]
    ]);
   }

   // Test for Using Registered Email in Database
   /** @test */
   
   public function email_registered_in_database()
   {
    $password = $this->faker->unique()->password;
    $email =$this->faker->unique()->safeEmail;

    $response = $this->json('POST', 'api/v1/register',
       ['name'              => $this->faker->name,
       'email'              => $email,
       'password'           => $password,
       'confirm_password'   => $password]);

       $response->assertStatus(201)->assertJson([
           'status'     => 'berhasil',
           'message'    => 'Pendaftaran berhasil!, silahkan konfirmasi email anda!'
       ]);

       $response = $this->json('POST', 'api/v1/register',
       ['name'              => $this->faker->name,
       'email'              => $email,
       'password'           => $password,
       'confirm_password'   => $password]);

       $response->assertStatus(400)->assertJson([
        'status'     => 'gagal',
        'message'    => ['email' => ['Email sudah terdaftar']]
    ]);
   }
   

   // Test for Empty Password
    /** @test */
    public function password_empty()
    {
        $password = $this->faker->unique()->password;

        $response = $this->json('POST', 'api/v1/register',
        ['name'              => $this->faker->name,
        'email'              => $this->faker->unique()->safeEmail,
        'password'           => '',
        'confirm_password'   => '']);
 
        $response->assertStatus(400)->assertJson([
            'status'     => 'gagal',
            'message'    => ['password' => ['Kolom wajib diisi']]
        ]);
    }

   // Test for Unmatch Password & Confirm Password
   /** @test */
   public function password_not_match()
   {
    $password = $this->faker->unique()->password;
       $confirm_password = $this->faker->unique()->password;

       $response = $this->json('POST', 'api/v1/register',
       ['name'              => $this->faker->name,
       'email'              => $this->faker->unique()->safeEmail,
       'password'           => $password,
       'confirm_password'   => $confirm_password]);

       $response->assertStatus(400)->assertJson([
        'status'     => 'gagal',
        'message'    => ['password' => ['Password tidak sama'], 'confirm_password' => ['Password tidak sama']]
        ]);
   }

   // Test for Password doesn't have enough character
   /** @test */
   
   public function password_invalid()
   {
       $maxpassword = Str::random(7);

       $response = $this->json('POST', 'api/v1/register',
       ['name'              => $this->faker->name,
       'email'              => $this->faker->unique()->safeEmail,
       'password'           => $maxpassword,
       'confirm_password'   => $maxpassword]);

       $response->assertStatus(400)->assertJson([
        'status'     => 'gagal',
        'message'    => ['password' => ['Minimal 8 karakter']]
        ]);
   }
   
   // Test for Wrong Code Verification
   // This test will always be failed as the email has already been verified
   /** @test */
   public function wrong_code_verification()
   {
    $response = $this->json('POST', 'api/v1/verify',
    [
    'email'              => 'test_user@gmail.com',
    'token'              => '123456'
    ]);

    $response->assertStatus(400)->assertJson([
        'status'     => 'gagal',
        'message'    => 'Token tidak sesuai'
    ]);
   }

   // Test for True Code Verification
   // This test will always be failed as the email has already been verified
   /** @test */
   public function true_code_verification()
   {
    $response = $this->json('POST', 'api/v1/verify',
    [
    'email'              => 'test_user@gmail.com',
    'token'              => '354292'
    ]);

    $response->assertStatus(400)->assertJson([
        'status'     => 'berhasil',
        'message'    => 'akun berhasil diverifikasi'
    ]);
   }
}