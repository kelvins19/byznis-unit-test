<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_StoreRevisiTest extends TestCase
{
    // Success Store Revisi Perusahaan
     /** @test */
     
     public function success_store_revisi_perusahaan()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $revisi = [
            'alamat_kantor'      => 'Revisi Test',
            'alamat_usaha'       => 'Revisi Test',
            'kota'               => 'Revisi',
        ];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/store-revisi-perusahaan/18',
         [
             'token'           => $token,
             'id_status_revisi' => '1',
             'list_revisi'      => $revisi
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Revisi Berhasil ditambahkan'
         ]);
     }

     // Success Store Revisi Terbit
     /** @test */
     
     public function success_store_revisi_terbit()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
         $revisi = [
            'alamat_kantor'      => '',
            'alamat_usaha'       => '',
            'kota'               => '',
        ];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/store-revisi-terbit/18',
         [
             'token'           => $token,
             'id_status_revisi'     => 1,
             'dana_dibutuhkan'      => '1000000',
             'keterangan_revisi'    => $revisi,
             'revisi_sebelumnya'    => array([]),
             'revisitrakir'         => $revisi

         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Revisi Berhasil ditambahkan'
         ]);
     }

     // Success Store Revisi Lepas
     /** @test */
     
     public function success_store_revisi_lepas()
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

         $users = $this->json('POST', 'api/admin/store-revisi-lepas/18',
         [
             'token'           => $token,
             'id_status_revisi'     => '1',
             'total_lepas'          => '200'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Revisi Berhasil ditambahkan'
         ]);
     }

     // Success Store Revisi Campaign
     /** @test */
     
     public function success_store_revisi_campaign()
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

         $users = $this->json('POST', 'api/admin/store-revisi-campaign/18',
         [
             'token'           => $token,
            'telepon'            => '122828828',
            'nama'               => 'Test Revisi',
            'id_status_revisi'   => '1'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Revisi Berhasil ditambahkan'
         ]);
     }
}
