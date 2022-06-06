<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_TransaksiTest extends TestCase
{
    // Success Store Transaksi
     /** @test */
     
     public function success_tambah_transaksi()
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

         $users = $this->json('POST', 'api/v1/transactions',
         [
             'token'           => $token,
             'id_campaign'      => 'eyJpdiI6IitTMXI1SWorbm1UTzk4blU5cFQxWVE9PSIsInZhbHVlIjoibDVGNkJVeVhLa3lCa2NicVVpcCtuUT09IiwibWFjIjoiN2FhZTcxMzhkNTgxNjVkNjQ5ZTIzMjAxZDRhMjU3YjAyNDhiMTU2Yzk1ZjEzYmIyMjljZmY2Yjk0MzAyNDM1OCJ9',
            'jumlah_lembar'     => '20',
            'jumlah_pembelian'  => '2000000',
            'biaya_admin'       => '15000',
            'metode_pembayaran' => 'Bank_Transfer',

         ]);
 
         $users->assertStatus(201);
     }

     // Success Update Transaksi
     /** @test */
     
     public function success_update_transaksi()
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

         $users = $this->json('POST', 'api/admin/update-transaction/3',
         [
             'token'           => $token,
             'status_transaction'   => 'transaksi_selesai'

         ]);
 
         $users->assertStatus(201);
     }
}
