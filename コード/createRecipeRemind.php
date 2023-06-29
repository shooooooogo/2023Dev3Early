<?php
session_start();
if(isset($_SESSION['id']) == false  &&
     isset($_SESSION['name']) == false ){
        header('Location: login.php');
        exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ確認</title>
    <!-- cssの導入 -->
    <link rel="stylesheet" href="css/style.css?v=2">

    <!-- javascriptの導入 -->
    <script src="./script/script.js"></script>
    
    <!-- bootstrapのCSSの導入 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- 検索ボックス導入のためのcss -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- header導入のためのcss -->
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/css/5-1-14.css"> -->
    <link rel="stylesheet" type="text/css" href="css/header.css">

    <!-- 個別cssの読み込み場所 -->

    <!--  -->

    <?php
        require_once 'DAO.php';
        $dao = new DAO();
        
        // ジャンルid等、String型になっている物をint型に変換
        $genre_id = (int)$_POST['genre_id'];
        $user_id=$_SESSION['id'];//ユーザ情報をsessionで管理するか分からないので、取りあえず動作するように1固定にしてあります。
        $time_zone_id = (int)$_POST['time_zone_id'];
        $recipe_people = (int)$_POST['recipe_people'];
        $prefecture_id = (int)$_POST['prefecture_id'];
        $materialNumber = (int)$_POST['materialNumber'];
        $howToNumber = (int)$_POST['howToNumber'];

        // サムネイル画像をサーバ上にアップロードする

        $targetDir = "img/RecipeThumbnail/";  // アップロードされたファイルを保存するディレクトリパス
        $imageFileType = strtolower(pathinfo($_FILES["recipe_image"]["name"], PATHINFO_EXTENSION));//拡張子を格納
        
        // recipesテーブルに新規レコード登録＆ID取得
        $currentRecipeId=$dao->insertRecipe($_POST['recipe_name'],$_POST['recipe_intro'],$genre_id,$user_id,$time_zone_id,$recipe_people,$prefecture_id);
        
        $targetFile = $targetDir.$currentRecipeId."_thumbnail.".$imageFileType;//保存するファイル名を格納
        $dao->insertRecipeThumbnail($currentRecipeId, $targetFile);
        

        move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $targetFile);


        // 材料が登録されていれば、それらをmaterialsテーブルに格納する

        if($_POST['materialName'] != NULL){
            $dao->insertMaterials($currentRecipeId,$_POST['materialName'],$_POST['materialQuantity'],$_POST['materialCost'],$_POST['materialNumber']);
        }

        

        // 作り方が投稿されていれば、それらをhow_to_makeテーブルに全て格納する

        if($_FILES['How_To_image'] != NULL){
            $dao->insertHowTo($currentRecipeId,$_FILES['How_To_image'],$_POST['HowTo'],$_POST['howToNumber']);
        }



    ?>
</head>
<body>

    <!-- ナビゲーションバー(本気) -->
    <header id="header">
        <div class="text-start">
            <a href="top.php"><img class="logo" src="img/SumaDeliIcon.png" alt="スマデリ"></a>
        </div>
        
    </header>

    <div class="openbtn1">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav id="g-nav">
        <div id="g-nav-list"><!--ナビの数が増えた場合縦スクロールするためのdiv※不要なら削除-->
            <ul>
                <!-- <li>ここに色々書くと横から出てくる奴に表示されます</li> -->
            
                <!-- ユーザ情報表示 -->
                <div>
                    <!-- マイページへ遷移 -->
                    <a href="myPage.php" class="row ml-5 noDecoration">
                        <img class="col-3 img-fluid" src="img/UserIcon_default.png">
                        <h3 class="col-6 text-start ml-3 pt-2 text-black">ユーザ名</h3>
                    </a>
                </div>


                <!-- 虫眼鏡付きの検索ボックス -->
                <li class="text-start">
                    <form action="searchResult.php" method="post" class="search_container">
                        <input type="text" size="15" placeholder="料理名・食材名">
                        <input type="submit" value="&#xf002">
                    </form>
                </li>
                <div class="mt-3" style="border-bottom: 1px solid #333;"></div>
                <li><a href="top.php">Top画面</a></li>
                <li><a href="ranking.php">ランキング</a></li>
                <li><a href="myPage.php">マイページ</a></li>
                <li><a href="createRecipe.php">レシピを作る</a></li>
            </ul>         
        </div>
    </nav>

    <!-- このdivの中に要素を書き込んでください -->
    <div class="container-fluid elements">
        
        <?php

            $recipe = $dao->SelectRecipe($currentRecipeId);

        ?>


        <div class="container-fluid">
            <div class="row">
                <div class="border col-3">
                    <p>タイトル</p>
                </div>
                <div class="border col-9">
                    <?php echo "<p>".$recipe['recipe_name']."<p>" ?>
                </div>
                <div class="border col-3">
                    <p>サムネイル画像</p>
                </div>
                <div class="border col-9">
                    <?php echo "<img src='".$recipe['recipe_image']."' class='img-fluid'>" ?>
                </div>

                <div class="border col-3">
                    <p>紹介文</p>
                </div>
                <div class="border col-9">
                    <?php echo "<p>".$recipe['recipe_introduction']."<p>" ?>
                </div>
                <div class="border col-3">
                    <p>ジャンル</p>
                </div>
                <div class="border col-9">
                    <?php 
                        $genre_name = $dao->selectGenre($recipe['genre_id']);
                        echo "<p>".$genre_name[0]['genre_name']."<p>";

                    ?>
                </div>
                <div class="border col-3">
                    <p>投稿者</p>
                </div>
                <div class="border col-9">
                    <?php
                        $uploader = $dao->selectUser($recipe['user_id']);
                        echo '<p>'.$uploader['user_name'].'</p>';
                    ?>
                </div>
                <div class="border col-3">
                    <p>時間帯</p>
                </div>
                <div class="border col-9">
                    <?php
                        $time = $dao->selectTimeZone($recipe['time_zone_id']);
                        echo '<p>'.$time['time_zone_name'].'</p>';
                    ?>
                </div>
                <div class="border col-3">
                    <p>何人前</p>
                </div>
                <div class="border col-9">
                    <?php
                        echo '<p>'.$recipe['recipe_people'].'人前</p>';
                    ?>
                </div>
                <div class="border col-3">
                    <p>都道府県</p>
                </div>
                <div class="border col-9">
                    <?php
                        $prefecture = $dao->selectPrefecture($recipe['prefecture_id']);
                        echo '<p>'.$prefecture['prefecture_name'].'</p>';
                    ?>
                </div>
                <div class="border mt-3 col-12">
                    <p>材料</p>
                </div>
                <div class="border col-12 row">
                    <?php
                        $selectMaterial = $dao->selectMaterials($currentRecipeId);
                        $materialCountUp = 0;
                        foreach ($selectMaterial as $row) {
                            echo "<div class='border col-2'>".($materialCountUp+1)."</div>";
                            echo "<div class='border col-4'>".$row['material_name']."</div>";
                            echo "<div class='border col-3'>".$row['material_quantity']."</div>";
                            echo "<div class='border col-3'>".$row['material_cost']."</div>";

                            $materialCountUp++;
                        }
                    ?>
                </div>
                <div class="border mt-3 col-12">
                    <p>作り方</p>
                </div>
                <?php
                    $selectHowTo = $dao->selectHowTo($currentRecipeId);
                    $howToCountUp = (int)0;
                    foreach ($selectHowTo as $row) {
                        echo "<div class='border col-2'>".($howToCountUp+1)."</div>";
                        echo "<div class='border col-5'><img src='".$row['how_to_make_image']."' class='img-fluid'></div>";
                        echo "<div class='border col-5'>".$row['how_to_make_text']."</div>";
                        
                        $howToCountUp++;
                    }
                ?>
                
                    
                </div>
            </div>
            <div>
                <button onclick="recipeUpload(<?php echo $currentRecipeId ?>)">このままレシピを投稿する</button>
            </div>
        </div>


        <!-- ここまで -->
        <div class="footerCooporation">
            <p class="copyright">© 2023 Example Inc. All Rights Reserved.</p>
            <ul class="md-flex">
                <li><a href="terms.php">利用規約</a></li>
                <li><a href="privacy.php">プライバシーポリシー</a></li>
            </ul>
        </div>
    </div>
    
    


    <!-- 下のナビゲーションバー -->
    <br><br><br><br><br>
    <footer class="text-center">
        <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-4" style="color: black;text-decoration: none;"><i class="bi bi-house-fill" style="margin-left:10%;font-size:40px"></i></a>
            <a href="mypage.php" class="col-4"style="color: black;text-decoration: none;"><i class="bi bi-person-circle" style="font-size:40px"></i></a>
            <a href="createRecipe.php" class="col-4"style="color: black;text-decoration: none;"><i class="bi bi-journal-check" style="margin-right:10%;font-size:40px"></i></a>
        </div>
    </footer>

    <!-- bootstrapのjavascriptの導入(アイコンも) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    
    <!-- header導入のjs -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
    <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/js/5-1-14.js"></script>
    <script src="script/header.js"></script>

    <!-- 個別jsの導入 -->
    <script src="script/createRecipe/recipeUpload.js"></script>
</body>
</html>