<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create user test.
     *
     * @return void
     */
    public function testCreate()
    {
        $data = [
            'name' => 'User',
            'email' => 'name@domain.ext',
            'password' => 'secret',
            'remember_token' => 'token',
        ];

        factory(User::class)->create($data);

        $this->assertDatabaseHas('users', $data);
    }

    /**
     * View user test.
     *
     * @return void
     */
    public function testView()
    {
        $user = new User([
            'id' => 0,
            'name' => 'User',
            'email' => 'name@domain.ext',
        ]);
    
        $this->be($user);

        $response = $this->get('/user');

        $response->assertStatus(200);
    }
}
