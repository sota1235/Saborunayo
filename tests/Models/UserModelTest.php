<?php
/**
 * Test file for App\Models\UserModel
 */
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Test class for App\Models\UserModel
 */
class UserModelTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test method for insertUser
     * insert user success
     */
    public function testInsertUser()
    {
        $userModel = $this->app->make('App\Interfaces\Models\UserModelInterface');
        $result    = $userModel->insertUser('soke', 'hoge');
        // assertion
        $this->assertEquals($result, 1);
        $this->seeInDatabase('users', ['github_name' => 'soke', 'yo_name' => 'hoge']);
    }

    /**
     * test method for insertUser
     * insert user failed (throw PDOException)
     */
    public function testInsertUserFailed()
    {
        $userModel = $this->app->make('App\Interfaces\Models\UserModelInterface');
        // log settings
        $path = base_path('tests/storage/logs/usermodel.log');
        \Log::useFiles($path);

        /* insert first data */
        $result = $userModel->insertUser('soke', 'hoge');
        // assertion
        $this->assertEquals($result, 1);
        $this->seeInDatabase('users', ['github_name' => 'soke', 'yo_name' => 'hoge']);
        /* insert same data */
        $result = $userModel->insertUser('soke', 'hoge');
        // assertion
        $this->assertFileExists($path);
        $this->assertNotFalse(strpos(file_get_contents($path), 'Insert user failed'));
        $this->assertEquals($result, 0);
    }
}
