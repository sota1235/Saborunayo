<?php
/**
 * ユーザDB周りの処理を行う
 */
namespace App\Interfaces\Models;

interface UserModelInterface {
  /**
   * ユーザを登録する
   *
   * @param string $userName
   *
   * @return int $result
   */
  public function insertUser($userName);

  /**
   * ユーザを削除する
   *
   * @param string $userName
   *
   * @return int $result
   */
  public function deleteUser($userName);
}
