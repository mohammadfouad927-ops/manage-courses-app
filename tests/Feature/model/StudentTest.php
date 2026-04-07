<?php

namespace Tests\Feature\model;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_photoPath_accessor_return_default_image_if_original_is_null(): void
    {
        $this->withoutExceptionHandling();
        $student = new Student(['photoPath'=>null]);

        $result = $student->photoPath;

        $this->assertEquals('avatars/default_photo.jpg', $result);
    }

    public function test_photoPath_accessor_return_original_image_if_original_is_not_null(): void
    {
        $this->withoutExceptionHandling();
        $student = new Student(['photoPath'=>'avatars/myphoto.jpg']);

        $result = $student->photoPath;

        $this->assertEquals('avatars/myphoto.jpg', $result);
    }
}
