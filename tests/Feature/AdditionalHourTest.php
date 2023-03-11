<?php

namespace Tests\Feature;

use App\Models\AdditionalHour;
use App\Models\AdditionalHourStatus;
use App\Models\User;
use Database\Seeders\AdditionalHourStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdditionalHourTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test add new hour to user
     *
     * @group hours
     * @return void
     */
    public function test_add_hours()
    {
        $this->seed(AdditionalHourStatusSeeder::class);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('hours.store'), [
            'reason' => 'I want to be payed',
            'date' => '2023-03-11',
            'hours' => 2,
            'status' => AdditionalHourStatus::whereCode('requested')->first()->id
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertSessionHas('alert', ['type' => 'success', 'message' => 'New Hour added'])
            ->assertRedirect(route('hours.index'));
    }

    /**
     * Test add new hour screen can be display
     *
     * @group hours
     * @return void
     */
    public function test_add_hours_screen_can_be_rendered() {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('hours.create'));

        $response->assertOk();

    }

    /**
     * Test index screen can be display
     *
     * @group hours
     * @return void
     */
    public function test_index_screen_can_be_rendered() {

        $this->seed(AdditionalHourStatusSeeder::class);

        $status = AdditionalHourStatus::whereCode('requested')->first();

        $user = User::factory()->create();
        
        AdditionalHour::factory()
            ->count(10)
            ->for($user)
            ->for($status, 'status')
            ->create();

        $response = $this->actingAs($user)->get(route('hours.index'));

        $response->assertOk();

    }


    public function test_update_hour_screen_can_be_rendered() {}

    public function test_update_hour() {}

    public function test_delete_hour() {}

    public function test_bulk_update() {}


}
