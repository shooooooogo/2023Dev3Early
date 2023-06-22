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
        // recipe_name
    }



    // 下書き作成

    // 下書き新規保存
    public function insertRecipe($recipe_name, $recipe_introduction, $genre_id, $user_id, $time_zone_id, $recipe_people, $prefecture_id){
        $pdo = $this->dbConnect();
        $sql = "INSERT INTO recipes(recipe_id,recipe_name, recipe_introduction, genre_id, user_id, time_zone_id, recipe_people, recipe_is_upload, prefecture_id)
                 VALUES(:recipe_id,:recipe_name, :recipe_introduction, :genre_id, :user_id, :time_zone_id, :recipe_people, :recipe_is_upload, :prefecture_id)";
        $ps=$pdo->prepare($sql);

        $ps->bindValue(':recipe_id',0,PDO::PARAM_STR);
        $ps->bindValue(':recipe_name', $recipe_name, PDO::PARAM_STR);
        $ps->bindValue(':recipe_introduction', $recipe_introduction, PDO::PARAM_STR);
        $ps->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
        $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $ps->bindValue(':time_zone_id', $time_zone_id, PDO::PARAM_INT);
        $ps->bindValue(':recipe_people', $recipe_people, PDO::PARAM_INT);
        $ps->bindValue(':recipe_is_upload', 0, PDO::PARAM_INT);
        $ps->bindValue(':prefecture_id', $prefecture_id, PDO::PARAM_INT);
        
        $ps->execute();
    
        $lastInsertId = (int)$pdo->LastInsertId();
        return $lastInsertId;
    }

    // 下書きのサムネイルを追加で保存
    public function insertRecipeThumbnail($recipe_id,$recipe_image){
        $pdo = $this->dbConnect();
        $sql = "UPDATE recipes SET recipe_image = :recipe_image WHERE recipe_id = :recipe_id";
        $recipeImage = $pdo->prepare($sql);

        $recipeImage->bindValue(":recipe_image",$recipe_image,PDO::PARAM_STR);
        $recipeImage->bindValue(":recipe_id",$recipe_id,PDO::PARAM_INT);

        $recipeImage->execute();
    }

    

    // 材料新規保存
    public function insertMaterials($id,$name,$quantity,$cost,$num){
        $pdo = $this->dbConnect();
        $sql ="INSERT INTO materials(recipe_id, material_line_number, material_name, material_quantity, material_cost) VALUES(:recipe_id, :material_line_number, :material_name, :material_quantity, :material_cost)";
        $materials = array();
        
        for($i=0; $i<$num; $i++){
            $materials[$i]=$pdo->prepare($sql);
            
            $materials[$i]->bindValue(':recipe_id',$id,PDO::PARAM_INT);
            $materials[$i]->bindValue(':material_line_number',$i,PDO::PARAM_INT);
            $materials[$i]->bindValue(':material_name',$name[$i],PDO::PARAM_STR);
            $materials[$i]->bindValue('material_quantity',$quantity[$i],PDO::PARAM_STR);
            $materials[$i]->bindValue('material_cost',$cost[$i],PDO::PARAM_INT);

            $materials[$i]->execute();
        }

    }

    


    // 作り方の情報を保存サーバ上に画像をアップロードする
    public function insertHowTo($recipe_id,$howToImage,$text,$num){
        $pdo = $this->dbConnect();
        $sql ="INSERT INTO how_to_make(recipe_id,how_to_make_lines_number,how_to_make_image, how_to_make_text) VALUES(:recipe_id, :how_to_make_lines_number, :how_to_make_image, :how_to_make_text)";
        $targetDir = "img/HowTo/";  // アップロードされたファイルを保存するディレクトリパス

        for($i=0; $i<$num; $i++){

            $imageFileType[$i] = strtolower(pathinfo($howToImage["name"][$i], PATHINFO_EXTENSION));//拡張子を格納
            $targetFile[$i] = $targetDir.$recipe_id."_HowTo".$i.".".$imageFileType[$i];//保存するファイル名を格納
            move_uploaded_file($howToImage["tmp_name"][$i], $targetFile[$i]);
            
            $insertHowTo[$i] = $pdo->prepare($sql);
            
            $insertHowTo[$i] -> bindValue(":recipe_id",$recipe_id,PDO::PARAM_INT);
            $insertHowTo[$i] -> bindValue(":how_to_make_lines_number",$i,PDO::PARAM_INT);
            $insertHowTo[$i] -> bindValue(":how_to_make_image",$targetFile[$i],PDO::PARAM_STR);
            $insertHowTo[$i] -> bindValue(":how_to_make_text",$text[$i],PDO::PARAM_STR);

            $insertHowTo[$i]->execute();
        }

    }


// 検索まとめ

    // ジャンル検索(genre_id)
    public function selectGenre($genre_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT genre_name FROM genres WHERE genre_id = :genre_id";
        $selectGenres = $pdo->prepare($sql);

        $selectGenres->bindValue(":genre_id", $genre_id, PDO::PARAM_INT);

        $selectGenres->execute();
        return $selectGenres->fetchAll();
    }

    // レシピ検索(recipe_id)
    public function SelectRecipe($recipe_id){
        $pdo = $this->dbConnect();
        $sql ="SELECT * FROM recipes WHERE recipe_id = :recipe_id";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(":recipe_id",$recipe_id, PDO::PARAM_INT);
        $ps->execute();
        return $ps->fetch();
    }

    // 材料検索(recipe_id)
    public function selectMaterials($id){
        $pdo = $this->dbConnect();
        $sql = "SELECT material_line_number,material_name, material_quantity, material_cost FROM materials WHERE recipe_id = :recipe_id";
        $selectMaterials = $pdo->prepare($sql);
        $selectMaterials-> bindValue(':recipe_id',$id,PDO::PARAM_INT);

        $selectMaterials->execute();

        return $selectMaterials->fetchAll();
    }

    // ユーザ検索(user_id)
    public function selectUser($user_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $selectUser = $pdo->prepare($sql);

        $selectUser->bindValue(":user_id",$user_id,PDO::PARAM_INT);

        $selectUser->execute();

        return $selectUser->fetch();
    }

    // 時間帯検索(time_zone_id)
    public function selectTimeZone($time_zone_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM time_zones WHERE time_zone_id = :time_zone_id";
        $selectTimeZone = $pdo->prepare($sql);

        $selectTimeZone->bindValue(":time_zone_id", $time_zone_id, PDO::PARAM_INT);

        $selectTimeZone->execute();

        return $selectTimeZone->fetch();
    }

    // 都道府県検索
    public function selectPrefecture($prefecture_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM prefectures WHERE prefecture_id = :prefecture_id";
        $selectPrefecture = $pdo->prepare($sql);

        $selectPrefecture -> bindValue(":prefecture_id", $prefecture_id, PDO::PARAM_INT);

        $selectPrefecture->execute();

        return $selectPrefecture->fetch();
    }

    // 作り方検索
    public function selectHowTo($recipe_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM how_to_make WHERE recipe_id = :recipe_id";
        $selectHowTo = $pdo->prepare($sql);

        $selectHowTo -> bindValue(":recipe_id", $recipe_id, PDO::PARAM_INT);

        $selectHowTo -> execute();

        return $selectHowTo -> fetchAll();
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
        $sql= "SELECT * FROM recipes WHERE recipe_name LIKE '%$recipe_search_name%'";
        $ps= $pdo->prepare($sql);
        // $ps->bindValue(':recipe_set',$recipe_search_name);
        $ps->execute();
        //検索一覧ページに移動
        if ($ps->rowCount() > 0) {
            $resultRecipe = $ps->fetchAll();
            return $resultRecipe;
        }else{
            echo "該当するレシピが存在しません";
            $resultRecipe = $ps->fetchAll();
            return $resultRecipe;
        }
    }


    //ユーザー名変更
    public function user_name_change($change_user_name){
        $pdo= $this->dbConnect();
                                        // ↓新たに追加したいユーザー名       ↓場所指定
        $sql= "UPDATE users SET user_name = :new_user_name WHERE user_mail = :reset_user_name";
        $ps= $pdo->prepare($sql);
        //変更するユーザー名を投入
        $ps->bindValue(':new_user_name', $change_user_name);
        //SESSIONで場所を指定
        $ps->bindValue(':reset_user_name',$_SESSION['id']);
        $ps->execute();
        // メールアドレスの更新に成功した場合、ログインページに移動する
        // if ($ps->rowCount() > 0) {
        //     header("Location: login.php");
        //     exit();
        // }else{
        //     echo "以前のメールアドレスが間違っています。もう一度やり直してください";
        // }
    }


    //紹介文変更
    public function introduction_change($change_introduction){
        $pdo= $this->dbConnect();
                                        // ↓新たに追加したいユーザー名       ↓場所指定
        $sql= "UPDATE users SET user_introduction = :new_user_introduction WHERE user_mail = :reset_user_introduction";
        $ps= $pdo->prepare($sql);
        //変更するユーザー名を投入
        $ps->bindValue(':new_user_introduction', $change_introduction);
        //SESSIONで場所を指定
        $ps->bindValue(':reset_user_introduction',$_SESSION['id']);
        $ps->execute();
        // メールアドレスの更新に成功した場合、ログインページに移動する
        // if ($ps->rowCount() > 0) {
        //     header("Location: login.php");
        //     exit();
        // }else{
        //     echo "以前のメールアドレスが間違っています。もう一度やり直してください";
        // }
    }


    //アイコン表示
    // public function display_the_icon(){
    //     $pdo = $this->dbConnect();
    //     $sql= "SELECT user_icon FROM users WHERE user_mail = :search_icon";
    //     $ps=$pdo->prepare($sql);
        //SESSIONで場所を指定
        // $ps->bindValue(':search_icon',$_SESSION['id']);
        // var_dump($ps);
    //     $ps->execute();
    //     $icon = $ps->fetchAll();
    //     return $icon;
    // }


    //アイコン変更
    // public function icon_change($icon_image){
    //     $pdo = $this->dbConnect();
    //     $sql= "UPDATE users SET user_icon = :new_user_icon WHERE user_mail = :reset_user_icon";
    //     $ps=$pdo->prepare($sql);
    //     $ps->bindValue(':new_user_icon', file_get_contents($icon_image), PDO::PARAM_STR);
        //SESSIONで場所を指定
        //$ps->bindValue(':reset_user_icon',$_SESSION['id']);
        // var_dump($ps);
    //     $ps->execute();
    //     $icon = $ps->fetchAll();
    //     return $icon;
    // }


    //都道府県変更
    public function prefecture_change($prefecture){
        $pdo = $this->dbConnect();
        $sql= "UPDATE users SET prefecture_id = :new_user_prefecture WHERE user_mail = :reset_user_prefecture";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(':new_user_prefecture', $prefecture);
        //SESSIONで場所を指定
        $ps->bindValue(':reset_user_prefecture',$_SESSION['id']);
        $ps->execute();
    }
}
?>