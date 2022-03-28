<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    private function isAuth() {
        $credentials = ['email' => 'oliver.kopyov@smartadminwebapp.com', 'password' => '123'];
        Auth::attempt($credentials, false);
    }

    public function testIndex() {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function testLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testRegister() {
        $response = $this->get("/register");
        $response->assertStatus(200);
    }

    public function testProfile() {
        $this->isAuth();
        $id = rand(10, 18);
        $response = $this->get("/profile/$id");
        $response->assertStatus(200);
    }

    public function testCreate() {
        $this->isAuth();
        $response = $this->get('admin/create');
        $response->assertStatus(200);
    }

    public function testEdit() {
        $id = rand(10, 18);
        $this->isAuth();
        $response = $this->get("admin/edit/$id");
        $response->assertStatus(200);
    }

    public function testMedia() {
        $id = rand(10, 18);
        $this->isAuth();
        $response = $this->get("admin/media/$id");
        $response->assertStatus(200);
    }
    public function testSecurity() {
        $id = rand(10, 18);
        $this->isAuth();
        $response = $this->get("admin/security/$id");
        $response->assertStatus(200);
    }
    public function testStatus() {
        $id = rand(10, 18);
        $this->isAuth();
        $response = $this->get("admin/status/$id");
        $response->assertStatus(200);
    }
}
