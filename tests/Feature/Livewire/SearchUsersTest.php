<?php

namespace Tests\Feature\Livewire;

use App\Livewire\SearchUsers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchUsersTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function the_component_can_render(): void
    {
        User::factory()->create();

        $component = Livewire::test(SearchUsers::class);

        $component->assertStatus(200);
    }

    #[Test]
    public function the_component_allows_searching_users_by_name(): void
    {
        $admin = User::factory()->create(['admin' => true]);
        User::factory()->times(10)->create();
        $user = User::latest()->first();

        Livewire::test(SearchUsers::class)
            ->set('search', $user->name)
            ->assertSee('search', $user->name)
            ->assertSee($user->name)
            ->assertSee($user->uniqueid)
            ->assertSee($user->email);
    }

    #[Test]
    public function the_component_allows_searching_users_by_uniqueid(): void
    {
        $admin = User::factory()->create(['admin' => true]);
        User::factory()->times(10)->create();
        $user = User::latest()->first();

        Livewire::test(SearchUsers::class)
            ->set('search', $user->uniqueid)
            ->assertSee('search', $user->uniqueid)
            ->assertSee($user->name)
            ->assertSee($user->uniqueid)
            ->assertSee($user->email);
    }

    #[Test]
    public function the_component_allows_searching_users_by_email(): void
    {
        $admin = User::factory()->create(['admin' => true]);
        User::factory()->times(10)->create();
        $user = User::latest()->first();

        Livewire::test(SearchUsers::class)
            ->set('search', $user->email)
            ->assertSee('search', $user->email)
            ->assertSee($user->name)
            ->assertSee($user->uniqueid)
            ->assertSee($user->email);
    }
}
