<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreDetailBisnis extends TestCase
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
    

    // Success Store Bisnis Test
     /** @test */
     
     public function success_store_bisnis()
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
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/penerbit/store-bisnis/eyJpdiI6Ikp1b2lUcE4xYmIzRTZaRGJjam9mMVE9PSIsInZhbHVlIjoiY1lRXC9Jc1BHdVhoS0ZHZmhxNDR1K1E9PSIsIm1hYyI6ImJhODI2ZWQ0ZTU5YjFmZjU5YjY4ZGI0NWM0NGNhMDJjZjU3OWJkMzJkNGI2YmZhNTQ4YTQzNTVlYzBhMDkzZDQifQ==',
         [
            'nama_campaign'             => 'TestCampaign',
            'alamat_kantor'             => 'Jalan Mangga 123 Jakarta',
            'alamat_usaha'              => 'Jalan Durian 123 Jakarta',
            'telepon'                   => '08123456789',
            'status'                    => '0',
            'status_merek'              => '0',
            'status_usaha_diajukan'     => 'masih request',
            'kota_campaign'             => 'Jakarta',
            'mulai_campaign'            => '29 Februari 2020',
            'akhir_campaign'            => '31 Desember 2020',
            'dana_dibutuhkan'           => '999999',
            'berdiri_sejak'             => '1 Maret 2020',
            'total_cabang'              => 10,
            'deskripsi_campaign'        => 'Test Deskripsi Campaign',
            'jenis_usaha'               => 'Test Usaha',
            'sumber_dana_lain'          => 'Test',
            'minInvestasi'              => '1000000',
            'harga_perlembar'           => '100000',
            'industri'                  => 'Teknologi',
            'jumlah_saham_dilepas'      => '100',
            'roi'                       => '100',
            'dividen'                   => '100',
            'bep'                       => '100',
            'link_alamat'               => 'https:test.com',
            'logo'                      => $image_test_file,
            'dokumen_usaha'             => $pdf_test_file,
            'dokumen_roadmap'           => $pdf_test_file,
            'dokumen_keuangan'          => $pdf_test_file,
            'image'                     => array($image_test_file, $image_test_file, $image_test_file),
            'jumlah_saham_diterbitkan'  => '1000',
            'jumlah_pemegang'           => '100',
             'token'        => $token
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'berhasil menginput data campaign'
         ]);
     }

     // Fail Store Bisnis Test
     /** @test */
     
     public function fail_store_bisnis()
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
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/penerbit/store-bisnis/eyJpdiI6Ikp1b2lUcE4xYmIzRTZaRGJjam9mMVE9PSIsInZhbHVlIjoiY1lRXC9Jc1BHdVhoS0ZHZmhxNDR1K1E9PSIsIm1hYyI6ImJhODI2ZWQ0ZTU5YjFmZjU5YjY4ZGI0NWM0NGNhMDJjZjU3OWJkMzJkNGI2YmZhNTQ4YTQzNTVlYzBhMDkzZDQifQ==',
         [
            'nama_campaign'             => 'TestCampaign',
            'alamat_kantor'             => 'Jalan Mangga 123 Jakarta',
            'alamat_usaha'              => 'Jalan Durian 123 Jakarta',
            'telepon'                   => '08123456789',
            'status'                    => '0',
            'status_merek'              => '0',
            'status_usaha_diajukan'     => 'masih request',
            'kota_campaign'             => 'Jakarta',
            'mulai_campaign'            => '29 Februari 2020',
            'akhir_campaign'            => '31 Desember 2020',
            'dana_dibutuhkan'           => '999999',
            'berdiri_sejak'             => '1 Maret 2020',
            'total_cabang'              => 10,
            'deskripsi_campaign'        => 'Test Deskripsi Campaign',
            'jenis_usaha'               => 'Test Usaha',
            'sumber_dana_lain'          => 'Test',
            'minInvestasi'              => '1000000',
            'harga_perlembar'           => '100000',
            'industri'                  => 'Teknologi',
            'jumlah_saham_dilepas'      => '100',
            'roi'                       => '100',
            'dividen'                   => '100',
            'bep'                       => '100',
            'link_alamat'               => 'https:test.com',
            'logo'                      => $pdf_test_file,
            'dokumen_usaha'             => $image_test_file,
            'dokumen_roadmap'           => $image_test_file,
            'dokumen_keuangan'          => $image_test_file,
            'image'                     => array($image_test_file, $image_test_file, $image_test_file),
            'jumlah_saham_diterbitkan'  => '1000',
            'jumlah_pemegang'           => '100',
             'token'        => $token
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }

    // Success Update Bisnis Test
     /** @test */
     
     public function success_update_bisnis()
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
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/penerbit/update-bisnis/eyJpdiI6Ikp1b2lUcE4xYmIzRTZaRGJjam9mMVE9PSIsInZhbHVlIjoiY1lRXC9Jc1BHdVhoS0ZHZmhxNDR1K1E9PSIsIm1hYyI6ImJhODI2ZWQ0ZTU5YjFmZjU5YjY4ZGI0NWM0NGNhMDJjZjU3OWJkMzJkNGI2YmZhNTQ4YTQzNTVlYzBhMDkzZDQifQ==',
         [
            'nama_campaign'             => 'TestUpdate',
            'alamat_kantor'             => 'Jalan Mangga 123 Jakarta',
            'alamat_usaha'              => 'Jalan Durian 123 Jakarta',
            'telepon'                   => '08123456789',
            'status'                    => '0',
            'status_merek'              => '0',
            'status_usaha_diajukan'     => 'masih request',
            'kota_campaign'             => 'Jakarta',
            'mulai_campaign'            => '29 Februari 2020',
            'akhir_campaign'            => '31 Desember 2020',
            'dana_dibutuhkan'           => '999999',
            'berdiri_sejak'             => '1 Maret 2020',
            'total_cabang'              => 10,
            'deskripsi_campaign'        => 'Test Deskripsi Campaign',
            'jenis_usaha'               => 'Test Usaha',
            'sumber_dana_lain'          => 'Test',
            'minInvestasi'              => '1000000',
            'harga_perlembar'           => '100000',
            'industri'                  => 'Teknologi',
            'jumlah_saham_dilepas'      => '100',
            'roi'                       => '100',
            'dividen'                   => '100',
            'bep'                       => '100',
            'link_alamat'               => 'https:test.com',
            'logo'                      => $image_test_file,
            'dokumen_usaha'             => $pdf_test_file,
            'dokumen_roadmap'           => $pdf_test_file,
            'dokumen_keuangan'          => $pdf_test_file,
            'image[0]'                  => $image_test_file,
            'image[1]'                  => $image_test_file,
            'jumlah_saham_diterbitkan'  => '1000',
            'jumlah_pemegang'           => '100',
             'token'        => $token
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'berhasil menginput data campaign'
         ]);
     }

     // Success Remove Image Bisnis Test
     /** @test */
     
     public function remove_image_bisnis()
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
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/penerbit/remove-imagebisnis/eyJpdiI6IjdxcW4wek1nTUxWOFpPZXluR1FMbWc9PSIsInZhbHVlIjoic25uQ3hxT0dFaFM4YzRwNEczMzdRQT09IiwibWFjIjoiZDcwNGZjNTRjYmFkNmI2M2QxMDJjM2ZmYmVjMDI4NzU2MTNmMzZiMDllYzEzOGU5NzIzZWNmMzNhODE1ZmRiMCJ9/1',
         [
             'token'        => $token
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Gambar Berhasil di Hapus'
         ]);
     }

     // Fail Remove Image Bisnis Test
     /** @test */
     
     public function fail_remove_image_bisnis()
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
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/penerbit/remove-imagebisnis/eyJpdiI6IjdxcW4wek1nTUxWOFpPZXluR1FMbWc9PSIsInZhbHVlIjoic25uQ3hxT0dFaFM4YzRwNEczMzdRQT09IiwibWFjIjoiZDcwNGZjNTRjYmFkNmI2M2QxMDJjM2ZmYmVjMDI4NzU2MTNmMzZiMDllYzEzOGU5NzIzZWNmMzNhODE1ZmRiMCJ9/100',
         [
             'token'        => $token
         ]);
 
         $users->assertStatus(500);
     }
}