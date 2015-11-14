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
     * test method for getUsers
     * user exist
     */
    public function testGetUsers()
    {
        $userModel = $this->app->make('App\Interfaces\Models\UserModelInterface');
        $mockGName      = 'hoge';
        $mockPhonNumber = 'moge';
        // db setting
        \DB::table('users')->delete();
        \DB::table('users')->insert([
            'github_name'  => $mockGName,
            'phone_number' => $mockPhonNumber
        ]);
        // execute
        $result = $userModel->getUsers();
        // assertion
        $this->assertNotEmpty($result);
        $this->assertEquals($result[0]->github_name, $mockGName);
        $this->assertEquals($result[0]->phone_number, $mockPhonNumber);
        // settle DB
        \DB::table('users')->delete();
        $this->missingFromDatabase('users', ['github_name' => $mockGName]);
    }

    /**
     * test method for getUsers
     * user empty
     */
    public function testGetNoUsers()
    {
        $userModel = $this->app->make('App\Interfaces\Models\UserModelInterface');
        // db setting
        \DB::table('users')->delete();
        // execute
        $result = $userModel->getUsers();
        // assertion
        $this->assertEmpty($result);
    }

    /**
     * test method for getUsers
     * deleted user not exist
     */
    public function testNotGetDeletedUsers()
    {
        $userModel = $this->app->make('App\Interfaces\Models\UserModelInterface');
        // db setting
        $mockData = [
            'github_name'  => 'hoge',
            'phone_number' => 'moge',
            'deleted_flag' => 1
        ];
        \DB::table('users')->delete();
        \DB::table('users')->insert($mockData);
        // execute
        $result = $userModel->getUsers();
        // assertion
        $this->seeInDatabase('users', $mockData);
        $this->assertEmpty($result);
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
        $this->seeInDatabase('users', ['github_name' => 'soke', 'phone_number' => 'hoge']);
    }

    /**
     * test method for deleteUser
     * delete user success
     */
    public function testDeleteUser()
    {
        $userModel = $this->app->make('App\Interfaces\Models\UserModelInterface');

        // insert data to delete
        $result = $userModel->insertUser('soke', 'hoge');
        // assertion
        $this->assertEquals($result, 1);
        $this->seeInDatabase('users', ['github_name' => 'soke', 'phone_number' => 'hoge']);

        // delete data
        $result = $userModel->deleteUser('soke');
        // assertion
        $this->assertEquals($result, 1);
        $this->missingFromDatabase('users', ['github_name' => 'soke', 'phone_number' => 'hoge']);
    }

    /**
     * test method for deleteUser
     * delete user failed (delete non exist user)
     */
    public function testDeleteUserFailed()
    {
        $userModel = $this->app->make('App\Interfaces\Models\UserModelInterface');

        // delete data
        $this->missingFromDatabase('users', ['github_name' => 'soke']);
        $result = $userModel->deleteUser('soke');
        // assertion
        $this->assertEquals($result, 0);
    }
}
