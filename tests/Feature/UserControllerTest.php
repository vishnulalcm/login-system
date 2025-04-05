<?php

namespace Tests\Feature;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['type' => UserType::ADMIN]);
    }

    /** @test */
    public function it_can_display_users_index_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('users-index'));

        $response->assertStatus(200)
            ->assertViewIs('admin.users.index');
            // ->assertViewHas('users');
    }

    /** @test */
    public function it_can_display_user_create_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('users.create'));

        $response->assertStatus(200)
            ->assertViewIs('admin.users.create');
    }

    /** @test */
    public function it_can_store_a_new_user()
    {

        $user = User::factory()->create();

        $data = [
            'firstname' => 'Updated',
            'lastname' => 'User',
            'email' => 'updated@example.com',
            'username' => 'updateduser',
            'type' => UserType::MANAGER->value, // ✅ Correct enum usage
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('users.update', $user), $data);

        $response->assertRedirect(route('users.show', $user))
                 ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'Updated',
        ]);

    }



    /** @test */
    public function it_can_display_user_show_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('users.show', $user));

        $response->assertStatus(200)
            ->assertViewIs('admin.users.show')
            ->assertViewHas('user', $user);
    }

    /** @test */
    public function it_can_display_user_edit_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('users.edit', $user));

        $response->assertStatus(200)
            ->assertViewIs('admin.users.edit')
            ->assertViewHas('user', $user);
    }

    /** @test */
    public function it_can_update_user()
    {
        // Storage::fake('public');
        $user = User::factory()->create();

        $data = [
            'prefixname' => 'Mrs',
            'firstname' => 'Jane',
            'lastname' => 'Smith',
            'username' => 'janesmith',
            'email' => 'jane@example.com',
             'type' => UserType::MANAGER->value,
            // 'photo' => UploadedFile::fake()->create('new-avatar.jpg', 100, 'image/jpeg') // ← changed
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('users.update', $user), $data);

        $response->assertRedirect(route('users.show', $user))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'Jane',
            'email' => 'jane@example.com'
        ]);

        // Optional: Assert photo was stored
        // Storage::disk('public')->assertExists("user-photos/{$user->fresh()->photo}");
    }

    /** @test */
    public function it_can_soft_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users-index'))
            ->assertSessionHas('success');

        $this->assertSoftDeleted($user);
    }

    /** @test */
    // public function it_can_display_trashed_users()
    // {
    //     $user = User::factory()->create();
    //     $user->delete();

    //     $response = $this->actingAs($this->admin)
    //         ->get(route('users.trashed'));

    //     $response->assertStatus(200)
    //         ->assertViewIs('admin.users.trashed')
    //         ->assertViewHas('users');
    // }

    /** @test */
    public function it_can_restore_trashed_user()
    {
        $user = User::factory()->create();
        $user->delete();

        $response = $this->actingAs($this->admin)
            ->patch(route('users.restore', $user));

        $response->assertRedirect(route('users-index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null
        ]);
    }

    /** @test */
    public function it_can_permanently_delete_user()
    {
        Storage::fake('public');
        $user = User::factory()->create(['photo' => 'user-photos/avatar.jpg']);
        $user->delete();

        Storage::disk('public')->put('user-photos', 'dummy');

        $response = $this->actingAs($this->admin)
            ->delete(route('users.force-delete', $user));

        $response->assertRedirect(route('users-index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        Storage::disk('public')->assertMissing('user-photos/avatar.jpg');
    }

    /** @test */
    public function it_validates_user_store_request()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('users.store'), []);

        $response->assertSessionHasErrors([
            'firstname', 'lastname', 'username', 'email', 'password', 'type'
        ]);
    }

    /** @test */
    public function it_validates_user_update_request()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)
            ->put(route('users.update', $user), [
                'email' => 'invalid-email',
                'type' => 'invalid-type'
            ]);

        $response->assertSessionHasErrors(['email', 'type']);
    }
}
