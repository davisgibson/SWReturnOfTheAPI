<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Favorite;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    public function test_a_basic_request()
    {
        $response = $this->get('/');
 
        $response->assertStatus(200);
    }

    public function test_call_to_swapi()
    {
        $response = $this->get('/');
 
        $response->assertSeeText('Loading...');
    }

    public function test_favoriting_item()
    {
        $url = "https://swapi.dev/api/people/1/";

        $response = $this->post('/favorite', ['url' => $url]);

        $response->assertStatus(200);
    }
}
