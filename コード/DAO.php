<?php
//データベース接続
class DAO{
   private function dbConnect(){
    $pdo= new PDO('mysql:host=localhost;dbname=smart_delicious;charset=utf8','root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo; 
}


    //新規追加部分
   public function insertGetTbl($getmail,$getpass,$getuser){         
    $pdo= $this->dbConnect();
    //メールアドレス、ユーザー名、パスワードを登録
    $sql= "INSERT INTO users(user_id,user_name,user_password)VALUES(?,?,?)";
    $ps= $pdo->prepare($sql);
    $ps->bindValue(1, $getmail, PDO::PARAM_STR);
    $ps->bindValue(2, $getuser, PDO::PARAM_STR);
    //パスワードをハッシュ化
    $ps->bindValue(3, password_hash($getpass, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $ps->execute();
    //トップページに移動
    header("Location: top.php");
    exit();
    }



    //ログイン処理
    public function loginTbl($logmail){
        $pdo= $this->dbConnect();
        //アカウントが存在するか
        $sql= "SELECT * FROM users WHERE user_id = ?";
        $ps= $pdo->prepare($sql);
        $ps->bindValue(1, $logmail, PDO::PARAM_STR);
        $ps->execute();
        //データベースに登録しているメアドがあったら
        if ($ps->rowCount() > 0) {
            //パスワードの照合のため、login_check.phpに移動
            $log_check = $ps->fetchAll();
            return $log_check;
        }else{
            //データベースに登録していないとき
            echo "メールアドレスが間違っています。もう一度やり直してください";
            $log_check = $ps->fetchAll();
            return $log_check;
        }
        
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
    
    //メールアドレス再設定
    public function resetMail($resetmail,$newmail){
                $pdo= $this->dbConnect();
                                                // ↓新たに追加したいメアド       ↓前のメアド
                $sql= "UPDATE users SET user_id = :new_user_id WHERE user_id = :reset_user_id";
                $ps= $pdo->prepare($sql);
                //新たに追加するメアドを投入
                $ps->bindValue(':new_user_id', $newmail);
                //前のメアドを投入
                $ps->bindValue(':reset_user_id',$resetmail);
                $ps->execute();
                // メールアドレスの更新に成功した場合、ログインページに移動する
                if ($ps->rowCount() > 0) {
                    header("Location: login.php");
                    exit();
                }else{
                    echo "以前のメールアドレスが間違っています。もう一度やり直してください";
                }
            }


    //パスワード再設定
    public function resetPassword($resetpass,$newpass){
                $pdo= $this->dbConnect();
                                                // ↓新たに追加したいパスワード       ↓前のパスワード
                $sql= "UPDATE users SET user_id = :new_user_password WHERE user_id = :reset_user_password";
                $ps= $pdo->prepare($sql);
                //新たに追加するパスワードを投入
                $ps->bindValue(':new_user_password', $newpass);
                //前のパスワードを投入
                $ps->bindValue(':reset_user_password',$resetpass);
                $ps->execute();
                // パスワードの更新に成功した場合、ログインページに移動する
                if ($ps->rowCount() > 0) {
                    header("Location: login.php");
                    exit();
                }else{
                    echo "以前のパスワードが間違っています。もう一度やり直してください";
                }
        }
}
?>