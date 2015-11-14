<?php
/**
 * ユーザ情報を制御する
 */
namespace App\Interfaces\Services;

use Laravel\Socialite\Two\User;

interface UserServiceInterface
{
    /**
     * ユーザを登録する
     *
     * @param User $gitHubUser
     *
     * @return int $userId
     */
    public function registerUser(User $user);

    /**
     * 全ユーザの情報を取得
     *
     * @return array
     */
    public function getUsers();

    /**
     * ユーザを削除する
     *
     * @param string $gitHubName
     *
     * @return bool $result
     */
    public function dropUser($gitHubName);
}
