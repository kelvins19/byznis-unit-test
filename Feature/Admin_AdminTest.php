<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin_AdminTest extends TestCase
{
    // Success Login Admin
    /** @test */

    public function success_login_admin()
    {
       $credentials = ['email'=>'admin_test@byznis.id','password'=>'AdminTest001!'];
       $users = $this->json('POST', 'api/admin/loginadmin' ,$credentials);

       $users->assertStatus(200)->assertJson([
           'status'     => 'berhasil',
       ]);
   }

    // Success Store Admin
     /** @test */
     
     public function success_store_admin()
     {
        $credentials = ['email'=>'admin_test@byznis.id','password'=>'AdminTest001!'];
        $users = $this->json('POST', 'api/v1/login' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/store-admin/',
         [
             'token'           => $token,
             'name'            => 'Test Admin',
             'email'           => 'admin_test04@byznis.id',
             'jabatan'         => 'Administrator',
             'role_admin'      => 'admin',
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            ' message'    => 'Admin berhasil ditambahkan'
        ]);
    }

    // Fail Store Admin
     /** @test */
     
     public function fail_store_admin()
     {
        $credentials = ['email'=>'admin_test@byznis.id','password'=>'AdminTest001!'];
        $users = $this->json('POST', 'api/v1/login' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/store-admin/',
         [
             'token'           => $token,
             'name'            => 'Test Admin',
             'email'           => 'admin_test02@byznis.id',
             'jabatan'         => 'Administrator',
             'role_admin'      => 'admin',
         ]);
 
         $users->assertStatus(400)->assertJson([
            'status'     => 'gagal',
        ]);
    }

    
    // Success Update Admin
     /** @test */
     /*
     public function success_update_admin()
     {
        $credentials = ['email'=>'admin_test@byznis.id','password'=>'AdminTest001!'];
        $users = $this->json('POST', 'api/admin/loginadmin' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
        echo $data['user'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/update-admin/2',
         [
             'token'           => $token,
             'name'            => 'Test Admin',
             'email'           => 'admin_test@byznis.id',
             'jabatan'         => 'Administrator',
             'role_admin'      => 'super_admin',

         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            'message'    => 'Role Admin Telah di Ubah'
        ]);
    }
    */

    // Success Remove Admin
     /** @test */
     /*
     public function success_remove_admin()
     {
        $credentials = ['email'=>'admin_test@byznis.id','password'=>'AdminTest001!'];
        $users = $this->json('POST', 'api/admin/loginadmin' ,$credentials);

        $users->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $users->decodeResponseJson();
        //echo $data['token'];
        echo $data['user'];
         $token = $data['token'];
        
         $pdf_test_file = 'test_file.pdf';
         $image_test_file = 'test_file.jpeg';

         $users = $this->json('POST', 'api/admin/remove-admin/250',
         [
             'token'           => $token,
         ]);
 
         $users->assertStatus(201)->assertJson([
            'status'     => 'sukses',
            'message'    => 'Role Admin Telah di Hapus'
        ]);
    }
    */
}
