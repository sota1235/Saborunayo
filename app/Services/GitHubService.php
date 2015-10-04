<?php
/**
 * GitHubの情報を取得する
 */
namespace App\Services;

use App\Interfaces\Services\GitHubServiceInterface;

/**
 * GitHub上での情報をチェックする
 */
class GitHubService extends Service implements GitHubServiceInterface {

    /**
     * constructor
     */
    public function __construct()
    {
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
        $userPageUrl = 'https://github.com/'.$userName;

        // GET request
        $client = new \GuzzleHttp\Client();
        $res = $client->request(
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
    }
}
