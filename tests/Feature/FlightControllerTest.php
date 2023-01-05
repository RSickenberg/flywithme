<?php

namespace Tests\Feature;

use App\Enum\FlightStatus;
use App\Models\Flight;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\PermissionRegistrar;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @group fly-with-me
 *
 * @coversDefaultClass \App\Http\Controllers\FlightsController
 */
final class FlightControllerTest extends TestCase
{
    use RefreshDatabase;

    private const BASE_URL = '/flight';

    protected function shouldSeed(): bool
    {
        return false;
    }

    private \App\Models\User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
        $this->admin = User::factory()->asAdmin()->create();
    }

    /**
     * @covers ::index
     */
    public function test_page_access_only_logged(): void
    {
        $response = $this->get(self::BASE_URL);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/login');
    }

    /**
     * @covers ::index
     */
    public function test_page_allow_only_admin(): void
    {
        $randomUser = User::factory()->create();
        $this->actingAs($randomUser);

        $response = $this->get(self::BASE_URL);
        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->actingAs($this->admin);
        $response = $this->get(self::BASE_URL);
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @covers ::index
     */
    public function test_page_show_one_flight(): void
    {
        $flight = Flight::factory()
            ->inFuture()
            ->withStatus(FlightStatus::ACTIVE)
            ->create();
        $this->actingAs($this->admin);

        $response = $this->get(self::BASE_URL);

        $response->assertSee($flight->registration);
        $response->assertSee($flight->model);
        $response->assertSee($flight->departure);
        $response->assertSee($flight->arrival);
        $response->assertSee(ucfirst($flight->status->value));
        $response->assertSee($flight->out);
    }

    /**
     * @covers ::index
     */
    public function test_page_show_one_old_flight(): void
    {
        $flight = Flight::factory()
            ->inPast()
            ->withStatus(FlightStatus::ARCHIVED)
            ->create();
        $this->actingAs($this->admin);

        $response = $this->get(self::BASE_URL.'?old=1');

        $response->assertSee($flight->registration);
        $response->assertSee($flight->model);
        $response->assertSee($flight->departure);
        $response->assertSee($flight->arrival);
        $response->assertSee(ucfirst($flight->status->value));
        $response->assertSee($flight->out);

        $response = $this->get(self::BASE_URL.'?old=0');
        $response->assertDontSee($flight->registration);
        $response->assertDontSee($flight->model);
        $response->assertDontSee($flight->departure);
        $response->assertDontSee($flight->arrival);
        $response->assertDontSee(ucfirst($flight->status->value));
        $response->assertDontSee($flight->out);
    }
}
