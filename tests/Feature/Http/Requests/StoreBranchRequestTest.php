<?php

namespace Tests\Feature\Http\Requests;

use App\Http\Requests\StoreBranchRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreBranchRequestTest extends TestCase
{
    use RefreshDatabase;
    public function test_branch_request_should_be_failed(){
        $request = new StoreBranchRequest();
        $data = [
            'name' => 'Branch Name',
            'address' => 'Branch Address',
            'phoneNumber' => '01012345678',
            'email' => 'branch2@gmail.com',
            'googleMapLink' => 'https://www.facebook.com/invalid-link',
            'isActive' => true,
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('googleMapLink', $validator->errors()->messages());
    }

    public function test_branch_request_should_be_passed(){
        $request = new StoreBranchRequest();
        $data = [
            'name' => 'Branch Name',
            'address' => 'Branch Address',
            'phoneNumber' => '01012345678',
            'email' => 'branch2@gmail.com',
            'googleMapLink' => 'https://maps.app.goo.gl/cP9KhXfLdyogEdVz9',
            'isActive' => true,
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());

    }
}
