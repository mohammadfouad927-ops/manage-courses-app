<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BranchControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_unvalid_branch_should_not_be_created(): void
    {
        $response = $this->post(route('branches.store'), [
            'name' => 'Branch Name',
            'address' => 'Branch Address',
            'phoneNumber' => '01012345890',
            'email' => 'route@gmail.com',
            'googleMapLink' => 'https://www.facebook.com/invalid-link',
            'isActive' => true,
        ]);

        $response->assertSessionHasErrors(['googleMapLink']);

    }

    public function test_valid_branch_should_be_created(): void
    {
        $response = $this->post(route('branches.store'), [
            'name' => 'Branch Name',
            'address' => 'Branch Address',
            'phoneNumber' => '01012345890',
            'email' => 'route@gmail.com',
            'googleMapLink' => 'https://maps.app.goo.gl/cP9KhXfLdyogEdVz9',
            'isActive' => true,
        ]);

        $response->assertRedirect(route('branches.index'));
        $response->assertSessionHas('success', 'Branch created successfully.');
        $this->assertDatabaseHas('branches', [
            'name' => 'Branch Name',
            'address' => 'Branch Address',
            'phoneNumber' => '01012345890',
            'email' => 'route@gmail.com',
            'googleMapLink' => 'https://maps.app.goo.gl/cP9KhXfLdyogEdVz9',
            'isActive' => true,
        ]);
    }
}
