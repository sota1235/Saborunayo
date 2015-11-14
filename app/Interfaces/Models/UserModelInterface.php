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
     * ユーザを登録する
     *
     * @param string $gitHubName
     * @param int    $phoneNumber
     *
     * @return int $result
     */
    public function insertUser($gitHubName, $phoneNumber);

    /**
     * ユーザを削除する
     *
     * @param string $gitHubName
     *
     * @return int $result
     */
    public function deleteUser($gitHubName);
}
