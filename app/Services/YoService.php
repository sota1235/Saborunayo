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
    public function sendYo()
    {
        $apiUrl = $this->apiBaseUrl.'/yoall/';

        // POST /yoall/
        try {
            $this->getHttpClient()->request(
                'POST',
                $apiUrl,
                ['api_token' => $this->apiKey]
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error(__FILE__.' '.__function__.' '.__line__.'Send Yo for all user failed');
        }
    }

    /**
     * ユーザをYo対象リストに登録する
     *
     * @param string $userName
     *
     * @return bool $result
     */
    public function addUser($userName)
    {
        $apiUrl = $this->apiBaseUrl.'/yo/';

        // POST /yo/
        try {
            $this->getHttpClient()->request(
                'POST',
                $apiUrl,
                [
                    'api_token' => $this->apiKey,
                    'username'  => $userName,
                ]
            );
            \Log::info(__FILE__.' '.__function__.' '.__line__.' Send yo to'.$userName);
            return true;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \Log::error(__FILE__.' '.__function__.' '.__line__.' Send Yo to '.$userName.' failed');
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
