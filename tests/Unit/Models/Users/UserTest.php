<?php

namespace Tests\Unit\Models\Users;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test */
    public function it_hashes_passwords_when_creating()
    {
        $user = factory(User::class)->create([
            'password' => 'secret',
        ]);

        $this->assertNotEquals('secret', $user->password);
    }
}
