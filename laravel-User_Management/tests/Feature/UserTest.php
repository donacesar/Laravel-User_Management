<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function testUserCreate()
    {
        $data = [
            'email' => uniqid(str_random(3)) . '@gmail.com',
            'password' => '123123123',
        ];

        User::create($data);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);

    }
    public function testUserSelect() {

        $response = User::get()->all();
        $this->assertIsArray($response);
    }

    public function testUserSelectById() {
        $response = User::find(5)->all()->all();

        $this->assertIsArray($response);
    }

    public function testUserDeleteById() {
        $id = rand(20, 30);
        $user = User::find($id);
        $response = $user->delete($id);

        $this->assertIsBool($response);
    }

}
