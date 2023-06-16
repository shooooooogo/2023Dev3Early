<?php
//紹介文変更
require_once 'DAO.php';
$dao = new DAO();
$dao->introduction_change($_POST['Change_introduction']);
?>