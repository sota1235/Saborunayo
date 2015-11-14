<?php
/**
 * Test file for App\Models\GitHubInfoModel
 */
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Test class for App\Models\GitHubInfoModel
 */
class GitHubInfoModelTest extends TestCase
{
    use DatabaseMigrations;

    /** @var string */
    protected $gitHubInfoModelName = 'App\Interfaces\Models\GitHubInfoModelInterface';
    protected $targetTable         = 'github_informations';

    public function setUp()
    {
        parent::setUp();
    }

    public function testValidInstance()
    {
        $gitHubInfoModel = $this->app->make($this->gitHubInfoModelName);
        $this->assertInstanceOf($this->gitHubInfoModelName, $gitHubInfoModel);
    }

    public function testInsert()
    {
        $gitHubInfoModel = $this->app->make($this->gitHubInfoModelName);
        $gitHubInfo = [
            'user_id'   => 100,
            'token'     => 'token',
            'github_id' => 'github_id',
            'nickname'  => 'nickname',
            'name'      => 'name',
            'email'     => 'email',
            'avatar'    => 'avatar',
        ];
        $gitHubInfoModel->insert($gitHubInfo);
        $this->seeInDatabase($this->targetTable, $gitHubInfo);
        // 後片付け
        \DB::table($this->targetTable)->where('user_id', 100)->delete();
        $this->missingFromDatabase($this->targetTable, $gitHubInfo);
    }
}
