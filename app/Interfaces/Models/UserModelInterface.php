<?php
/**
 * ユーザDB周りの処理を行う
 */
namespace App\Interfaces\Models;

interface UserModelInterface
{
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
     * @param string $userId
     *
     * @return int $result
     */
    public function deleteUser($userId);

    /**
     * GitHub名からIDを取得
     *
     * @param string $gitHubName
     *
     * @return int $userId | null
     */
    public function getIdByGitHubName($gitHubName);
}
