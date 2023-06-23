<?php
require_once 'DAO.php';
$dao = new DAO();
$dao->icon_change($_POST['mail']);
?>