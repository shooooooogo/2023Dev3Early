<?php
//ユーザー名変更
require_once 'DAO.php';
$dao = new DAO();
$dao->user_name_change($_POST['Chenge_user_name']);
?>