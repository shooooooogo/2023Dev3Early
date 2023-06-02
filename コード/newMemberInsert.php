<?php
require_once 'DAO.php';
$dao = new DAO();
$dao->insertGetTbl($_POST['email'],$_POST['password'],$_POST['username']);
// $count = count($searchArray);
?>