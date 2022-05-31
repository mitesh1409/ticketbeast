<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewConcertListingTest extends TestCase
{
    /**
     * User can view a concert.
     *
     * @return void
     */
    public function test_user_can_view_a_concert()
    {
        // Arrange
        // Create a concert with some dummy/fake data.
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'With Animosity and Lethargy',
            'datetime' => Carbon::parse('December 25, 2021 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555.',
        ]);

        // Act
        // Visit concert listing page.
        $response = $this->get(route('concerts.show', $concert->id));

        // Assert
        // Verify the concert data.
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('The Red Chord');
        $response->assertSee('With Animosity and Lethargy');
        $response->assertSee('December 25, 2021');
        $response->assertSee('8:00pm');
        $response->assertSee('32.50');
        $response->assertSee('The Mosh Pit');
        $response->assertSee('123 Example Lane');
        $response->assertSee('Laraville, ON 17916');
        $response->assertSee('For tickets, call (555) 555-5555.');
    }
}
