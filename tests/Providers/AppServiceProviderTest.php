<?php

/**
 * Tests for valid instance from service container
 */

namespace Test\Providers;

class AppServiceProviderTest extends \TestCase
{
    public function testValidTwilio()
    {
        $twilioName = 'Aloha\Twilio\TwilioInterface';
        $twilio = $this->app->make($twilioName);
        $this->assertInstanceOf($twilioName, $twilio);
    }
}
