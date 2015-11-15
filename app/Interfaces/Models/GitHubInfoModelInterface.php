<?php
/**
 * GitHubから取得した情報を管理
 */
namespace App\Interfaces\Models;

interface GitHubInfoModelInterface
{
    /**
     * 新たにデータを登録する
     *
     * @param arrray $gitInfo
     */
    public function insert(array $columns);
}
