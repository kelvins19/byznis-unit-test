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

class StoreDetailPerusahaaan extends TestCase
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
    

    // Success Store Campaign Test
     /** @test */
     /*
     public function success_store_campaign()
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

         $users = $this->json('POST', 'api/penerbit/store-perusahaan/',
         [
             'nama_perseroan'               => 'TestPerseroan',
             'email_pemegang_saham'         => '',
             'akta_pendirian'               => '1234567891234567',
             'sk_kemenkumham_akta_pendirian'=> '099999',
             'anggaran_dasar_terakhir'      => '1000000',
             'sk_kemenkumham_anggaran_dasar_terakhir'   => '9999',
             'nib_tdp'                      => '99999',
             'surat_izin_usaha'             => '9999',
             'skdp'                         => '9999',
             'npwp_perusahaan'              => '99999',
             'status_hutang'                => '0',
             'dokumen_akta_pendirian'       => $pdf_test_file,
             'dokumen_sk_kemenkumham_akta_pendirian'    => $pdf_test_file,
             'dokumen_anggaran_dasar_terakhir'          => $pdf_test_file,
             'dokumen_sk_kemenkumham_anggaran_dasar'    => $pdf_test_file,
             'dokumen_nib_tdp'                          => $pdf_test_file,
             'dokumen_surat_izin_usaha'     => $pdf_test_file,
             'dokumen_skdp'                 => $pdf_test_file,
             'dokumen_npwp_perusahaan'      => $pdf_test_file,
             'token'        => $token
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Simpan'
         ]);
     }
     */
}
