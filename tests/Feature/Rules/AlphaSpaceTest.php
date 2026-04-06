<?php

namespace Tests\Feature\Rules;

use App\Rules\AlphaSpace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AlphaSpaceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    #[DataProvider('validNameProvider')]
    public function test_it_passes_for_english_letters_and_spaces($input){
        # Setup the rule and flag
        $rule = new AlphaSpace();
        $passed = true;

        // We use closure to catch if the rule fails
        $rule->validate('name',$input, function($message) use(&$passed){
            $passed = false;
        });

        $this->assertTrue($passed);
    }

    #[DataProvider('invalidNameProvider')]
    public function test_it_should_failed_for_invalid_inputs($input){
        // setup the rule and flag
        $rule = new AlphaSpace();
        $failed = false;

        // Run the code with bad input
        $rule->validate('name',$input,function($message) use(&$failed){
            $failed = true;
        });

        // check if the result is true
        $this->assertTrue($failed,'Validtion should have Failed for: $input');
    }

    public static function invalidNameProvider(): array{
        return [
            ['John123'],
            ['John_Doe'],
            ['John@Doe'],
            [trim('  ')]
        ];
    }

    public static function validNameProvider():array{
        return [['Mohammed'], ['Mohamed Ayman'], ['MOHAMED  AYMAN'], ['MOHAMED'], [' Mohamed Ayman '], ['MoHaMeD']];
    }
}
