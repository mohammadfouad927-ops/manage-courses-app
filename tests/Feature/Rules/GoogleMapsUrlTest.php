<?php

namespace Tests\Feature\Rules;

use App\Rules\GoogleMapsUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class GoogleMapsUrlTest extends TestCase
{
    #[DataProvider('validGoogleMapsUrlProvider')]
    public function test_rule_google_maps_urls_should_be_valid($input):void{
        
        $rule = new GoogleMapsUrl();
        $passed = true;

        $rule->validate('googleMapLink', $input,function($message) use(&$passed){
            $passed = false;
        });

        $this->assertTrue($passed);
    }

    #[DataProvider('unvalidGoogleMapsUrlProvider')]
    public function test_rule_google_maps_urls_should_be_unvalid($input):void{
        
        $rule = new GoogleMapsUrl();
        $failed = false;

        $rule->validate('googleMapLink', $input,function($message) use(&$failed){
            $failed = true;
        });

        $this->assertTrue($failed);
    }

    public static function validGoogleMapsUrlProvider(): array{
        return [
            ['https://maps.app.goo.gl/zDzjZ9NXhcCxSw4o9'],
            ['https://maps.app.goo.gl/D5KDaDvj3UkTFek89'],
            ['https://www.google.com/maps/place/El+Saraya+Restaurant+and+Cafe+%7C+%D9%85%D8%B7%D8%B9%D9%85+%D9%88%D9%83%D8%A7%D9%81%D9%8A%D9%87+%D8%A7%D9%84%D8%B3%D8%B1%D8%A7%D9%8A%D8%A7%E2%80%AD/@30.951072,31.152342,647m/data=!3m1!1e3!4m12!1m5!3m4!2zMzDCsDU3JzAzLjkiTiAzMcKwMDknMDguNCJF!8m2!3d30.951072!4d31.152342!3m5!1s0x14f7bb7b986d2c95:0xca6c8326e0f787f7!8m2!3d30.9516909!4d31.153637!16s%2Fg%2F11wbjghb44!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDQwOC4wIKXMDSoASAFQAw%3D%3D'],
            ['https://www.google.com/maps/search/30.968550,+31.157447?entry=tts&g_ep=EgoyMDI2MDQwOC4wIPu8ASoASAFQAw%3D%3D&skid=e6513242-749d-43ba-bd3d-6534da81cf0c'],
        ];
    }

    public static function unvalidGoogleMapsUrlProvider():array {
        return [
                ['https://invalid-url.com'],
                ['https://maps.google.com/invalid'],
                ['https://goo.gl/maps/invalid'],
                ['not-a-url'],
                ['https://www.facebook.com'],
                ['https://www.x.com'],
        ];
    }
}
