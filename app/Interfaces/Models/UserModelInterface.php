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
     * @param array
     */
    public function getUserById($userId, array $culumns = ['*']);

    /**
     * ユーザを登録する
     *
     * @param string $gitHubName
     * @param string $yoName
     *
     * @return int $result
     */
    public function insertUser($gitHubName, $yoName);

    /**
     * ユーザを削除する
     *
     * @param string $gitHubName
     *
     * @return int $result
     */
    public function deleteUser($gitHubName);
}
