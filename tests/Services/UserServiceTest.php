<?php
/**
 * Test file for App\Services\UserService
 */

namespace Test\Services;

/**
 * Test class for App\Services\UserService
 */
class UserServiceTest extends \TestCase
{
    /** @var string */
    protected $userServiceName = 'App\Interfaces\Services\UserServiceInterface';
    protected $userModelName   = 'App\Interfaces\Models\UserModelInterface';

    public function setUp()
    {
        parent::setUp();
    }

    public function testValidInstance()
    {
        $userService = $this->app->make($this->userServiceName);
        $this->assertInstanceOf($this->userServiceName, $userService);
    }

    public function todoTestRegisterUser()
    {
        // TODO
    }

    public function testGetUsers()
    {
        $this->app->bind($this->userModelName, TestGetUsers::class);
        $userService = $this->app->make($this->userServiceName);
        $this->assertEmpty($userService->getUsers());
    }
}

abstract class AbstractUserMockClass implements \App\Interfaces\Models\UserModelInterface
{
    public function getUsers() {}
    public function getUserById($userId, array $columns = ['*']) {}
    public function getUserByGitHubId($gitHubId) {}
    public function retrieveByToken($userId, $token, array $columns = ['*']) {}
    public function updateRememberToken($userId, $token) {}
    public function updateUser($userId, array $updateColumns) {}
    public function insertUser($phoneNumber) {}
}

class TestRegisterUserSuccess extends AbstractUserMockClass
{
    public function insertUser($phoneNumber) { return 1; }
}

class TestGetUsers extends AbstractUserMockClass
{
    public function getUsers() { return []; }
}
