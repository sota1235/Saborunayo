<?php
/**
 * GitHubから取得した情報を管理
 */
namespace App\Models;

use App\Interfaces\Models\GitHubInfoModelInterface;

/**
 * github_informationsへの読み書き更新
 */
class GitHubInfoModel implements GitHubInfoModelInterface
{
    /** @var string */
    protected $table = 'github_informations';

    /**
     * 新たにデータを登録する
     *
     * @param arrray $gitInfo
     */
    public function insert(array $columns)
    {
        \DB::table($this->table)->insert($columns);
    }
}
