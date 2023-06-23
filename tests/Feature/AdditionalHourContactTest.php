<?php

namespace Tests\Feature;

use App\Models\AdditionalHourContact;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdditionalHourContactTest extends TestCase
{

    use RefreshDatabase;


    /**
     * Test the session value to show user doesnt have a predefined contact to send summary mail
     *
     * @group contact
     * @return void
     */
    public function test_session_has_key_to_show_none_contact()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200)->assertSessionHas('alert', ['type' => 'warning', 'message' => "You doesn't have an contact to send the summary mail, Go to your profile to create one."]);
    }

    /**
     * Test the session doesnt have key to show message to configure default contact
     * if the user has a contact by default
     *
     * @group contact
     * @return void
     */
    public function test_session_doesnt_have_key_to_show_none_contact() {

        $user = User::factory()->create();

        AdditionalHourContact::factory()
            ->for($user)
            ->create();

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200)->assertSessionMissing('alert');


    }

    /**
     * Add or edit contact
     *
     * @group contact
     * @return void
     */
    public function test_add_or_create_contact() {

        $user = User::factory()->create();

        $payload = [
            'firstname' => 'firstname_contact',
            'lastname' => 'lastname_contact',
            'send_at' => 4,
            'email' => 'patronmail@example.com'
        ];

        $response_create = $this->actingAs($user)->post(route('profile.contact.store'), $payload);

        $response_create->assertStatus(302);

        $this->assertDatabaseHas('additional_hour_contacts', array_merge([
            'default' => 1,
            'user_id' => $user->id
        ], $payload));


        $payload_edit = [
            'firstname' => 'firstname_new_contact',
            'lastname' => 'lastname_new_contact',
            'send_at' => 28,
            'email' => 'patronmail2@example.com'
        ];

        $response_edit = $this->actingAs($user)->post(route('profile.contact.store'), $payload_edit);

        $response_edit->assertStatus(302);

        $this->assertDatabaseHas('additional_hour_contacts', array_merge([
            'default' => 1,
            'user_id' => $user->id
        ], $payload_edit))->assertSoftDeleted('additional_hour_contacts', array_merge([
            'default' => 0,
            'user_id' => $user->id
        ], $payload));


    }


}
