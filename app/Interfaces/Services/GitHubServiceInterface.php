<?php
/**
 * GitHubの情報を取得する
 */

interface GitHubService {
    /**
     * GitHubにユーザが存在するかどうかチェックする
     *
     * @param string $userName
     *
     * @return bool
     */
    public function isExist($userName);

    /**
     * その日に草が生えてるかをチェックする
     *
     * @param string $userName
     *
     * @return bool
     */
    public function checkContribution($userName);
}
