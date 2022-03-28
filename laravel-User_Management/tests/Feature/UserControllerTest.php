<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
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

    public function testLogin()
    {
        //$this->withoutMiddleware();
        $data = [
            'email' => 'oliver.kopyov@smartadminwebapp.com',
            'password' => '123'
        ];

        $response = $this->post('/login', $data);

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Вы успешно авторизованы')
            ->assertRedirect('/');
    }

    public function testLogout() {

        $this->be(User::find(3));

        $response = $this->get('/logout');

        $response->assertStatus(302)
            ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function testCreate()
    {
        $this->isAuth();
        //$this->withoutMiddleware();
        $data = [
            'email' => 'test1@gmail.com',
            'password' => '123'
        ];

        $response = $this->post('/admin/create', $data);
        $response->assertSessionHasNoErrors();

    }

    public function testEdit() {
        $this->isAuth();
        $id = rand(10, 18);
        $response = $this->post("/admin/edit/$id", ['name' => 'Вася']);
        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Редактирование прошло успешно.')
            ->assertRedirect('/');

    }
}
