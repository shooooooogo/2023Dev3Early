<?php
session_start();
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
    $sql= "INSERT INTO users(user_mail,user_name,user_password)VALUES(?,?,?)";
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
        $sql= "SELECT * FROM users WHERE user_mail = ?";
        $ps= $pdo->prepare($sql);
        $ps->bindValue(1, $logmail, PDO::PARAM_STR);
        $ps->execute();
        //データベースに登録しているメアドがあったら
        if ($ps->rowCount() > 0) {
            //パスワードの照合のため、login_check.phpに移動
            $log_check = $ps->fetchAll();
            //SESSION使うかもしれないから一応置いとく
            foreach($log_check as  $row){
                $_SESSION['id'] = $row['user_mail'];
                $_SESSION['name'] = $row['user_name'];
            }
            return $log_check;
            exit();
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
        $sql = "INSERT INTO recipes(recipe_id,recipe_name, recipe_image, recipe_introduction, genre_id, user_id, time_zone_id, recipe_people, recipe_is_upload, perfecture_id)
                 VALUES(:recipe_id,:recipe_name, :recipe_image, :recipe_introduction, :genre_id, :user_id, :time_zone_id, :recipe_people, :recipe_is_upload, :perfecture_id)";
        $ps=$pdo->prepare($sql);

        $ps->bindValue(':recipe_id',0,PDO::PARAM_STR);
        $ps->bindValue(':recipe_name', $recipe_name, PDO::PARAM_STR);
        $ps->bindValue(':recipe_image', file_get_contents($recipe_image), PDO::PARAM_STR);
        $ps->bindValue(':recipe_introduction', $recipe_introduction, PDO::PARAM_STR);
        $ps->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
        $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $ps->bindValue(':time_zone_id', $time_zone_id, PDO::PARAM_INT);
        $ps->bindValue(':recipe_people', $recipe_people, PDO::PARAM_INT);
        $ps->bindValue(':recipe_is_upload', 0, PDO::PARAM_INT);
        $ps->bindValue(':perfecture_id', $perfecture_id, PDO::PARAM_INT);
        
        var_dump($ps);
        $ps->execute();
    }
    
    //メールアドレス再設定
    public function resetMail($resetmail,$newmail){
                $pdo= $this->dbConnect();
                                                // ↓新たに追加したいメアド       ↓前のメアド
                $sql= "UPDATE users SET user_mail = :new_user_mail WHERE user_mail = :reset_user_mail";
                $ps= $pdo->prepare($sql);
                //新たに追加するメアドを投入
                $ps->bindValue(':new_user_mail', $newmail);
                //前のメアドを投入
                $ps->bindValue(':reset_user_mail',$resetmail);
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
    public function resetPassword($log_mail,$resetpass,$newpass){
                $pdo= $this->dbConnect();
                                                // ↓新たに追加したいパスワード     ↓WHERE句で追加する場所の指定
                $sql= "UPDATE users SET user_password = :new_user_password  WHERE user_mail = :reset_user_password_log_mail";
                $ps= $pdo->prepare($sql);
                
                    //新たに追加するパスワードを投入
                $ps->bindValue(':new_user_password', password_hash($newpass, PASSWORD_DEFAULT), PDO::PARAM_STR);

                foreach($log_mail as $row){
                    
                    //$log_mail($row)をWHERE句に設置
                $ps->bindValue(':reset_user_password_log_mail',$row['user_mail']);
                
                    //入力された前のパスワードがあっているか
                if(password_verify($resetpass, $row['user_password'])  ==  true){

                    $ps->execute();

                // パスワードの更新に成功した場合、ログインページに移動する
                if ($ps->rowCount() > 0) {
                    header("Location: login.php");
                    exit();
                }
                }else{
                    echo "以前のパスワードが間違っています。もう一度やり直してください";
                    }
        }
    }




    //レシピ検索
    public function recipeSearch($recipe_search_name){
        $pdo= $this->dbConnect();
    //レシピ名を検索
    $sql= "SELECT * FROM recipes WHERE recipe_name LIKE %:recipe_set%";
    $ps= $pdo->prepare($sql);
    $ps->bindValue(':recipe_set',$recipe_search_name);
    $ps->execute();
    //検索一覧ページに移動
    if ($ps->rowCount() > 0) {
        $resultRecipe = $ps->fetchAll();
        return $resultRecipe;
    }else{
        echo "該当するレシピが存在しません";
        }
    }
}
?>