<?php
require_once 'DAO.php';
$dao = new DAO();
$searchArray = $dao->loginTbl($_POST['mail']);
foreach($searchArray as $row){
    if(password_verify($_POST['password'], $row['user_password'])  ==  true){
        header("Location: top.php");
        exit();
}else{
    echo "ログインに失敗しました";
    }
}
?>