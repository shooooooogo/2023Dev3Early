<?php
require_once 'DAO.php';
$dao = new DAO();
if (isset($_POST['upload'])) {
    $targetDir = "img/icon/";
    $image_icon_FileType = strtolower(pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION));//拡張子を格納
    $image_icon_id = $dao->display_the_icon();
    foreach($image_icon_id as $row){
        $icon_id = $row['user_id'];
    }
    $targetFile = $targetDir.$icon_id."_icon.".$image_icon_FileType;//保存するファイル名を格納
    $dao->icon_change($icon_id,$targetFile);
    move_uploaded_file($_FILES["icon"]["tmp_name"], $targetFile);
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Location: setting.php");
}
?>