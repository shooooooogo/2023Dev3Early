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
        $user_id=1;
        $time_zone_id = (int)$_POST['time_zone_id'];
        $recipe_people = (int)$_POST['recipe_people'];
        $perfecture_id = (int)$_POST['perfecture_id'];
        // recipesテーブルに新規レコード登録＆ID取得
        $currentRecipeId=$dao->insertRecipe($_POST['recipe_name'],$_FILES['recipe_image']['tmp_name'],$_POST['recipe_intro'],$genre_id,$user_id,$time_zone_id,$recipe_people,$perfecture_id);
        

        // デバッグ用(完成したら削除)
        var_dump($_POST);
        echo "<br>";
        var_dump($_FILES);


        // 材料が登録されていれば、それらをmaterialsテーブルに格納する

        if($_POST['materialName'] != NULL){
            $dao->insertMaterials($currentRecipeId,$_POST['materialName'],$_POST['materialQuantity'],$_POST['materialCost'],$_POST['materialNumber']);
        }

        // 作り方が投稿されていれば、それらをhow_to_makeテーブルに全て格納する

        if($_POST['How_To_image'] != NULL){
            echo "Hello";
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
        <!-- =var_dump($_POST);
            var_dump($_FILES['recipe_image']);
            echo "<br><br><br><br><br><br>";
            var_dump($_FILES);
        
        -->



        <div class="container-fluid">
            <div class="row">
                <div class="border col-3">
                    <p>タイトル</p>
                </div>
                <div class="border col-9">
                    
                </div>
                <div class="border col-3">
                    <p>サムネイル画像</p>
                </div>
                <div class="border col-9">
                    
                </div>

                <div class="border col-3">
                    <p>紹介文</p>
                </div>
                <div class="border col-9">
                    
                </div>
                <div class="border col-3">
                    <p>ジャンル</p>
                </div>
                <div class="border col-9">

                </div>
                <div class="border col-3">
                    <p>投稿者</p>
                </div>
                <div class="border col-9">
                    
                </div>
                <div class="border col-3">
                    <p>時間帯</p>
                </div>
                <div class="border col-9">
                    
                </div>
                <div class="border col-3">
                    <p>何人前</p>
                </div>
                <div class="border col-9">
                    
                </div>
                <div class="border col-3">
                    <p>都道府県</p>
                </div>
                <div class="border col-9">
                    
                </div>
                <div class="border col-3">
                    <p>材料</p>
                </div>
                <div class="border col-9">
                    
                </div>
                <div class="border col-3">
                    <p>作り方</p>
                </div>
                <div class="border col-9">
                    
                </div>
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
    <footer class="text-center">
        <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-3" style="margin-left:5%"><img class="imgIcon" src="img/Home.png"></a>
            <a href="mypage.php" class="offset-1 col-3"><img class="imgIcon" src="img/Mypage.png"></a>
            <a href="createRecipe.php" class="offset-1 col-3"><img class="imgIcon" src="img/Recipe.png"></a>
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
</body>
</html>