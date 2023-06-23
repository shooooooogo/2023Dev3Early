<?php
require_once 'DAO.php';
$dao = new DAO();
if (isset($_POST['upload'])) {
    $targetDir = "img/icon/";// アップロードされたファイルを保存するディレクトリパス 例：img/icon/1_icon.png
    $image_icon_FileType = strtolower(pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION));//拡張子を格納
    //アイコン画像のパスにuser_idを埋め込みたいので、user_idをdisplay_the_iconで取りに行く　結果をreturnで格納
    $image_icon_id = $dao->display_the_icon();
    foreach($image_icon_id as $row){//image_icon_idをforeachで回す
        $icon_id = $row['user_id'];//user_idを取得し、icon_idへ格納
    }
    $targetFile = $targetDir.$icon_id."_icon.".$image_icon_FileType;//保存するファイル名を格納
    $dao->icon_change($icon_id,$targetFile);
  //↓これがサーバにアップロードする関数
    move_uploaded_file($_FILES["icon"]["tmp_name"], $targetFile);//アイコン情報と保存するファイル名セット
        header("Cache-Control: no-cache");//なんかキャッシュをクリアするやつ
        header("Pragma: no-cache");////キャッシュをクリア
        header("Location: setting.php");//設定画面へ
}
?>