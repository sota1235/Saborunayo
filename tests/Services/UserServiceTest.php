<?php
/**
 * Test file for App\Services\UserService
 */
use App\Services\UserService;

/**
 * Test class for App\Services\UserService
 */
class UserServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test method for registerUser()
     * user's registration successed
     */
    public function testRegisterUserSuccess()
    {
        $this->app->bind('App\Interfaces\Models\UserModelInterface', function () {
            return new UserMockClass();
        });
        $userService = new UserService($this->app->make('App\Interfaces\Models\UserModelInterface'));
        // assertion
        $this->assertTrue($userService->registerUser('hoge', 'moge'));
    }
}

class UserMockClass implements \App\Interfaces\Models\UserModelInterface
{
    public function insertUser($gitHubName, $yoName) { return true; }
    public function deleteUser($userId) {}
    public function getIdByGitHubName($gitHubName) {}
}
