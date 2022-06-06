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

class ProfilingTest2 extends TestCase
{
    //use RefreshDatabase;
    
    // Success Login Test 
    /** @test */
    public function success_login()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'efeff38b57091aa83d70d3ff8e3605e3'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);
    }

    // Success Profiling Test Fase 2
     /** @test */
     public function success_profiling_fase2()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/store-profiling-fase2',
         [
             'token'                    => $token,
             'id_user'                  => '5',
             'maksimal_investasi'       => '3000000',
             'list_pendapatan'          => '',
             'total_pendapatan'         => '30000000',
             'investasi_dilakukan'      => 'tidak',
             'investasi_aktif'          => '0',
             'tujuan_investasi'         => 'menambah penghasilan',
             'urutan_prioritas'         => '123',
             'investor_berpengalaman'   => 'tidak',
             'nomor_sid'                => '123838383883',
             'status_profiling'         => 'sedang_diperiksa',
             'token_privy'              => '1282828828'
         ]);
 
         $users->assertStatus(201)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data user profiling berhasil ditambahkan'
         ]);
     }

     // Success Update Profiling
     /** @test */
     public function success_update_profiling()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/update-profiling',
         [
             'token'                    => $token,
             'id_user'                  => '5',
             'alamat'                   => 'Jalan Durian 1',
             'rtrw'                     => '003/002',
             'kecamatan'                => 'Durian',
             'kelurahan'                => 'Berduri',
             'kota'                     => 'Jakarta',
             'kodepos'                  => '12331',
             'nomor_ponsel'             => '092881999222',
             'nomor_darurat'            => '029929299292',
             'hubungan'                 => 'bapak',
             'nama_lengkap_darurat'     => 'bapak bapak',
             'pendidikan_terakhir'      => 'sma',
             'pekerjaan'                => 'wirausaha',
             'data_bank'                => 'bca',
             'nomor_rekening'           => '12312199',
             'nama_pemilik'             => 'bapak',
             'maksimal_investasi'       => '3000000',
             'list_pendapatan'          => '',
             'total_pendapatan'         => '30000000',
             'password'                 => 'TestUser002'
             
         ]);
 
         $users->assertStatus(201)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Profil berhasil diubah!'
         ]);
     }

     // Fail Update Profiling
     /** @test */
     public function fail_update_profiling()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/update-profiling',
         [
             'token'                    => $token,
             'id_user'                  => '5',
             'alamat'                   => 'Jalan Durian 1',
             'rtrw'                     => '003/002',
             'kecamatan'                => 'Durian',
             'kelurahan'                => 'Berduri',
             'kota'                     => 'Jakarta',
             'kodepos'                  => '12331',
             'nomor_ponsel'             => '092881999222',
             'nomor_darurat'            => '029929299292',
             'hubungan'                 => 'bapak',
             'nama_lengkap_darurat'     => 'bapak bapak',
             'pendidikan_terakhir'      => 'sma',
             'pekerjaan'                => 'wirausaha',
             'data_bank'                => 'bca',
             'nomor_rekening'           => '12312199',
             'nama_pemilik'             => 'bapak',
             'maksimal_investasi'       => '3000000',
             'list_pendapatan'          => '',
             'total_pendapatan'         => '30000000',
             'password'                 => ''
             
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => 'Kata sandi salah!'
         ]);
     }
}
