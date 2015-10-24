<?php
/**
 * Test file for App\Http\Controllers\MainController
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Test class for App\Http\Controllers\MainController
 */
class MainControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test to access main page
     */
    public function testVistMainPage()
    {
        // return status 200
        $this->visit('/')
             ->seeStatusCode(200);
    }

    /**
     * test for main page elm
     *
     * @dataProvider mainPageTexts
     */
    public function testMainPageText($text)
    {
        $this->visit('/')
             ->see($text);
    }

    /**
     * data provider for TestMainPageText()
     *
     * @return array
     */
    public function mainPageTexts()
    {
        return [
            ['SaborunaYo'],
            ['GitHub name'],
            ['Yo name'],
            ['Register'],
            ['Fork me on GitHub'],
        ];
    }
}
