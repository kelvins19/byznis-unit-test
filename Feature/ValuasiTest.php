<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValuasiTest extends TestCase
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

    // Success Store Valuasi
     /** @test */
     
     public function success_store_valuasi()
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

         $users = $this->json('POST', 'api/penerbit/store-valuasi/eyJpdiI6IkxnN1dQTWpRUGdiOWEreU1ab080cnc9PSIsInZhbHVlIjoiczFUanhoNEk1VnNqMEJ6ZmxtQjI4dz09IiwibWFjIjoiOGJhNGQ5NDA2YWZhYjdiOWZiNjMzZTBiMTU2NmRhMTgyOTYwMTA0ODAwZDYzNDYzN2Y0ZDExYzBiZjkwNjlmOSJ9',
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

     // Success Store Valuasi
     /** @test */
     
     public function update_status_valuasi()
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

         $users = $this->json('POST', 'api/penerbit/update-status-valuasi/13',
         [
             'token'                        => $token,
             'status'                       => 'terima_valuasi_sementara'
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'message'    => 'Data Berhasil di Simpan'
         ]);
     }
}
