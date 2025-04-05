<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserMigrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_table_has_expected_columns()
    {
        $expectedColumns = [
            'id',
            'prefixname',
            'firstname',
            'middlename',
            'lastname',
            'suffixname',
            'username',
            'email',
            'email_verified_at',
            'password',
            'photo',
            'type',
            'remember_token',
            'deleted_at',
            'created_at',
            'updated_at'
        ];

        $this->assertTrue(Schema::hasColumns('users', $expectedColumns));
    }

    /** @test */
    /** @test */
public function users_table_has_correct_column_types()
{
    $expectedTypes = [
        'id' => 'bigint',
        'prefixname' => 'varchar',
        'firstname' => 'varchar',
        'middlename' => 'varchar',
        'lastname' => 'varchar',
        'suffixname' => 'varchar',
        'username' => 'varchar',
        'email' => 'varchar',
        'password' => 'text',
        'photo' => 'text',
        'type' => 'varchar',
        'remember_token' => 'varchar',
        'email_verified_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    foreach ($expectedTypes as $column => $expectedType) {
        $actualType = Schema::getColumnType('users', $column);
        $this->assertEquals(
            $expectedType,
            $actualType,
            "Expected column '{$column}' to be of type '{$expectedType}', but got '{$actualType}'."
        );
    }
}


    /** @test */


    /** @test */
    public function it_can_create_and_retrieve_user()
    {
        $userData = [
            'prefixname' => 'Mr',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'type' => 'user'
        ];

        $user = User::create($userData);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'username' => 'johndoe'
        ]);

        $retrievedUser = User::first();
        $this->assertEquals('John', $retrievedUser->firstname);
        $this->assertEquals('Doe', $retrievedUser->lastname);
    }

    /** @test */
    public function it_can_soft_delete_user()
    {
        $user = User::factory()->create();
        $user->delete();

        $this->assertSoftDeleted($user);
        $this->assertNull(User::find($user->id));
        $this->assertNotNull(User::withTrashed()->find($user->id));
    }
}
