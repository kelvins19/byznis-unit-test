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

class PemilikSahamTest extends TestCase
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

    // Success Store Pemilik Saham
     /** @test */
     
     public function success_store_pemilik_saham()
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

         $users = $this->json('POST', 'api/penerbit/store-pemiliksaham/eyJpdiI6ImJRV3JtS1ByTXBJRmFTUmRJeGI3S0E9PSIsInZhbHVlIjoiRHplVXAwQndoZWIyc3VnOHRQa1h2QT09IiwibWFjIjoiYzc2ZjE2ZDNkNGQwODQ2N2E4ODU2NWQzMTQ3ZmZjOGQ3Y2Y3MzU4YWRhN2ZiNGIyN2QyM2FmZDI2MjNmZjE3MyJ9',
         [
             'token'                        => $token,
             'id_penerbit'                  => '18',
             'id_user'                      => 'eyJpdiI6ImN2NURweDZTN0ZYZTA5aTZMOWM4T1E9PSIsInZhbHVlIjoiV1AyWlNWUmJrb3Z1c2dWSmxJeXVBQT09IiwibWFjIjoiMDlmODRmMzQzN2YwM2RiYWM1NDFhNmRmOGM0NTkwOGQ2YWY5OGVkMDBiMTJjMWRlMmEyMDkwNWQ4ZTVlODc4MyJ9',
             'email'                        => 'pemilik_saham@gmail.com',
             'status'                       => 'publik',
             'lembar'                       => '20000',
             'lembar_lepas'                 => '10000'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'data berhasil disimpan'
         ]);
     }

     // Success Update Pemilik Saham
     /** @test */
     
     public function success_update_pemilik_saham()
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

         $users = $this->json('POST', 'api/penerbit/update-pemiliksaham/2',
         [
             'token'                        => $token,
             'id'                           => 'eyJpdiI6IjdLeU02dG80SGxIcW92TE5FYlF3Zmc9PSIsInZhbHVlIjoiNnpSQ0FTYTFMRHJWS1ZYMHJnMlVzZz09IiwibWFjIjoiMWZhMDYxMTMwMTEzYTk2YTk0M2E2ZmUwMWE5ODJmMzYyODlkOTgzMDdhY2EyNjFjYmQzZDNjYWQxZWRjOTVhZCJ9',
             'lembar'                       => '10000',
             'nilai_sebelum'                => '20000'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Simpan'
         ]);
     }

     // Success Remove Pemilik Saham
     /** @test */
     
     public function success_remove_pemilik_saham()
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

         $users = $this->json('POST', 'api/penerbit/remove-pemiliksaham/eyJpdiI6IkhSUlBlUmZpYjFIK3ZPek1SVU1EdHc9PSIsInZhbHVlIjoiZTVNSzBJenVkZUZyQXlkMTJSNHJWdz09IiwibWFjIjoiYmJjNTY5NjM3YzFmZDkxYTFiZmY5NmRmZWQ3YjE5OWMyMzRhMGFmNzIwMWVjN2VjZGE1NGQ1MDlkMTMwNTExZCJ9',
         [
             'token'                        => $token,
             'id_penerbit'                  => 'eyJpdiI6ImhEZXJ5b3JHZFdzQTAxOVFKODc1NkE9PSIsInZhbHVlIjoiQkw3ajR0TkFHeWptXC9ncUpScjljOFE9PSIsIm1hYyI6IjkxMGJiMzEzYzY1YWViM2ZkYjg1MGM4MGFjMDk5NGUxZGU1NDQ1YTk4NGQ4ZjMyMWQ4MWQ5OWIyYmRkNTFkMjEifQ==',
             'id_user'                      => 'eyJpdiI6IlgyOFN6TExDWGlKZ1BmMThaeTBYUHc9PSIsInZhbHVlIjoiRFp1elJ1amRIbFhnbVB1dXVCb2drUT09IiwibWFjIjoiNGNmZmJlZGMxOWVkNmNhMTUyZDk4ZWNlMGQwNGZiMDc2NTI1YmIyNjM3ZGRhOGQzNjBlNzc3MzYxODRmMzgwNiJ9'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'user tidak ada'
         ]);
     }
}
