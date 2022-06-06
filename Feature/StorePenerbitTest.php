<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\Response as HttpResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Request;
use Response;
use App\User;

class StorePenerbitTest extends TestCase
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

    // Success Store Penerbiy
     /** @test */
     
     public function success_store_penerbit()
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

         $users = $this->json('POST', 'api/penerbit/store-penerbit',
         [
             'token'                        => $token,
             'nama_perseroan'               => 'TestPerseroan',
             'modal_dasar'                  => '3000000000',
             'jum_lem_saham_modal_dasar'    => '300000',
             'modal_disetor'                => '500000000',
             'status_usaha'                 => '0',
             'status_hutang'                => '0',
             'status_saham'                 => '0',
             'badan_usaha'                  => 'PT',
             'dana_dibutuhkan'              => '2000000000',
             'timeline'                     => '1'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Simpan'
         ]);
     }

     // Success Update Penerbit
     /** @test */
     
     public function success_update_penerbit()
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

         $users = $this->json('POST', 'api/penerbit/update-penerbit/eyJpdiI6Ikp1b2lUcE4xYmIzRTZaRGJjam9mMVE9PSIsInZhbHVlIjoiY1lRXC9Jc1BHdVhoS0ZHZmhxNDR1K1E9PSIsIm1hYyI6ImJhODI2ZWQ0ZTU5YjFmZjU5YjY4ZGI0NWM0NGNhMDJjZjU3OWJkMzJkNGI2YmZhNTQ4YTQzNTVlYzBhMDkzZDQifQ==',
         [
             'token'                        => $token,
             'nama_perseroan'               => 'TestUpdate',
             'modal_dasar'                  => '3000000000',
             'jum_lem_saham_modal_dasar'    => '300000',
             'modal_disetor'                => '500000000',
             'status_usaha'                 => '0',
             'status_hutang'                => '0',
             'status_saham'                 => '0',
             'dana_dibutuhkan'              => '2000000000',
             'timeline'                     => '1'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Update'
         ]);
     }
     
     // Success Upload Document Penerbit
     /** @test */
     
     public function success_upload_dokumen_penerbit()
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

         $users = $this->json('POST', 'api/penerbit/upload-dokumenpenerbit/18',
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
             'status_hutang'                                    => 0,
             'status_revisi'                                    => 1,
             'timeline'                                         => 'submit_dokumen',

         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Update'
         ]);
     }

     // Fail Upload Document Penerbit
     /** @test */
     
     public function fail_upload_dokumen_penerbit()
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

         $users = $this->json('POST', 'api/penerbit/upload-dokumenpenerbit/18',
         [
             'token'                                            => $token,
             'Dokumen_Akta_Pendirian'                           => $image_test_file,
             'Dokumen_SK_Kemenkumham_Akta_Pendirian'            => $image_test_file,
             'Dokumen_Anggaran_Dasar_Terakhir'                  => $image_test_file,
             'Dokumen_SK_Kemenkumham_Anggaran_Dasar_Terakhir'   => $image_test_file,
             'Dokumen_NIB_TDP'                                  => $image_test_file,
             'Dokumen_Surat_Izin_Usaha'                         => $image_test_file,
             'Dokumen_SKDP'                                     => $image_test_file,
             'Dokumen_NPWP_Perusahaan'                          => $image_test_file,
             'Dokumen_Lapor_Pajak'                              => $image_test_file,
             'status_hutang'                                    => 0,
             'status_revisi'                                    => 1,
             'timeline'                                         => 'submit_dokumen',

         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
         ]);
     }
     
}
