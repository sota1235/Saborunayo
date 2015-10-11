<?php
/**
 * GitHubの情報を取得する
 */
namespace App\Services;

use App\Interfaces\Services\GitHubServiceInterface;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * GitHub上での情報をチェックする
 */
class GitHubService extends Service implements GitHubServiceInterface
{
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
        $body = $this->getHttpClient()->request(
            'GET',
            $this->getGitHubUrl($userName)
        )->getBody()->getContents();

        // parse response body
        $dom = HtmlDomParser::str_get_html($body);
        $elms = $dom->find('rect[class=day]');
        return (string)$elms[0]->fill === '#eeeeee';
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
