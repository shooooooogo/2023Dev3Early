<?php
//都道府県を変更
require_once 'DAO.php';
$dao = new DAO();
$dao->prefecture_change((int)$_POST['change_user_prefecture']);
?>