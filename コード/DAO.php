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
    $sql= "INSERT INTO users(user_mail,user_name,user_password)VALUES(?,?,?)";
    $ps= $pdo->prepare($sql);
    $ps->bindValue(1, $getmail, PDO::PARAM_STR);
    $ps->bindValue(2, $getuser, PDO::PARAM_STR);
    //パスワードをハッシュ化
    $ps->bindValue(3, password_hash($getpass, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $ps->execute();
    //トップページに移動
    header("Location: login.php");
    exit();
    }

    //新規登録の際、同じメールアドレスが使われていないかチェック
    public function insertSeachMail($seachMail){
        $pdo= $this->dbConnect();
        $sql= "SELECT * FROM users WHERE user_mail LIKE '$seachMail'";;
        $ps= $pdo->prepare($sql);
        $ps->execute();
        if ($ps->rowCount() == 0) {
            return 0;
        }else{
            return 1;
        }
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
            if(isset($howToImage['name'][$i])){
                $imageFileType[$i] = strtolower(pathinfo($howToImage["name"][$i], PATHINFO_EXTENSION));//拡張子を格納
                $targetFile[$i] = $targetDir.$recipe_id."_HowTo".$i.".".$imageFileType[$i];//保存するファイル名を格納
                move_uploaded_file($howToImage["tmp_name"][$i], $targetFile[$i]);    
            }else{
                $targetFile[$i] = $targetDir.$recipe_id."_HowTo".$i.".png";//保存するファイル名を格納  
                copy("img/noimage.png", $targetFile[$i]);  
            }
            
            $insertHowTo[$i] = $pdo->prepare($sql);
            
            $insertHowTo[$i] -> bindValue(":recipe_id",$recipe_id,PDO::PARAM_INT);
            $insertHowTo[$i] -> bindValue(":how_to_make_lines_number",$i,PDO::PARAM_INT);
            $insertHowTo[$i] -> bindValue(":how_to_make_image",$targetFile[$i],PDO::PARAM_STR);
            $insertHowTo[$i] -> bindValue(":how_to_make_text",$text[$i],PDO::PARAM_STR);

            $insertHowTo[$i]->execute();
        }

    }

    // 下書きを投稿して他の人も見れるようにする(recipe_id)
    public function recipeUpload($recipe_id){
        $pdo = $this->dbConnect();
        $sql = "UPDATE recipes SET recipe_is_upload = 1 WHERE recipe_id = :recipe_id";
        $recipeUpload = $pdo->prepare($sql);

        $recipeUpload ->bindValue(":recipe_id", $recipe_id, PDO::PARAM_INT);

        $recipeUpload->execute();
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
    // 投稿済みレシピ検索(recipe_id,1)
    public function selectRecipe1($recipe_id){
        $pdo = $this->dbConnect();
        $sql ="SELECT * FROM recipes WHERE recipe_id = :recipe_id AND recipe_is_upload = 1";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(":recipe_id", $recipe_id, PDO::PARAM_INT);
        $ps->execute();
        return $ps->fetch();
    }
    // 下書きのレシピ検索(recipe_id,0)
    public function selectRecipe0($recipe_id){
        $pdo = $this->dbConnect();
        $sql ="SELECT * FROM recipes WHERE recipe_id = :recipe_id AND recipe_is_upload = 0";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(":recipe_id", $recipe_id, PDO::PARAM_INT);
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

    // 都道府県検索(prefecture_id)
    public function selectPrefecture($prefecture_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM prefectures WHERE prefecture_id = :prefecture_id";
        $selectPrefecture = $pdo->prepare($sql);

        $selectPrefecture -> bindValue(":prefecture_id", $prefecture_id, PDO::PARAM_INT);

        $selectPrefecture->execute();

        return $selectPrefecture->fetch();
    }

    // 作り方検索(recipe_id)
    public function selectHowTo($recipe_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM how_to_make WHERE recipe_id = :recipe_id";
        $selectHowTo = $pdo->prepare($sql);

        $selectHowTo -> bindValue(":recipe_id", $recipe_id, PDO::PARAM_INT);

        $selectHowTo -> execute();

        return $selectHowTo -> fetchAll();
    }

    // いいね検索(user_id)
    public function selectGood($user_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM goods WHERE user_id = :user_id";
        $selectgood = $pdo->prepare($sql);

        $selectgood->bindValue(":user_id", $user_id, PDO::PARAM_INT);

        $selectgood->execute();
        return $selectgood->fetchAll();
    }

    // お気に入り検索(user_id)
    public function selectFavorite($user_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT * FROM favorites WHERE user_id = :user_id";
        $selectfavorite = $pdo->prepare($sql);

        $selectfavorite->bindValue(":user_id", $user_id, PDO::PARAM_INT);

        $selectfavorite->execute();
        return $selectfavorite->fetchAll();
    }



    // フォローに関する機能(フォローする人→follower_user_id  フォローを受ける人→follow_user_id)
    // フォローしている人数カウント(user_id)
    public function countFollows($follower_user_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT COUNT(*) FROM follows WHERE follower_user_id = :follower_user_id";
        $Count = $pdo->prepare($sql);

        $Count->bindValue(":follower_user_id", $follower_user_id, PDO::PARAM_INT);

        $Count->execute();

        return $Count->fetch();
    }
    // フォロワー人数カウント(user_id)
    public function countFollowers($follow_user_id){
        $pdo = $this->dbConnect();
        $sql = "SELECT COUNT(*) FROM follows WHERE follow_user_id = :follow_user_id";
        $Count = $pdo->prepare($sql);

        $Count->bindValue(":follow_user_id", $follow_user_id, PDO::PARAM_INT);

        $Count->execute();

        return $Count->fetch();
    }
    


    //ユーザ毎のページで利用するレシピ情報の抽出(user_id,recipe_id)
    //特定のユーザがいいねしている投稿済みレシピの関連情報の抽出(user_id)
    public function selectGoodRecipes($user_id){
        $pdo = $this->dbConnect();
        
        $sql = "SELECT recipes.recipe_id,
                       recipes.recipe_name, 
                       recipes.recipe_image, 
                       SUM(materials.material_cost) AS sumCost, 
                       (SELECT COUNT(*) FROM goods WHERE goods.recipe_id = recipes.recipe_id) AS goodCount
                       (SELECT COUNT(*) FROM favorites WHERE favorites.recipe_id = recipes.recipe_id) AS favoriteCount

        FROM
        recipes
        INNER JOIN
        materials ON recipes.recipe_id = materials.recipe_id
        WHERE
        recipes.recipe_is_upload = 1
        AND EXISTS(SELECT * FROM goods WHERE user_id = :user_id)
        GROUP BY
        recipes.recipe_id";
        $selectGR = $pdo->prepare($sql);

        $selectGR->bindValue(":user_id",$user_id, PDO::PARAM_INT);
        $selectGR->execute();
        return $selectGR->fetchAll();
    }
    //特定のユーザがお気に入り登録している投稿済みレシピの関連情報の抽出(user_id)
    public function selectFavoriteRecipes($user_id){
        $pdo = $this->dbConnect();
        
        $sql = "SELECT recipes.recipe_id,
                       recipes.recipe_name, 
                       recipes.recipe_image, 
                       SUM(materials.material_cost) AS sumCost, 
                       (SELECT COUNT(*) FROM goods WHERE goods.recipe_id = recipes.recipe_id) AS goodCount
                       (SELECT COUNT(*) FROM favorites WHERE favorites.recipe_id = recipes.recipe_id) AS favoriteCount

        FROM
        recipes
        INNER JOIN
        materials ON recipes.recipe_id = materials.recipe_id
        WHERE
        recipes.recipe_is_upload = 1
        AND EXISTS(SELECT * FROM favorites WHERE user_id = :user_id)
        GROUP BY
        recipes.recipe_id";
        $selectFR = $pdo->prepare($sql);

        $selectFR->bindValue(":user_id",$user_id, PDO::PARAM_INT);
        $selectFR->execute();
        return $selectFR->fetchAll();
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

//レシピ詳細Part1
public function recipeDetail($detail_id){
    $pdo= $this->dbConnect();
    //レシピidでWHERE句を指定
    $sql= "SELECT * FROM recipes WHERE recipe_id = $detail_id";
    $ps= $pdo->prepare($sql);
    // $ps->bindValue(':recipe_set',$recipe_search_name);
    $ps->execute();
    //dishDetail.phpにreturnで値を返す
    if ($ps->rowCount() > 0) {
        $resultRecipe = $ps->fetchAll();
        return $resultRecipe;
    }else{
        echo "該当するレシピが存在しません";
        $resultRecipe = $ps->fetchAll();
        return $resultRecipe;
    }
}


//レシピ詳細Part2
public function recipeDetail_materials($detail_id){
    $pdo= $this->dbConnect();
    //レシピidでWHERE句を指定
    $sql= "SELECT * FROM materials WHERE recipe_id = $detail_id";
    $ps= $pdo->prepare($sql);
    // $ps->bindValue(':recipe_set',$recipe_search_name);
    $ps->execute();
    //dishDetail.phpにreturnで値を返す
    if ($ps->rowCount() > 0) {
        $resultRecipe = $ps->fetchAll();
        return $resultRecipe;
    }else{
        echo "該当するレシピが存在しません";
        $resultRecipe = $ps->fetchAll();
        return $resultRecipe;
    }
}
//レシピ詳細Part3
public function recipeDetail_how_to_make($detail_id){
    $pdo= $this->dbConnect();
    //レシピidでWHERE句を指定
    $sql= "SELECT * FROM how_to_make WHERE recipe_id = $detail_id";
    $ps= $pdo->prepare($sql);
    // $ps->bindValue(':recipe_set',$recipe_search_name);
    $ps->execute();
    //dishDetail.phpにreturnで値を返す
    if ($ps->rowCount() > 0) {
        $resultRecipe = $ps->fetchAll();
        return $resultRecipe;
    }else{
        echo "該当するレシピが存在しません";
        $resultRecipe = $ps->fetchAll();
        return $resultRecipe;
    }
}


    //レシピ検索
    public function recipeSearch($recipe_search_name){
        $pdo= $this->dbConnect();
        //レシピ名を検索
        $sql= "SELECT * FROM recipes WHERE recipe_name LIKE '%$recipe_search_name%' AND recipe_is_upload = 1";
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

    //レシピ詳細の投稿者特定
    public function user_recipeDetail($recipe_user_id){
        $pdo= $this->dbConnect();
        //レシピidでWHERE句を指定
        $sql= "SELECT * FROM users WHERE user_id = $recipe_user_id";
        $ps= $pdo->prepare($sql);
        // $ps->bindValue(':recipe_set',$recipe_search_name);
        $ps->execute();
        //dishDetail.phpにreturnで値を返す
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
    public function user_name_change($change_user_name,$s){
        $pdo= $this->dbConnect();
                                        // ↓新たに追加したいユーザー名       ↓場所指定
        $sql= "UPDATE users SET user_name = :new_user_name WHERE user_id = :reset_user_name";
        $ps= $pdo->prepare($sql);
        //変更するユーザー名を投入
        $ps->bindValue(':new_user_name', $change_user_name);
        //SESSIONで場所を指定
        $ps->bindValue(':reset_user_name',$s);
        $ps->execute();
        // ユーザー名の更新に成功した場合、returnで1を返す
        if ($ps->rowCount() > 0) {
            return 1;
        }else{
            return "失敗してるって適当にreturnするか。だって、ここの処理見ることなんてほぼないからねー";
        }
    }


    //紹介文変更
    public function introduction_change($change_introduction,$s){
        $pdo= $this->dbConnect();
                                        // ↓新たに追加したいユーザー名       ↓場所指定
        $sql= "UPDATE users SET user_introduction = :new_user_introduction WHERE user_id = :reset_user_introduction";
        $ps= $pdo->prepare($sql);
        //変更するユーザー名を投入
        $ps->bindValue(':new_user_introduction', $change_introduction);
        //SESSIONで場所を指定
        $ps->bindValue(':reset_user_introduction',$s);
        $ps->execute();
        // 紹介文の更新に成功した場合、returnで1を返す
        if ($ps->rowCount() > 0) {
            return 1;
        }else{
            return "失敗してるって適当にreturnするか。だって、ここの処理見ることなんてほぼないからねー";
        }
    }


    //アイコン表示
    public function display_the_icon($s){
        $pdo = $this->dbConnect();
        $sql= "SELECT * FROM users WHERE user_id = :search_icon";
        $ps=$pdo->prepare($sql);
        //SESSIONで場所を指定
        $ps->bindValue(':search_icon',$s);
        //var_dump($ps);
        $ps->execute();
        $icon = $ps->fetchAll();
        return $icon;
    }


    //アイコン変更
    public function icon_change($icon_id,$iconFile){
        $pdo = $this->dbConnect();
        $sql= "UPDATE users SET user_icon = :new_user_icon WHERE user_id = :reset_user_icon";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(':new_user_icon',$iconFile, PDO::PARAM_STR);
        //
        $ps->bindValue(':reset_user_icon',$icon_id);
        $ps->execute();
        // アイコンの更新に成功した場合、returnで1を返す
        if ($ps->rowCount() > 0) {
            return 1;
        }else{
            return "失敗してるって適当にreturnするか。だって、ここの処理見ることなんてほぼないからねー";
        }
    }


    //都道府県変更
    public function prefecture_change($prefecture,$s){
        $pdo = $this->dbConnect();
        $sql= "UPDATE users SET prefecture_id = :new_user_prefecture WHERE user_id = :reset_user_prefecture";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(':new_user_prefecture', $prefecture);
        //SESSIONで場所を指定
        $ps->bindValue(':reset_user_prefecture',$s);
        $ps->execute();
        // 都道府県の更新に成功した場合、returnで1を返す
        if ($ps->rowCount() > 0) {
            return 1;
        }else{
            return "失敗してるって適当にreturnするか。だって、ここの処理見ることなんてほぼないからねー";
        }
    }
}
?>