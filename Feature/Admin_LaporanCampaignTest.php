<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_LaporanCampaignTest extends TestCase
{
    // Success Store Laporan Campaign
     /** @test */
     
     public function success_store_laporan_campaign()
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

         $users = $this->json('POST', 'api/admin/store-laporan/10',
         [
             'token'           => $token,
             'laporan_bulan'   => '7',
             'laporan' => $pdf_test_file
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil di input kedatabase'
         ]);
     }


     // Success Validate Laporan Campaign
     /** @test */
     
     public function validate_store_laporan_campaign()
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

         $users = $this->json('POST', 'api/admin/store-laporan/10',
         [
             'token'           => $token,
             'laporan_bulan'   => '7',
             'laporan' => $image_test_file
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }

     // Success Update Laporan Campaign
     /** @test */
     
     public function success_update_laporan_campaign()
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

         $users = $this->json('POST', 'api/admin/update-laporan/5',
         [
             'token'           => $token,
             'laporan_bulan'   => '8',
             'laporan' => $pdf_test_file
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil di input kedatabase'
         ]);
     }

     // Success Remove Laporan Campaign
     /** @test */
     
     public function success_remove_laporan_campaign()
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

         $users = $this->json('POST', 'api/admin/remove-laporan/5',
         [
             'token'           => $token,
         ]);
 
         $users->assertStatus(201)->assertJson([
             'status'     => 'sukses',
             ' message'    => 'Laporan Telah di Hapus'
         ]);
     }
}
