<?php
/**
 * Yo APIと通信するクラス
 */

interface YoServiceInterface {
  /**
   * 登録済みユーザ全員にYoを送る
   *
   * @return void
   */
  public function sendYo();

  /**
   * ユーザをYo対象リストに登録する
   *
   * @param string $userName
   *
   * @return bool $result
   */
  public function addUser($userName);

  /**
   * ユーザをYo対象リストから削除する
   *
   * @param string $userName
   *
   * @return bool $result
   */
  public function dropUser($userName);
}
