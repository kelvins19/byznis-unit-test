<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;

class SearchCampaignTest extends TestCase
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

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];
    }

    // Search Campaign Test
    /** @test */
    public function search_campaign()
    {
        $user = $this->json('POST', 'api/v1/search-campaign',
        ['keyword' => 'Test'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

    }

    // Search Campaign with Middleware Test
    /** @test */
    public function search_campaign_middleware()
    {
        $user = $this->json('POST', 'api/v1/login',
        ['email'        => 'test_user@gmail.com',
        'password'      => 'TestUser002'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);

        $data = $user->decodeResponseJson();
        //echo $data['token'];
         $token = $data['token'];

         $user = $this->json('POST', 'api/v1/search-campaign-middleware',
        ['token'        => $token,
        'keyword'       => 'Test'
        ]);

        $user->assertStatus(200)->assertJson([
            'status'     => 'berhasil',
        ]);
    }
}
