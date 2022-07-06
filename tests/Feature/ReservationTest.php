<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use stdClass;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creation_reservation()
    {
        $request = new stdClass;
        $request->firstname = 'Doe';
        $request->lastname = 'John';
        $request->email = 'john@test.com';
        $request->phone = '0340000000';
        $request->hour = '10:00 pm';
        $request->date = '12/12/2022';
        $request->person = 3;

        $service = new ReservationService();

        $result = $service->reservation($request);

        $this->assertEquals(1, Reservation::count());
        $this->assertEquals('Doe', $result['firstname']);
        $this->assertEquals('John', $result['lastname']);
        $this->assertEquals('john@test.com', $result['email']);
        $this->assertEquals('0340000000', $result['phone']);
        $this->assertEquals('10:00 pm', $result['hour']);
        $this->assertEquals('12/12/2022', $result['date']);
        $this->assertEquals('3', $result['person']);
    }
}
