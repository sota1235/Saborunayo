<?php
/**
 * ユーザ情報を制御する
 */
namespace App\Interfaces\Services;

interface UserServiceInterface
{
    /**
     * ユーザを登録する
     *
     * @param string $gitHubName
     * @param string $yoName
     *
     * @return bool $result
     */
    public function registerUser($gitHubName, $yoName);

    /**
     * ユーザを削除する
     *
     * @param string $gitHubName
     *
     * @return bool $result
     */
    public function dropUser($gitHubName);
}
