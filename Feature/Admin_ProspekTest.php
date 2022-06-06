<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_ProspekTest extends TestCase
{
    // Success Store Prospek
     /** @test */
     
     public function success_store_prospek()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/store',
         [
             'token'            => $token,
             'id_kampanye'      => '10',
             'tipe'             => 'makanan',
             'periode'          => '2020',
             'value'            => '10000000'
            
         ]);
 
         $users->assertStatus(201)->assertJson([
             'status'     => 'sukses',
             'message'    => 'Prospek Telah di Tambahkan'
         ]);
     }

     // Success Store Prospek
     /** @test */
     
     public function fail_store_prospek()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/store',
         [
             'token'            => $token,
             'id_kampanye'      => '10',
             'tipe'             => '',
             'periode'          => '',
             'value'            => '10000000'
            
         ]);
 
         $users->assertStatus(500);
     }
}
