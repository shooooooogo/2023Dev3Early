<?php
class DAO{
   private function dbConnect(){
    $pdo= new PDO('mysql:host=localhost;dbname=smart_delicious;charset=utf8','root', 'root');
    return $pdo; 
}


    //新規追加部分
   public function insertGetTbl($getmail,$getpass,$getuser){         
    $pdo= $this->dbConnect();
    $sql= "INSERT INTO users(user_id,user_name,user_password)VALUES(?,?,?)";
    $ps= $pdo->prepare($sql);
    $ps->bindValue(1, $getmail, PDO::PARAM_STR);
    $ps->bindValue(2, $getuser, PDO::PARAM_STR);
    $ps->bindValue(3, password_hash($getpass, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $ps->execute();
    header("Location: top.php");
    exit();
    }



    //ログイン処理
    public function loginTbl($logmail){
        $pdo= $this->dbConnect();
        $sql= "SELECT * FROM users WHERE user_id = ?";
        $ps= $pdo->prepare($sql);
        $ps->bindValue(1, $logmail, PDO::PARAM_STR);
        $ps->execute();
        $log_check = $ps->fetchAll();
        return $log_check;

    }



    // 下書き作成

    // 下書き新規保存
    public function insertRecipe($recipe_name, $recipe_image, $recipe_introduction, $genre_id, $user_id, $time_zone_id, $recipe_people, $perfecture_id){
        $pdo = $this->dbConnect();
        $sql = "INSERT INTO recipes(recipe_name, recipe_image, recipe_introduction, genre,id, user_id, time_zone_id, recipe_people, recipe_is_upload, :perfecture_id) VALUES(:recipe_name, :recipe_image, :recipe_introduction, :genre_id, :user_id, :time_zone_id, :recipe_people, :perfecture_id)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(':recipe_name', $recipe_name, PDO::PARAM_STR);
        $ps->bindValue(':recipe_image', $recipe_image, PDO::PARAM_STR);
        $ps->bindValue(':recipe_introduction', $recipe_introduction, PDO::PARAM_STR);
        $ps->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
        $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $ps->bindValue(':time_zone_id', $time_zone_id, PDO::PARAM_INT);
        $ps->bindValue(':recipe_people', $recipe_people, PDO::PARAM_INT);
        $ps->bindValue(':perfecture_id', $perfecture_id, PDO::PARAM_INT);
        $ps->execute();

    }
}
?>