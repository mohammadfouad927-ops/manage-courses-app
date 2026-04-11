<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ProgramSession;
use App\Models\TrainingProgram;

class ProgramSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_program_session_with_valid_request()
    {
        // create fake training program
        $trainingProgram = TrainingProgram::create([
            'name' => fake()->sentence(3)
        ]);

        // send POST request to store program session
        $response = $this->post(route('program-sessions.store'), [
            'training_program_id' => $trainingProgram->id,
            'price' => 599.99,
            'start_date' => now()->addDays(1)->toDateString(),
            'end_date' => now()->addDays(120)->toDateString(),
            'is_active' => true,
        ]);

        // assert that the response is a redirect to the index page
        $response->assertRedirect(route('program-sessions.index'));

        // assert that the program session was created in the database
        $this->assertDatabaseHas('program_sessions', [
            'training_program_id' => $trainingProgram->id,
            'price' => 599.99,
            'start_date' => now()->addDays(1)->toDateString(),
            'end_date' => now()->addDays(120)->toDateString(),
            'is_active' => true,
        ]);

    }
    public function test_store_program_session_with_invalid_request()
    {

        // send POST request to store program session
        $response = $this->post(route('program-sessions.store'), [
            'training_program_id' => 200,
            'price' => -599.99,
            'start_date' => now()->addDays(1)->toDateString(),
            'end_date' => now()->addDays(1)->toDateString(),
            'is_active' => true,
        ]);

        // assert that the response is a redirect to the index page
        $response->assertInvalid();
    }
}
