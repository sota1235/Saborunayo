<?php
/**
 * Yo APIと通信する
 */
namespace App\Services;

use App\Interfaces\Services\YoServiceInterface;

/**
 * Yo APIと通信するサービスクラス
 */
class YoService extends Service implements YoServiceInterface
{
    /** @var string */
    protected $apiKey;
    protected $apiBaseUrl;

    /**
     * constructor
     */
    public function __construct()
    {
        // API Key
        $this->apiKey = env('YO_API_KEY', null);
        // Base URL
        $this->apiBaseUrl = 'https://api.justyo.co';
    }

    /**
     * 登録済みユーザ全員にYoを送る
     *
     * @return void
     */
    public function sendYoAll()
    {
        $apiUrl = $this->apiBaseUrl.'/yoall/';

        // POST /yoall/
        try {
            $this->getHttpClient()->request(
                'POST',
                $apiUrl,
                [ 'form_params' => ['api_token' => $this->apiKey] ]
            );
            \Log::error(__FILE__.' '.__function__.' '.__line__.' Send Yo for all user success.');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error(__FILE__.' '.__function__.' '.__line__.' Send Yo for all user failed.');
        }
    }

    /**
     * ユーザにYoを送る
     *
     * @param string $userName
     *
     * @return bool
     */
    public function sendYo($userName)
    {
        $apiUrl = $this->apiBaseUrl.'/yo/';

        // POST /yo/
        try {
            $this->getHttpClient()->request(
                'POST',
                $apiUrl,
                [
                    'form_params' => [
                        'api_token' => $this->apiKey,
                        'username'  => $userName,
                    ]
                ]
            );
            \Log::info(__FILE__.' '.__function__.' '.__line__.' Send yo to'.$userName.' success');
            return true;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error(__FILE__.' '.__function__.' '.__line__.' Send Yo to '.$userName.' failed');
            \Log::error('error message '.$e->getMessage());
            return false;
        }
    }

    /**
     * Yoアカウントが存在するかどうか調べる
     *
     * @param string $userName
     *
     * @return bool
     */
    public function isExist($userName)
    {
        $apiUrl = $this->apiBaseUrl.'/check_username/';
        $params = http_build_query([
            'api_token' => $this->apiKey,
            'username'  => $userName,
        ]);
        $requestUrl = $apiUrl.'?'.$params;

        // GET request
        try {
            $res = $this->getHttpClient()->request('GET', $requestUrl);
            $result = json_decode($res->getBody());
            return $result->exists;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error(__FILE__.' '.__function__.' '.__line__.' Checking Yo Account, '.$userName.' failed');
            \Log::error('error message '.$e->getMessage());
            return false;
        }
    }

    /**
     * ユーザをYo対象リストから削除する
     *
     * @param string $userName
     *
     * @return bool $result
     */
    public function dropUser($userName)
    {
    }
}
