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

class ProfilingTest extends TestCase
{
    //use RefreshDatabase;
    
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

    // FASE 1.1
    // Fail KTP Test
     /** @test */
     public function failed_ktp()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $image_file_test = 'test_file.jpeg';
         $pdf_file_test = 'test_file.pdf';

         $users = $this->json('POST', 'api/v1/upload-photodocument',
         [
             'photoktp'          => $pdf_file_test,
             'photoselfie'       => $image_file_test,
             'photonpwp'         => $image_file_test,
             'photorekening'     => $image_file_test,
             'token'        => $token
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => 'ktp'
         ]);
     }

     
     // Fail KTP Selfie Test
     /** @test */
     
     public function failed_ktp_selfie()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $image_file_test = 'test_file.jpeg';
         $pdf_file_test = 'test_file.pdf';

         $users = $this->json('POST', 'api/v1/upload-photodocument',
         [
             'photoktp'          => $image_file_test,
             'photoselfie'    => $pdf_file_test,
             'photonpwp'         => $image_file_test,
             'photorekening'     => $image_file_test,
             'token'        => $token
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => 'ktp_selfie'
         ]);
     } 

     // Fail NPWP Test
     /** @test */
     
     public function failed_npwp()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $image_file_test = 'test_file.jpeg';
         $pdf_file_test = 'test_file.pdf';

         $users = $this->json('POST', 'api/v1/upload-photodocument',
         [
             'photoktp'          => $image_file_test,
             'photoselfie'    => $image_file_test,
             'photonpwp'         => $pdf_file_test,
             'photorekening'     => $image_file_test,
             'token'        => $token
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => 'npwp'
         ]);
     } 

     // Fail Rekening Test
     /** @test */
     
     public function failed_rekening()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $image_file_test = 'test_file.jpeg';
         $pdf_file_test = 'test_file.pdf';

         $users = $this->json('POST', 'api/v1/upload-photodocument',
         [
             'photoktp'          => $image_file_test,
             'photoselfie'    => $image_file_test,
             'photonpwp'         => $image_file_test,
             'photorekening'     => $pdf_file_test,
             'token'        => $token
         ]);
 
         $users->assertStatus(400)->assertJson([
             'status'     => 'gagal',
             'message'    => 'rekening'
         ]);
     } 

     // Success Upload Docs Test
     /** @test */
     
     public function success_upload_docs()
     {
        $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $image_file_test = 'test_file.jpeg';
         $pdf_file_test = 'test_file.pdf';

         $users = $this->json('POST', 'api/v1/upload-photodocument',
         [
             'photoktp'          => $image_file_test,
             'photoselfie'    => $image_file_test,
             'photonpwp'         => $image_file_test,
             'photorekening'     => $image_file_test,
             'token'        => $token
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil di input kedatabase'
         ]);
     }

     // FASE 1.2
     // Success Profiling Test
     /** @test */
     public function success_phase12()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/store-profiling-fase1',
         [
             'nama_lengkap'     => 'Test User',
             'nomor_ktp'        => '1234567891234567',
             'nomor_npwp'       => '1234567891234567',
             'tanggal_lahir'    => '29 Februari 1999',
             'jenis_kelamin'    => 'Perempuan',
             'alamat'           => 'Jalan Mangga 123',
             'rtrw'             => '001',
             'kecamatan'        => 'DKI',
             'kelurahan'        => 'DKI',
             'kota'             => 'Jakarta',
             'kodepos'          => '123456',
             'nomor_ponsel'     => '08123456789',
             'nomor_darurat'    => '081234567890',
             'hubungan'         => 'Ayah',
             'nama_lengkap_darurat' => 'Test User 1',
             'pendidikan_terakhir'  => 'Sarjana',
             'data_bank'        => '1234567',
             'nomor_rekening'   => '1234567891234567',
             'nama_pemilik'     => 'Test User',
             'token'        => $token
         ]);
 
         $users->assertStatus(201)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data user profiling berhasil ditambahkan'
         ]);
     }

     // Fail Name Test
     /** @test */
     public function failed_name()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/store-profiling-fase1',
         [
             'nama_lengkap'     => 'Te',
             'nomor_ktp'        => '1234567891234567',
             'nomor_npwp'       => '1234567891234567',
             'tanggal_lahir'    => '29 Februari 1999',
             'jenis_kelamin'    => 'Perempuan',
             'alamat'           => 'Jalan Mangga 123',
             'rtrw'             => '001',
             'kecamatan'        => 'DKI',
             'kelurahan'        => 'DKI',
             'kota'             => 'Jakarta',
             'kodepos'          => '123456',
             'nomor_ponsel'     => '08123456789',
             'nomor_darurat'    => '081234567890',
             'hubungan'         => 'Ayah',
             'nama_lengkap_darurat' => 'Test User 1',
             'pendidikan_terakhir'  => 'Sarjana',
             'data_bank'        => '1234567',
             'nomor_rekening'   => '1234567891234567',
             'nama_pemilik'     => 'Test User',
             'token'        => $token
         ]);
 
         $users->assertStatus(401)->assertJson([
             'status'     => 'gagal',
             'message'    => 'Minimal 3 karakter'
         ]);
     }

     // Fail NIKTest
     /** @test */
     public function failed_nik()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/store-profiling-fase1',
         [
             'nama_lengkap'     => 'Test User',
             'nomor_ktp'        => '1',
             'nomor_npwp'       => '1234567891234567',
             'tanggal_lahir'    => '29 Februari 1999',
             'jenis_kelamin'    => 'Perempuan',
             'alamat'           => 'Jalan Mangga 123',
             'rtrw'             => '001',
             'kecamatan'        => 'DKI',
             'kelurahan'        => 'DKI',
             'kota'             => 'Jakarta',
             'kodepos'          => '123456',
             'nomor_ponsel'     => '08123456789',
             'nomor_darurat'    => '081234567890',
             'hubungan'         => 'Ayah',
             'nama_lengkap_darurat' => 'Test User 1',
             'pendidikan_terakhir'  => 'Sarjana',
             'data_bank'        => '1234567',
             'nomor_rekening'   => '1234567891234567',
             'nama_pemilik'     => 'Test User',
             'token'        => $token
         ]);
 
         $users->assertStatus(401)->assertJson([
             'status'     => 'gagal',
             'message'    => 'Minimal 16 angka'
         ]);
     }

     // Fail Nomor Ponsel Test
     /** @test */
     public function failed_nomor_ponsel()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/store-profiling-fase1',
         [
             'nama_lengkap'     => 'Test User',
             'nomor_ktp'        => '1234567891234567',
             'nomor_npwp'       => '1234567891234567',
             'tanggal_lahir'    => '29 Februari 1999',
             'jenis_kelamin'    => 'Perempuan',
             'alamat'           => 'Jalan Mangga 123',
             'rtrw'             => '001',
             'kecamatan'        => 'DKI',
             'kelurahan'        => 'DKI',
             'kota'             => 'Jakarta',
             'kodepos'          => '123456',
             'nomor_ponsel'     => '0812',
             'nomor_darurat'    => '081234567890',
             'hubungan'         => 'Ayah',
             'nama_lengkap_darurat' => 'Test User 1',
             'pendidikan_terakhir'  => 'Sarjana',
             'data_bank'        => '1234567',
             'nomor_rekening'   => '1234567891234567',
             'nama_pemilik'     => 'Test User',
             'token'        => $token
         ]);
 
         $users->assertStatus(401)->assertJson([
             'status'     => 'gagal',
             'message'    => 'Minimal 10 karakter'
         ]);
     }

     // Failed Nomor Darurat Test
     /** @test */
     public function failed_nomor_darurat()
     {
         $credentials = ['email'=>'test_user@gmail.com','password'=>'TestUser002'];
        $users = $this->json('POST', 'api/v1/login',$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $users = $this->json('POST', 'api/v1/store-profiling-fase1',
         [
             'nama_lengkap'     => 'Test User',
             'nomor_ktp'        => '1234567891234567',
             'nomor_npwp'       => '1234567891234567',
             'tanggal_lahir'    => '29 Februari 1999',
             'jenis_kelamin'    => 'Perempuan',
             'alamat'           => 'Jalan Mangga 123',
             'rtrw'             => '001',
             'kecamatan'        => 'DKI',
             'kelurahan'        => 'DKI',
             'kota'             => 'Jakarta',
             'kodepos'          => '123456',
             'nomor_ponsel'     => '08123456789',
             'nomor_darurat'    => '08',
             'hubungan'         => 'Ayah',
             'nama_lengkap_darurat' => 'Test User 1',
             'pendidikan_terakhir'  => 'Sarjana',
             'data_bank'        => '1234567',
             'nomor_rekening'   => '1234567891234567',
             'nama_pemilik'     => 'Test User',
             'token'        => $token
         ]);
 
         $users->assertStatus(401)->assertJson([
             'status'     => 'gagal',
             'message'    => 'Minimal 10 karakter'
         ]);
     }
     
}
