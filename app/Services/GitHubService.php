<?php
/**
 * GitHubの情報を取得する
 */
namespace App\Services;

use App\Interfaces\Services\GitHubServiceInterface;
use Goutte\Client;

/**
 * GitHub上での情報をチェックする
 */
class GitHubService extends Service implements GitHubServiceInterface
{
    /** @var Goutte\Client */
    protected $goutteClient;

    /**
     * constructor
     */
    public function __construct(Client $client)
    {
        $this->goutteClient = $client;
    }

    /**
     * GitHubにユーザが存在するかどうかチェックする
     *
     * @param string $userName
     *
     * @return bool
     */
    public function isExist($userName)
    {
        $userPageUrl = $this->getGitHubUrl($userName);

        // GET request
        $res = $this->getHttpClient()->request(
            'GET',
            $userPageUrl,
            [ 'http_errors' => false ] // not throw exception when 40x, 50x
        );

        if ($res->getStatusCode() === 404) {
            return false;
        }
        return true;
    }

    /**
     * その日に草が生えてるかをチェックする
     *
     * @param string $userName
     *
     * @return bool
     */
    public function checkContribution($userName)
    {
        // Getting user page souce
        $body = $this->goutteClient->request('GET', $this->getGitHubUrl($userName));

        // parse response body
        $contribution = null;
        $body->filter('rect')->last()->each(function ($name) {
            $contribution = $name->attr('fill');
        });

        // #eeeeeeはSaboってる
        return $contribution !== '#eeeeee';
    }

    /**
     * ユーザページのURLを取得
     *
     * @param string $userName
     *
     * @return string $url
     */
    protected function getGitHubUrl($userName)
    {
         return 'https://github.com/users/'.$userName.'/contributions';
    }
}
