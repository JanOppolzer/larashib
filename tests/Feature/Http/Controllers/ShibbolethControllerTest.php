<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShibbolethControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function if_no_shibboleth_just_show_a_message(): void
    {
        $this
            ->get(route('login'))
            ->assertOk()
            ->assertSeeText('login');
    }

    #[Test]
    public function shibboleth_login_redirects_correctly(): void
    {
        $this
            ->withServerVariables(['Shib-Handler' => 'http://localhost'])
            ->get('login');

        $this->assertEquals('http://localhost/login', url()->current());
    }

    #[Test]
    public function a_newly_created_user_with_inactive_account_cannot_login(): void
    {
        $user = User::factory()->create(['active' => false]);

        $this
            ->followingRedirects()
            ->withServerVariables([
                'uniqueId' => $user->uniqueid,
                'cn' => $user->name,
                'mail' => $user->email,
            ])
            ->get('auth')
            ->assertViewIs('account_created')
            ->assertSeeInOrder([
                __('welcome.account_created_header'),
                __('welcome.account_created_info'),
            ]);

        $this->assertFalse(Auth::check());
        $this->assertTrue(Auth::guest());

        $this->assertEquals('http://localhost/auth', url()->current());
    }

    #[Test]
    public function an_existing_user_with_inactive_account_cannot_login(): void
    {
        $user = User::factory()->create(['active' => false, 'created_at' => Carbon::yesterday()]);
        $user->refresh();

        $this
            ->followingRedirects()
            ->withServerVariables([
                'uniqueId' => $user->uniqueid,
                'cn' => $user->name,
                'mail' => $user->email,
            ])
            ->get('auth')
            ->assertSeeInOrder([
                __('welcome.account_inactive'),
                __('welcome.account_inactive_info'),
            ]);

        $this->assertEquals('http://localhost/auth', url()->current());
        $this->assertFalse(Auth::check());
    }

    #[Test]
    public function an_existing_user_with_active_account_can_login(): void
    {
        $user = User::factory()->create(['active' => true]);
        $user->refresh();

        $this
            ->followingRedirects()
            ->withServerVariables([
                'uniqueId' => $user->uniqueid,
                'cn' => $user->name,
                'mail' => $user->email,
            ])
            ->get('auth');

        $this->assertEquals(route('home'), url()->current());
        $this->assertTrue(Auth::check());
    }

    #[Test]
    public function a_user_can_log_out(): void
    {
        $user = User::factory()->create(['active' => true]);
        $user->refresh();

        Auth::login($user);
        Session::regenerate();

        $this->assertTrue(Auth::check());
        $this->assertFalse(Auth::guest());

        $this
            ->actingAs($user)
            ->get(route('logout'))
            ->assertRedirect('http://localhost/Shibboleth.sso/Logout');
    }
}
