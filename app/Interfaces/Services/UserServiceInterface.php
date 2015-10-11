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
     * @param string $gitName
     * @param string $yoName
     *
     * @return bool $result
     */
    public function registerUser($gitName, $yoName);

    /**
     * ユーザを削除する
     *
     * @param string $gitName
     *
     * @return bool $result
     */
    public function dropUser($gitName);
}
