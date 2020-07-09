<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MapTest extends DuskTestCase
{
    use withFaker;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function test_custom_controls_have_loaded()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(env('APP_URL').'/')
                    ->assertSee('Add Marker')
                    ->assertSee('Options');                
        });
    }

    public function test_add_marker_modal_opens()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(env('APP_URL').'/')
                    ->click('#addMarker')
                    ->click('#map_canvas')
                    ->assertSee('Description');                
        });
    }

    public function test_add_feature_marker_modal_saves_to_db()
    {
        $title = $this->faker->sentence(8);
        $description = $this->faker->sentence(8);
        $this->browse(function (Browser $browser) use ($title, $description) {
            $browser->visit(env('APP_URL').'/')
                    ->click('#addMarker')
                    ->click('#map_canvas')
                    ->type('#modal-input-edit-marker-title', $title)
                    ->type('#modal-input-edit-marker-description', $description)
                    ->select('#modal-input-edit-marker-type', 'Feature')
                    ->waitUntil('!$.active')
                    ->select('#modal-input-edit-marker-categories', '12')
                    ->assertDontSee('#modal-input-edit-marker-rating')
                    ->click('#btn-save-edit-marker')
                    ->waitUntil('!$.active');                
        });

        $this->assertDatabaseHas('points', [
            'title' => $title,
            'description' => $description,
            'icon' => null,
            'ApprovedBy' => null,
            'categories_id' => '12',
            'maintenance_rating' =>null
            ]);
    }

    public function test_add_maintenance_marker_modal_saves_to_db()
    {
        $title = $this->faker->sentence(8);
        $description = $this->faker->sentence(8);
        $this->browse(function (Browser $browser) use ($title, $description) {
            $browser->visit(env('APP_URL').'/')
                    ->click('#addMarker')
                    ->click('#map_canvas')
                    ->type('modal-input-edit-marker-title', $title)
                    ->type('modal-input-edit-marker-description', $description)
                    ->select('modal-input-edit-marker-type', 'Maintenance')
                    ->waitUntil('!$.active')
                    ->select('modal-input-edit-marker-categories', '14')
                    ->select('modal-input-edit-marker-rating', '2')
                    ->click('#btn-save-edit-marker')
                    ->waitUntil('!$.active');                 
        });

        $this->assertDatabaseHas('points', [
            'title' => $title,
            'description' => $description,
            'icon' => null,
            'ApprovedBy' => null,
            'categories_id' => '14',
            'maintenance_rating' => '2'
            ]);
    }
}
