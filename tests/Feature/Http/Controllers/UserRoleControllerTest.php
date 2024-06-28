<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserRoleControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function an_anonymouse_user_cannot_toggle_users_role(): void
    {
        $user = User::factory()->create();

        $this
            ->followingRedirects()
            ->patch(route('users.role', $user))
            ->assertSeeText('login');

        $this->assertEquals(route('login'), url()->current());
    }

    #[Test]
    public function a_user_cannot_toggle_another_users_role(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $this
            ->actingAs($user)
            ->followingRedirects()
            ->patch(route('users.role', $anotherUser))
            ->assertForbidden();

        $this->assertEquals(route('users.role', $anotherUser), url()->current());
    }

    #[Test]
    public function a_user_cannot_toggle_their_role(): void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->followingRedirects()
            ->patch(route('users.role', $user))
            ->assertForbidden();

        $this->assertEquals(route('users.role', $user), url()->current());
    }

    #[Test]
    public function an_admin_can_toggle_another_users_role(): void
    {
        $admin = User::factory()->create(['admin' => true]);
        $user = User::factory()->create();

        $this
            ->actingAs($admin)
            ->followingRedirects()
            ->patch(route('users.role', $user))
            ->assertSeeText(__('users.admin_granted', ['name' => $user->name]))
            ->assertSeeText($user->name)
            ->assertSeeText($user->uniqueid)
            ->assertSeeText($user->email)
            ->assertOk();

        $this->assertEquals(route('users.show', $user), url()->current());

        $user->refresh();
        $this->assertTrue($user->admin);

        $this
            ->actingAs($admin)
            ->followingRedirects()
            ->patch(route('users.role', $user))
            ->assertSeeText(__('users.admin_revoked', ['name' => $user->name]))
            ->assertSeeText($user->name)
            ->assertSeeText($user->uniqueid)
            ->assertSeeText($user->email)
            ->assertOk();

        $this->assertEquals(route('users.show', $user), url()->current());

        $user->refresh();
        $this->assertFalse($user->admin);
    }

    #[Test]
    public function an_admin_cannot_toggle_their_role(): void
    {
        $admin = User::factory()->create(['admin' => true]);

        $this
            ->actingAs($admin)
            ->followingRedirects()
            ->patch(route('users.role', $admin))
            ->assertSeeText(__('users.cannot_toggle_your_role'))
            ->assertOk();

        $this->assertEquals(route('users.show', $admin), url()->current());
    }
}
