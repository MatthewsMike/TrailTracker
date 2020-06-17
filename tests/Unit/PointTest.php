<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Point;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;

class PointTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    protected $FEATURE_POINTS_COUNT_IN_SEED_DATA;
    protected $MAINTENANCE_POINTS_COUNT_IN_SEED_DATA;
    protected $NON_EXISTANT_IMAGE;
    protected $EXISTING_IMAGE;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->FEATURE_POINTS_COUNT_IN_SEED_DATA = 25;
        $this->MAINTENANCE_POINTS_COUNT_IN_SEED_DATA = 1;
        $this->NON_EXISTANT_IMAGE = 'non-existant-file.jpegx';
        $this->EXISTING_IMAGE = 'Amenity-Bluff Trail Parking-1591236361.jpeg'; // TODO - add a default image resource for testing.
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_GetAllPointsByType_returns_default_type_feature()
    {
        $pointsCollection = (new Point)->GetAllPointsByType();
        $this->assertEquals($this->FEATURE_POINTS_COUNT_IN_SEED_DATA, $pointsCollection->count());
    }

    public function test_GetAllPointsByType_returns_maintenance_type()
    {
        $pointsCollection = (new Point)->GetAllPointsByType('Maintenance');
        $this->assertEquals($this->MAINTENANCE_POINTS_COUNT_IN_SEED_DATA, $pointsCollection->count());
        $this->assertEquals('Maintenance', $pointsCollection[0]->category->type);
    }

    public function test_isValidImagePresent_returns_false_when_no_image_set() {
        $point = factory(Point::class)->make();
        $reflection = new \ReflectionClass(get_class($point));
        $method = $reflection->getMethod('isValidImagePresent');
        $method->setAccessible(true);
        $this->assertFalse($method->invokeArgs($point, []));
    }

    public function test_isValidImagePresent_returns_false_when_image_not_on_system() {
        $point = factory(Point::class)->make();
        $point->image = $this->NON_EXISTANT_IMAGE;
        $reflection = new \ReflectionClass(get_class($point));
        $method = $reflection->getMethod('isValidImagePresent');
        $method->setAccessible(true);
        $this->assertFalse($method->invokeArgs($point, []));
    }

    public function test_isValidImagePresent_returns_true_when_image_exists() {
        $point = factory(Point::class)->make();
        $point->image = $this->EXISTING_IMAGE;
        $reflection = new \ReflectionClass(get_class($point));
        $method = $reflection->getMethod('isValidImagePresent');
        $method->setAccessible(true);
        $this->assertTrue($method->invokeArgs($point, []));
    }

    public function test_isMapCardImageCreated_returns_false_when_image_not_on_system() {
        $point = factory(Point::class)->make();
        $point->image = $this->NON_EXISTANT_IMAGE;
        $reflection = new \ReflectionClass(get_class($point));
        $method = $reflection->getMethod('isMapCardImageCreated');
        $method->setAccessible(true);
        $this->assertFalse($method->invokeArgs($point, []));
    }

    public function test_isMapCardImageCreated_returns_true_when_map_card_image_exists() {
        $point = factory(Point::class)->make();
        $point->image = $this->EXISTING_IMAGE;
        $point->resizeImageForMapCard();
        $reflection = new \ReflectionClass(get_class($point));
        $method = $reflection->getMethod('isMapCardImageCreated');
        $method->setAccessible(true);
        $this->assertTrue($method->invokeArgs($point, []));
    }
    
    public function test_resizeImageForMapCard_does_nothing_when_file_does_not_exist() {
        $point = factory(Point::class)->make();
        $point->image = $this->NON_EXISTANT_IMAGE;
        $reflection = new \ReflectionClass(get_class($point));
        $method = $reflection->getMethod('isMapCardImageCreated');
        $method->setAccessible(true);
        $this->assertFalse($method->invokeArgs($point, []));
        $point->resizeImageForMapCard();
        $this->assertFalse($method->invokeArgs($point, []));
    }

    public function test_resizeImageForMapCard_does_creates_map_card_image_for_valid_file() {
        $point = factory(Point::class)->make();
        $point->image = $this->EXISTING_IMAGE;
        $this->destroyMapCardImage($point->image);
        $reflection = new \ReflectionClass(get_class($point));
        $method = $reflection->getMethod('isMapCardImageCreated');
        $method->setAccessible(true);
        $this->assertFalse($method->invokeArgs($point, []));
        $point->resizeImageForMapCard();
        $this->assertTrue($method->invokeArgs($point, []));
    }


    private function destroyMapCardImage($image) {
        if(is_file(public_path(env('PATH_TO_IMAGES_MAP_CARD') . $image))) {
            unlink(public_path(env('PATH_TO_IMAGES_MAP_CARD') . $image));
        }
    }

    public function test_hasMaintenanceRating_returns_false_when_rating_null() {
        $point = factory(Point::class)->make();
        $this->assertFalse($point->hasMaintenanceRating());
    }

    public function test_hasMaintenanceRating_returns_true_when_rating_exists() {
        $point = factory(Point::class)->make();
        $point->maintenance_rating = '1';
        $this->assertTrue($point->hasMaintenanceRating());
    }
}
