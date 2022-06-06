<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_ValuasiTest extends TestCase
{
    // Success Upload Valuasi
     /** @test */
     
     public function success_store_valuasi()
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

         $users = $this->json('POST', 'api/admin/store-valuasi/18',
         [
            'token'                        => $token,
            'id_penerbit'                  => '18',
            'nilai'                        => '765000000',
            'dokumen_valuasi'              => $pdf_test_file,
            'keterangan'                   => 'Nilai divaluasi',
            'status'                       => 'mengajukan_valuasi'
        
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Simpan'
         ]);
     }

     // Success Upload Valuasi
     /** @test */
     
     public function fail_store_valuasi()
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

         $users = $this->json('POST', 'api/admin/store-valuasi/18',
         [
            'token'                        => $token,
            'id_penerbit'                  => '18',
            'nilai'                        => '765000000',
            'dokumen_valuasi'              => $image_test_file,
            'keterangan'                   => 'Nilai divaluasi',
            'status'                       => 'mengajukan_valuasi'
        
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }

     // Success Update Valuasi
     /** @test */
     
     public function success_update_valuasi()
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

         $users = $this->json('POST', 'api/admin/update-valuasi/21',
         [
            'token'                        => $token,
            'id_penerbit'                  => '18',
            'nilai'                        => '765000000',
            'dokumen_valuasi'              => $pdf_test_file,
            'keterangan'                   => 'Nilai divaluasi',
            'status'                       => 'mengajukan_valuasi'
        
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Update!'
         ]);
     }

     // Success Update Status Valuasi
     /** @test */
     
     public function success_update_status_valuasi()
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

         $users = $this->json('POST', 'api/admin/update-valuasistatus/21',
         [
            'token'            => $token,
             'status'          => 'terima_valuasi_sementara'
        
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Simpan'
         ]);
     }

     // Success Delete Valuasi
     /** @test */
     
     public function success_delete_valuasi()
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

         $users = $this->json('POST', 'api/admin/delete-valuasi/21',
         [
            'token'                        => $token,
        
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil dihapus'
         ]);
     }

}
