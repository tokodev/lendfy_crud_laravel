<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->make(UserRepository::class);
    }

    /** @test */
    public function it_can_display_users_index_page()
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_display_create_user_form()
    {
        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_store_a_new_user()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'cpf' => $this->faker->unique()->numerify('###########'),
            'birth_date' => $this->faker->date,
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->buildingNumber,
            'cep' => $this->faker->postcode,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ];

        $response = $this->post(route('users.store'), $userData);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
    }

    /** @test */
public function it_can_display_edit_user_form()
{
    // Create a user using the provided data

    $user = User::factory()->create([
        'birth_date' => $this->faker->date,
        'street' => $this->faker->streetName,
        'street_number' => $this->faker->buildingNumber,
        'cep' => $this->faker->postcode,
        'city' => $this->faker->city,
        'uf' => $this->faker->stateAbbr,
    ]);

    // Generate the URL for the edit user form, providing the user ID as a parameter
    $response = $this->get(route('users.edit', ['user' => $user->id]));

    // Assert the response status
    $response->assertStatus(200);
}


    /** @test */
    public function it_can_display_show_user_page()
    {
         $user = User::factory()->create([
            'birth_date' => $this->faker->date,
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->buildingNumber,
            'cep' => $this->faker->postcode,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ]);

        $response = $this->get(route('users.show', $user));

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_update_user()
    {
        $user = User::factory()->create([
            'birth_date' => $this->faker->date,
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->buildingNumber,
            'cep' => $this->faker->postcode,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ]);

        $newUserData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'cpf' => $this->faker->unique()->numerify('###########'),
            'birth_date' => $this->faker->date,
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->buildingNumber,
            'cep' => $this->faker->postcode,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ];

        $response = $this->put(route('users.update', $user), $newUserData);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['email' => $newUserData['email']]);
    }

    /** @test */
    public function it_can_delete_user()
    {
        $user = User::factory()->create([
            'birth_date' => $this->faker->date,
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->buildingNumber,
            'cep' => $this->faker->postcode,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ]);

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
