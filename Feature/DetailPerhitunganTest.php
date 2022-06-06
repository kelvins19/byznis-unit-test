<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetailPerhitunganTest extends TestCase
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
    }

    // Success Update Lepas
     /** @test */
     
     public function success_update_lepas()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';

         $users = $this->json('POST', 'api/penerbit/update-lepas/pemilik_saham@gmail.com',
         [
             'token'                        => $token,
             'lembar_lepas'                 => '100000',
             'dana_dibutuhkan'              => '2000000000',
             
         ]);
 
         
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'data'       => 'Data Berhasil Disimpan'
         ]);
     }

     // Success Update Terbit
     /** @test */
     
     public function success_update_terbit()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';

         $users = $this->json('POST', 'api/penerbit/update-terbit',
         [
             'token'                        => $token,
             'id_user'                      => '5',
             'dana_dibutuhkan'              => '2000000000',
             'status_saham'                 => 'terbit'
             
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'data'       => 'Data Berhasil Disimpan'
         ]);
     }
}
