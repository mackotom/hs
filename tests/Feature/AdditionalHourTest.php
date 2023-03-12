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

    /**
     * Test update hour screen can be display
     *
     * @group hours
     * @return void
     */
    public function test_update_hour_screen_can_be_rendered() {

        $this->seed(AdditionalHourStatusSeeder::class);

        $status = AdditionalHourStatus::whereCode('requested')->first();

        $user = User::factory()->create();
        
        $hour = AdditionalHour::factory()
            ->for($user)
            ->for($status, 'status')
            ->create();

        $response = $this->actingAs($user)->get(route('hours.index', $hour->id));

        $response->assertOk();

    }

    /**
     * Test update hour
     *
     * @group hours
     * @return void
     */
    public function test_update_hour() {

        $this->seed(AdditionalHourStatusSeeder::class);

        $status = AdditionalHourStatus::whereCode('requested')->first();

        $user = User::factory()->create();
        
        $hour = AdditionalHour::factory()
            ->for($user)
            ->for($status, 'status')
            ->create();

        $new_status = AdditionalHourStatus::whereCode('paid')->first()->id;

        $response = $this->actingAs($user)->put(route('hours.update', $hour->id), [
            'reason' => 'new reason',
            'hours' => 4,
            'date' => '2023-03-12',
            'status' => $new_status
        ]);


        $response->assertSessionHasNoErrors()
            ->assertSessionHas('alert', ['type' => 'success', 'message' => "Hour #{$hour->id} has been updated"])
            ->assertRedirect(route('hours.index'));

        $hour->refresh();

        $this->assertTrue($hour->only('reason', 'hours', 'date', 'status_id') == [
            'reason' => 'new reason',
            'hours' => 4,
            'date' => '2023-03-12',
            'status_id' => $new_status
        ]);

    }

    /**
     * Test update bulk
     *
     * @group hours
     * @return void
     */
    public function test_bulk_update() {

        $this->seed(AdditionalHourStatusSeeder::class);

        $status = AdditionalHourStatus::whereCode('requested')->first();

        $user = User::factory()->create();
        
        $hours = AdditionalHour::factory()
            ->count(5)
            ->for($user)
            ->for($status, 'status')
            ->create();

        $new_status = AdditionalHourStatus::whereCode('paid')->first();

        $new_date = '2023-03-12';

        $response = $this->actingAs($user)->post(route('hours.update.bulk'), [
            'status' => $new_status->id,
            'date' => $new_date,
            'hours' => $hours->map(function($hour) { return $hour->id; })->toArray()
        ]);

        $response->assertSessionHasNoErrors()
                ->assertSessionHas('alert', ['type' => 'success', 'message' => "Hours Updated"])
                ->assertRedirect(route('hours.index'));

        $hours->each(function($hour) use($new_status, $new_date) {
            $hour->refresh();
            $this->assertTrue($hour->only('status_id', 'date') == [
                'date' => $new_date,
                'status_id' => $new_status->id 
            ]);
        });

    }

    public function test_delete_hour() {}


}
