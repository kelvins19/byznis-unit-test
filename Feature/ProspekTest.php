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

class ProspekTest extends TestCase
{
    // Success Login Test 
    /** @test */
    public function success_login()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser001!'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);
    }

     // Success Store Prospek
     /** @test */
     
     public function success_store_prospek()
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
         $data_prospek = ['id_kampanye' => '10', 'tipe' => 'minuman', 'periode' => '2020', 'value' => '10000000'];

         $users = $this->json('POST', 'api/penerbit/store-prospek',
         [
             'token'                => $token,
             'id_kampanye'          => '10',
             'list_data_prospek'    => [$data_prospek]
             //'list_data_prospek[id_kampanye]'          => '20',
             //'list_data_prospek[tipe]'                 => 'Makanan',
             //'list_data_prospek[periode]'              => '2020',
             //'list_data_prospek[value]'                => '10000000',
         ]);
 
         $users->assertStatus(201)->assertJson([
             'status'     => 'sukses',
             'message'    => 'Data prospek berhasil ditambahkan'
         ]);
     }

     // Fail Store Prospek
     /** @test */
     
     public function fail_store_prospek()
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
         $data_prospek = ['id_kampanye' => '10', 'tipe' => 'minuman', 'periode' => '', 'value' => ''];

         $users = $this->json('POST', 'api/penerbit/store-prospek',
         [
             'token'                => $token,
             'id_kampanye'          => '10',
             'list_data_prospek'    => [$data_prospek]
             //'list_data_prospek[id_kampanye]'          => '20',
             //'list_data_prospek[tipe]'                 => 'Makanan',
             //'list_data_prospek[periode]'              => '2020',
             //'list_data_prospek[value]'                => '10000000',
         ]);
 
         $users->assertStatus(500);
     }

     // Success Update Prospek
     /** @test */
     
     public function success_update_prospek()
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
         $data_prospek = ['id_kampanye' => '10', 'tipe' => 'minuman', 'periode' => '2020', 'value' => '10000000'];
         //$data_prospek = ['10', 'minuman', '2020', '100000'];

         $users = $this->json('POST', 'api/penerbit/update-prospek',
         [
             'token'                => $token,
             'id_kampanye'          => 20,
             'list_data_prospek'    => [$data_prospek]
         ]);

         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            'message'    => 'Data prospek berhasil ditambahkan'
        ]);
     }

     // Fail Update Prospek
     /** @test */
     
     public function fail_update_prospek()
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
         $data_prospek = ['id_kampanye' => '10', 'tipe' => 'minuman', 'periode' => '', 'value' => '10000000'];
         //$data_prospek = ['10', 'minuman', '2020', '100000'];

         $users = $this->json('POST', 'api/penerbit/update-prospek',
         [
             'token'                => $token,
             'id_kampanye'          => 20,
             'list_data_prospek'    => [$data_prospek]
         ]);

         $users->assertStatus(500);
        
     }
     
}
