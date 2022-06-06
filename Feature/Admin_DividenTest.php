<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_DividenTest extends TestCase
{
    // Success Store Dividen
     /** @test */
     
     public function success_store_dividen()
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

         $users = $this->json('POST', 'api/admin/store-dividen/10',
         [
             'token'               => $token,
             'total_dividen'       => '10000',
             'tanggal_pembagian'   => '31-08-2020'

         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            'message'    => 'Dividen Telah di Tambah'
        ]);
    }

    // Success Remove Dividen
     /** @test */
     
     public function success_remove_dividen()
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

         $users = $this->json('POST', 'api/admin/remove-dividen/4',
         [
             'token'               => $token,

         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            'message'    => 'Dividen Telah di Hapus'
        ]);
    }

    // Fail Remove Dividen
     /** @test */
     
     public function fail_remove_dividen()
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

         $users = $this->json('POST', 'api/admin/remove-dividen/2',
         [
             'token'               => $token,

         ]);
 
         $users->assertStatus(500);
    }
}
