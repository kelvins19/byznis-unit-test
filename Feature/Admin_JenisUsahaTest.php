<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_JenisUsahaTest extends TestCase
{
    // Success Tambah Jenis Usaha
     /** @test */
     
     public function success_tambah_jenis_usaha()
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

         $users = $this->json('POST', 'api/admin/tambah-jenis-usaha',
         [
             'token'           => $token,
             'nama_jenis_usaha' => 'Makanan & Minuman',
             'id_industri'      => '5'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
         ]);
     }

     // Success Update Jenis Usaha
     /** @test */
     
     public function success_update_jenis_usaha()
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

         $users = $this->json('POST', 'api/admin/update-jenis-usaha/2',
         [
             'token'           => $token,
             'nama_jenis_usaha'   => 'Informasi Teknologi',
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'industri berhasil ditambahkan'
         ]);
     }

     // Success Remove Jenis Usaha
     /** @test */
     
     public function success_remove_jenis_usaha()
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

         $users = $this->json('POST', 'api/admin/remove-jenis-usaha/2',
         [
             'token'           => $token,
         ]);
 
         $users->assertStatus(200);
    }
}
