<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_ArtikelBannerTest extends TestCase
{
    // Success Store Banner
     /** @test */
     
     public function success_store_banner()
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

         $users = $this->json('POST', 'api/admin/store-banner',
         [
             'token'           => $token,
             'banner'          => $image_test_file,
             'type_banner'     => 'Scrolllable'
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            ' message'    => 'Banner Berhasil di Upload'
        ]);
    }

    // Fail Store Banner
     /** @test */
     
     public function fail_store_banner()
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

         $users = $this->json('POST', 'api/admin/store-banner',
         [
             'token'           => $token,
             'banner'          => $pdf_test_file,
             'type_banner'     => 'Scrolllable'
         ]);
 
         $users->assertStatus(400);
    }

    // Success Update Banner
     /** @test */
     
     public function success_update_banner()
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

         $users = $this->json('POST', 'api/admin/update-banner/15',
         [
             'token'           => $token,
             'banner'          => $image_test_file,
             'type_banner'     => 'Scrolllable'
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            ' message'    => 'Banner Berhasil di Upload'
        ]);
    }

    // Success Remove Banner
     /** @test */
     
     public function success_remove_banner()
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

         $users = $this->json('POST', 'api/admin/remove-banner/15',
         [
             'token'           => $token,
         ]);
 
         $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
            'message'    => 'Banner berhasil di Hapus'
        ]);
    }

    // Success Store Artikel
     /** @test */
     
     public function success_store_artikel()
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

         $users = $this->json('POST', 'api/admin/store-artikel',
         [
             'token'           => $token,
             'cover'           => $image_test_file,
             'judul'           => 'Judul Test',
             'text'            => 'Content Test',
             'tag'             => 'Tag Test'
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            ' message'    => 'Artikel Telah di Tambah'
        ]);
    }

    // Fail Store Artikel
     /** @test */
     
     public function fail_store_artikel()
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

         $users = $this->json('POST', 'api/admin/store-artikel',
         [
             'token'           => $token,
             'cover'           => $pdf_test_file,
             'judul'           => 'Test',
             'text'            => '',
             'tag'             => 'Tag Test'
         ]);
 
         $users->assertStatus(400);
    
    }

    // Success Update Artikel
     /** @test */
     
     public function success_update_artikel()
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

         $users = $this->json('POST', 'api/admin/update-artikel/13',
         [
             'token'           => $token,
             'cover'           => $image_test_file,
             'judul'           => 'Judul Test',
             'subjudul'        => 'Sub-Judul Test',
             'text'            => 'Content Test Content Test Content Test Content Test Content Test Content Test Content Test Content Test Content Test
             Content Test Content Test Content Test Content Test Content Test Content Test Content Test Content Test Content Test Content Test
             Content Test Content Test Content Test Content TestContent Test Content Test Content Test',
             'tag'             => 'Tag Test'
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            ' message'    => 'Artikel Telah di Update'
        ]);
    }

    // Success Remove Artikel
     /** @test */
     
     public function success_remove_artikel()
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

         $users = $this->json('POST', 'api/admin/remove-artikel/13',
         [
             'token'           => $token,
         ]);
 
         $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
            'message'    => 'Artikel Berhasil di Hapus'
        ]);
    }

    // Success Store FAQ
     /** @test */
     
     public function success_store_faq()
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

         $users = $this->json('POST', 'api/admin/faq-store',
         [
             'token'           => $token,
             'question'        => 'Question Test',
             'answer'          => 'Answer Test',
             'urut'            => 'Urut Test'
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            ' message'    => 'FAQ Telah di Tambah'
        ]);
    }

    // Success Update FAQ
     /** @test */
     
     public function success_update_faq()
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

         $users = $this->json('POST', 'api/admin/faq-update/2',
         [
             'token'           => $token,
             'question'        => 'Question Test',
             'answer'          => 'Answer Test',
             'urut'            => 'Urut Test'
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            ' message'    => 'FAQ Telah di update'
        ]);
    }
}
