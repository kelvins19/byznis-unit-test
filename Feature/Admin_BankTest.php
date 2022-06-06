<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_BankTest extends TestCase
{
    // Success Store Bank
     /** @test */
     
     public function success_store_bank()
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

         $users = $this->json('POST', 'api/admin/upload-bank',
         [
             'token'           => $token,
             'nama_bank'       => 'Maybank',
             'kode_swift'      => '123119'

         ]);
 
         $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
            'message'    => 'berhasil ditambahkan'
        ]);

    }

    // Success Store Bank
    /** @test */
     public function fail_store_bank()
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

         $users = $this->json('POST', 'api/admin/upload-bank',
         [
             'token'           => $token,
             'nama_bank'       => 'ANZ',
             'kode_swift'      => '013257'

         ]);
 
         $users->assertStatus(200)->assertJson([
            'status'     => 'gagal',
            'message'    => 'bank sudah ada'
        ]);
}
}
