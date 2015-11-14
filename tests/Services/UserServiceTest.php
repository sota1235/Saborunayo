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

        $this->userModelName = 'App\Interfaces\Models\UserModelInterface';
    }

    /**
     * test method for registerUser()
     * user's registration successed
     */
    public function testRegisterUserSuccess()
    {
        $this->app->bind($this->userModelName, 'TestRegisterUserSuccess');
        $userService = new UserService($this->userModelFactory());
        // assertion
        $this->assertTrue($userService->registerUser('hoge', 'moge'));
    }

    /**
     * test method for registerUser()
     * user's registration failed
     */
    public function testRegisterUserFailed()
    {
        $this->app->bind($this->userModelName, 'TestRegisterUserFailed');
        $userService = new UserService($this->userModelFactory());
        // assertion
        $this->assertFalse($userService->registerUser('hoge', 'moge'));
    }

    /**
     * test method for getUsers()
     */
    public function testGetUsers()
    {
        $this->app->bind($this->userModelName, 'TestGetUsers');
        $userService = new UserService($this->userModelFactory());
        // assertion
        $this->assertEmpty($userService->getUsers());
    }

    /**
     * test method for dropUser()
     * dorpping user success
     */
    public function testDropUserSuccess()
    {
        $this->app->bind($this->userModelName, 'TestDropUserSuccess');
        $userService = new UserService($this->userModelFactory());
        // assertion
        $this->assertTrue($userService->dropUser('hoge'));
    }

    /**
     * test method for dropUser()
     * dorpping user failed
     */
    public function testDropUserFailed()
    {
        $this->app->bind($this->userModelName, 'TestDropUserFailed');
        $userService = new UserService($this->userModelFactory());
        // assertion
        $this->assertFalse($userService->dropUser('hoge'));
    }

    /**
     * return UserModel instance from service container
     */
    private function userModelFactory()
    {
        return $this->app->make($this->userModelName);
    }
}

abstract class AbstractUserMockClass implements \App\Interfaces\Models\UserModelInterface
{
    public function getUsers() {}
    public function getUserById($userId, array $columns = ['*']) {}
    public function retrieveByToken($userId, $token, array $columns = ['*']) {}
    public function updateRememberToken($userId, $token) {}
    public function insertUser($gitHubName, $phoneNumber) {}
    public function deleteUser($userId) {}
}

class TestRegisterUserSuccess extends AbstractUserMockClass
{
    public function insertUser($gitHubName, $phoneNumber) { return 1; }
}

class TestRegisterUserFailed extends AbstractUserMockClass
{
    public function insertUser($gitHubName, $phoneNumber) { return 0; }
}

class TestGetUsers extends AbstractUserMockClass
{
    public function getUsers() { return []; }
}

class TestDropUserSuccess extends AbstractUserMockClass
{
    public function deleteUser($userId) { return 1; }
}

class TestDropUserFailed extends AbstractUserMockClass
{
    public function deleteUser($userId) { return 0; }
}
