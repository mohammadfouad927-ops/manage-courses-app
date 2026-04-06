<?php

namespace Tests\Feature\Http\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Student;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Governorate;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
   
    
    public function test_student_create_page_return_200(): void
    {
        $response = $this->get('/students/create');

        $response->assertStatus(200);
    }

    public function test_add_new_student_successfully(): void
    {
        $this->withoutExceptionHandling(); 

        // Fake the storage disk
        Storage::fake('avatars');

        // Create a fake image
        $file = UploadedFile::fake()->create('avatar.jpg',100);



        $response = $this->post('/students',[
            'nameEn' => 'wiener peter' ,
            'nameAr' =>  fake('ar_SA')->name(),
            'email' =>  fake()->Email(),
            'birthDate' => fake()->date('d-m-Y'),
            'governorate' => fake()->randomElement(['cairo','giza','alexandria']),
            'NationalId' => fake()->numerify('##############'),
            // 'photo' => $file,
            'phoneNumber' => fake()->regexify('01(0|1|2|5)[0-9]{8}'),
            'studentStatus' => fake()->randomElement([0,1]),
            'school' => fake()->company(). 'School',
        ]);

        // $response->assertValid();

        $response->assertStatus(302);
    }

    public function test_change_student_information_successfully():void{
        $this->withoutExceptionHandling();
    // create new student 
        $student = Student::create([
            'nameEn' => 'Michel fred' ,
            'nameAr' =>  fake('ar_SA')->name(),
            'email' =>  fake()->Email(),
            'birthDate' => fake()->date('d-m-Y'),
            'governorate' => fake()->randomElement([Governorate::Gharbia,Governorate::Giza,Governorate::Cairo]),
            'NationalId' => fake()->numerify('##############'),
            // 'photo' => $file,
            'phoneNumber' => fake()->regexify('01(0|1|2|5)[0-9]{8}'),
            'studentStatus' => fake()->randomElement([0,1]),
            'school' => fake()->company(). 'School',
        ]);

        $response = $this->put("/students/{$student->id}",[
            'nameEn' => 'john doe' ,
            'nameAr' =>  'جون دو',
            'email' =>  $student->email,
            'birthDate' => $student->birthDate,
            'governorate' => $student->governorate->value,
            'NationalId' => $student->NationalId,
            // 'photo' => $file,
            'phoneNumber' => $student->phoneNumber,
            'studentStatus' => $student->studentStatus,
            'school' => $student->school,
        ]);

        $student->refresh();

        // check if it change and status code
        $response->assertValid();
        $this->assertEquals('john doe',$student->nameEn);
        $this->assertEquals('جون دو',$student->nameAr);
        $response->assertStatus(302);

    }

    public function test_delete_student_successfully() :void
    {
        $student = Student::create([
           'nameEn' => fake()->name() ,
            'nameAr' =>  fake('ar_SA')->name(),
            'email' =>  fake()->safeEmail(),
            'birthDate' => fake()->date('d-m-Y'),
            'governorate' => fake()->randomElement(['cairo','giza','alexandria']),
            'NationalId' => fake()->numerify('##############'),
            // 'photo' => $file,
            'phoneNumber' => fake()->regexify('01(0|1|2|5)[0-9]{8}'),
            'studentStatus' => fake()->randomElement([0,1]),
            'school' => fake()->company(). 'School',

        ]);

        $response = $this->delete(route('students.destroy',$student));

        $response->assertStatus(302);

    }
}
