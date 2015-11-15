<?php
/**
 * ユーザDB周りの処理を行う
 */
namespace App\Interfaces\Models;

interface UserModelInterface
{
    /**
     * 有効な登録済みユーザを取得
     *
     * @return array
     */
    public function getUsers();

    /**
     * ユーザIDからユーザ情報を取得
     *
     * @param int   $userId
     * @param array $culumns
     *
     * @return array|null
     */
    public function getUserById($userId, array $columns = ['*']);

    /**
     * GitHub IDからユーザ情報を取得
     *
     * @param mixed $gitHubId
     *
     * @return array|null
     */
    public function getUserByGitHubId($gitHubId);

    /**
     * remember_tokenからユーザを取得
     *
     * @param mixed  $userId
     * @param string $token
     * @param array  $culumns
     *
     * @return array|null
     */
    public function retrieveByToken($userId, $token, array $columns = ['*']);

    /**
     * remember_tokenを更新
     *
     * @param mixed  $userId
     * @param string $token
     */
    public function updateRememberToken($userId, $token);

    /**
     * 指定されたパラメータを更新
     *
     * @param mixed  $userId
     * @param array  $updateColumns
     *
     * @return int
     */
    public function updateUser($userId, array $updateColumns);

    /**
     * ユーザを登録し、IDを返す
     *
     * @param int $phoneNumber
     *
     * @return int
     */
    public function insertUser($phoneNumber);
}
