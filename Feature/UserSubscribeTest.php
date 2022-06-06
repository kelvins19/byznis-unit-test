<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserSubscribeTest extends TestCase
{
   // Fail Subscribe
     /** @test */
     
     public function fail_subscribe()
     {
        
        //$data = $users->decodeResponseJson();
        //echo $data['token'];
        //$token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/v1/subscribe',
         [
             'email'        => 'subscribe_test@gmail.com',
             'password'     => 'TestUser001!',
             'user_role'    => 2,
             'subscribe'    => 1

         ]);
 
         $users->assertStatus(401)->assertJson([
            'status'     => 'gagal',
        ]);
    }

    // Success Subscribe
     /** @test */
     
     public function success_subscribe()
     {
        
        //$data = $users->decodeResponseJson();
        //echo $data['token'];
        //$token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/v1/subscribe',
         [
             'email'        => 'subscribe_test03@gmail.com',
             'password'     => 'TestUser001!',
             'user_role'    => 2,
             'subscribe'    => 1

         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'berhasil',
            'message'    => 'Subscribe Berhasil!'
        ]);
    }
}
