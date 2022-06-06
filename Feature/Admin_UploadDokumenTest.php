<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_UploadDokumenTest extends TestCase
{
    // Success Upload Dokumen Penerbit
     /** @test */
     
     public function success_upload_dokumen_penerbit()
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

         $users = $this->json('POST', 'api/admin/upload-dokumenpenerbit/18',
         [
            'token'                                            => $token,
            'Dokumen_Akta_Pendirian'                           => $pdf_test_file,
            'Dokumen_SK_Kemenkumham_Akta_Pendirian'            => $pdf_test_file,
            'Dokumen_Anggaran_Dasar_Terakhir'                  => $pdf_test_file,
            'Dokumen_SK_Kemenkumham_Anggaran_Dasar_Terakhir'   => $pdf_test_file,
            'Dokumen_NIB_TDP'                                  => $pdf_test_file,
            'Dokumen_Surat_Izin_Usaha'                         => $pdf_test_file,
            'Dokumen_SKDP'                                     => $pdf_test_file,
            'Dokumen_NPWP_Perusahaan'                          => $pdf_test_file,
            'Dokumen_Lapor_Pajak'                              => $pdf_test_file,
            'status_hutang'                                    => 0
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Dokumen Berhasil di Simpan'
         ]);
     }

     // Fail Upload Dokumen Penerbit
     /** @test */
     
     public function fail_upload_dokumen_penerbit()
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

         $users = $this->json('POST', 'api/admin/upload-dokumenpenerbit/18',
         [
            'token'                                            => $token,
            //'Dokumen_Akta_Pendirian'                           => $image_test_file,
            //'Dokumen_SK_Kemenkumham_Akta_Pendirian'            => $image_test_file,
            //'Dokumen_Anggaran_Dasar_Terakhir'                  => $image_test_file,
            //'Dokumen_SK_Kemenkumham_Anggaran_Dasar_Terakhir'   => $image_test_file,
            //'Dokumen_NIB_TDP'                                  => $image_test_file,
            //'Dokumen_Surat_Izin_Usaha'                         => $image_test_file,
            //'Dokumen_SKDP'                                     => $image_test_file,
            //'Dokumen_NPWP_Perusahaan'                          => $image_test_file,
            //'Dokumen_Lapor_Pajak'                              => '',
            'dokumen_akta_pendirian'                             => $image_test_file,
            'dokumen_sk_kemenkumham_akta_pendirian'              => $image_test_file,
            'dokumen_anggaran_dasar_terakhir'                    => $image_test_file,
            'dokumen_sk_kemenkumham_anggaran_dasar_terakhir'     => $image_test_file,
            'dokumen_nib_tdp'                                    => $image_test_file,
            'dokumen_surat_izin_usaha'                           => $image_test_file,
            'dokumen_skdp'                                       => $image_test_file,
            'dokumen_npwp_perusahaan'                            => $image_test_file,
            'dokumen_lapor_pajak'                                => $image_test_file,
            'status_hutang'                                    => 0
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }

     // Success Upload Dokumen Keuangan
     /** @test */
     
     public function success_upload_dokumen_keuangan()
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

         $users = $this->json('POST', 'api/admin/upload-dokkeuangan/10',
         [
            'token'             => $token,
            'dokumen_keuangan'  => $pdf_test_file
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil di input kedatabase'
         ]);
     }

     // Fail Upload Dokumen Keuangan
     /** @test */
     
     public function fail_upload_dokumen_keuangan()
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

         $users = $this->json('POST', 'api/admin/upload-dokkeuangan/10',
         [
            'token'             => $token,
            'dokumen_keuangan'  => $image_test_file
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }

     // Success Upload Dokumen Usaha
     /** @test */
     
     public function success_upload_dokumen_usaha()
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

         $users = $this->json('POST', 'api/admin/upload-dokusaha/10',
         [
            'token'             => $token,
            'dokumen_usaha'     => $pdf_test_file
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil di input kedatabase'
         ]);
     }

     // Fail Upload Dokumen Usaha
     /** @test */
     
     public function fail_upload_dokumen_usaha()
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

         $users = $this->json('POST', 'api/admin/upload-dokusaha/10',
         [
            'token'             => $token,
            'dokumen_usaha'     => $image_test_file
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }

     // Success Upload Logo Campaign
     /** @test */
     
     public function success_upload_logo_campaign()
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

         $users = $this->json('POST', 'api/admin/upload-logocampaign/10',
         [
            'token'             => $token,
            'logo_campaign'     => $image_test_file
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil di input kedatabase'
         ]);
     }

     // Fail Upload Logo Campaign
     /** @test */
     
     public function fail_upload_logo_campaign()
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

         $users = $this->json('POST', 'api/admin/upload-logocampaign/10',
         [
            'token'             => $token,
            'logo_campaign'     => $pdf_test_file
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }

     // Success Delete Logo Campaign
     /** @test */
     
     public function success_delete_logo_campaign()
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

         $users = $this->json('POST', 'api/admin/remove-CampaignImage/10/1',
         [
            'token'             => $token,
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Gambar Berhasil di Hapus'
         ]);
     }

     // Success Upload Dokumen Roadmap
     /** @test */
     
     public function success_upload_dokumen_roadmap()
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

         $users = $this->json('POST', 'api/admin/upload-dokroadmap/10',
         [
            'token'             => $token,
            'dokumen_roadmap'   => $pdf_test_file
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil di input kedatabase'
         ]);
     }

     // Fail Upload Dokumen Roadmap
     /** @test */
     
     public function fail_upload_dokumen_roadmap()
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

         $users = $this->json('POST', 'api/admin/upload-dokroadmap/10',
         [
            'token'             => $token,
            'dokumen_roadmap'   => $image_test_file
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }
}
