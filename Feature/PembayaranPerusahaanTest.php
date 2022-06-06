<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PembayaranPerusahaanTest extends TestCase
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

    // Generate Success Fee (ADMIN SIDE)
     /** @test */
     
     public function success_generate_successfee()
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

         $users = $this->json('POST', 'api/admin/generate-fee/18/success',
         [
             'token'                    => $token,
             'id_user'                  => '5',
             'id_penerbit'              => '18',
             'id_kampanye'              => '10',
             'nomor_nota'               => '12330002222',
             'tipe'                     => 'success',
             'jumlah'                   => '100000'
             
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'data'    => 'successFee Berhasil Ditambah'
         ]);
     }

     // Success Upload Success Fee
     /** @test */
     
     public function success_upload_successfee()
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

         $users = $this->json('POST', 'api/penerbit/upload-successfee/eyJpdiI6ImdzTzF6M0dSREtXZDRORG9Mc2xacVE9PSIsInZhbHVlIjoicTZaWmdnNDhFXC82UXZGaGpXQktPNHc9PSIsIm1hYyI6IjA2OTk2YTBiYTYxMDdhMTU2ODdmZWIxNzg3ZDJiYmE2NGM4NDUxOGY5NDc1NTc2MjZiMzIzMTFiOGRjMDhlYmEifQ==',
         [
             'token'                    => $token,
             'id_penerbit'              => '18',
             'id_kampanye'              => '9',
             'buktifee'                 => $image_test_file,
             'tanggal_pembayaran'       => '10-05-2020'
             
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil'
         ]);
     }

     // Generate Listing Fee (ADMIN SIDE)
     /** @test */
     
     public function success_generate_listingfee()
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

         $users = $this->json('POST', 'api/admin/generate-fee/18/listing',
         [
             'token'                    => $token,
             'id_user'                  => '5',
             'id_penerbit'              => '18',
             'id_kampanye'              => '10',
             'nomor_nota'               => '12330002222',
             'tipe'                     => 'listing',
             'jumlah'                   => '100000'
             
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'data'       => 'listingFee Berhasil Ditambah'
         ]);
     }

     // Success Upload Listing Fee
     /** @test */
     
     public function success_upload_listingfee()
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

         $users = $this->json('POST', 'api/penerbit/upload-listingfee/eyJpdiI6ImdzTzF6M0dSREtXZDRORG9Mc2xacVE9PSIsInZhbHVlIjoicTZaWmdnNDhFXC82UXZGaGpXQktPNHc9PSIsIm1hYyI6IjA2OTk2YTBiYTYxMDdhMTU2ODdmZWIxNzg3ZDJiYmE2NGM4NDUxOGY5NDc1NTc2MjZiMzIzMTFiOGRjMDhlYmEifQ==',
         [
             'token'                    => $token,
             'id_penerbit'              => '18',
             'id_kampanye'              => '9',
             'buktifee'                 => $image_test_file,
             'tanggal_pembayaran'       => '10-05-2020'
             
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil'
         ]);
     }

     // Success Update Success Fee (ADMIN SIDE)
     /** @test */
     
     public function success_update_successfee()
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

         $users = $this->json('POST', 'api/admin/update-successfee/31',
         [
             'token'                    => $token,
             'status'                   => 'berhasil'
             
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'data'    => 'Status Berhasil Diubah'
         ]);
     }

     // Success Update Listing Fee (ADMIN SIDE)
     /** @test */
     
     public function success_update_listingfee()
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

         $users = $this->json('POST', 'api/admin/update-successfee/32',
         [
             'token'                    => $token,
             'status'                   => 'berhasil'
             
         ]);
 
         $users->assertStatus(200)->assertJson([
             'status'     => 'berhasil',
             'data'       => 'Status Berhasil Diubah'
         ]);
     }
}
