<?php

namespace Tests;

use App\Enums\Messages\Message;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Illuminate\Http\Response;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected $seed = true;

    protected function hasPatternApi(TestResponse $response, $message = Message::OK, $httpStatus = Response::HTTP_OK)
    {
        $response->assertOk();
        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['message', 'status', 'content'])
                ->missingAll(['errors'])
        );
        $response->assertJsonPath('message', $message);
        $response->assertJsonPath('status', $httpStatus);
    }

}
