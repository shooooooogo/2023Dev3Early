<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロトタイプ</title>
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
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/css/5-1-14.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">

    <!-- このページのcss -->
    <link rel="stylesheet" href="css/myPage.css">
</head>
<body>

    <!-- この中に要素を追加 -->
    
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

    <div class="user">
        <!-- ユーザートップ -->
        <div class="user-top">
            <img src="img/UserIcon_default.png" alt="アイコン" class="user-icon">
            <h1 class="user-name">USERNAME</h1>
            <div class="user-setting">
                <i class="bi bi-gear-fill"></i>
            </div>
        </div>

        <!-- ユーザー情報 -->
        <div class="user-info">
            <p class="prefecture user-info-text">__県民</p>
            <p class="follow user-info-text"><span class="user-info-text-bold">フォロー</span>：9,999人</p>
            <p class="follow user-info-text"><span class="user-info-text-bold">フォロワー</span>：9,999人</p>
            <textarea name="#" class="introduction user-info-text" cols="40" row="3">ここにユーザーの紹介文を表示</textarea>
        </div>
    </div>



        <img class=UserIcon_default>

        
    <!-- /この中に要素を追加 -->

    <!-- ここら辺はマイページからパクってくる -->
    
    <div style="width:90%;margin-left:auto;margin-right:auto; border-top: 2px solid #000000;">
        <div class="popular"><br>
            <h1 style="text-align:left">・人気のレシピ</h1>
            <!-- ここからレシピの塊 -->
            <div class="row">
                <!-- 画像 -->
                <div class="col-4" style="margin-bottom: 5px; margin-top: 5px;">
                    <image src="img/PepperRice.png"style="width:100%">
                </div>

                <div class="col-8 row">
                    <!-- タイトル -->
                    <div class="col-12">
                        ペッパーライス
                    </div>
                    <!-- 予算 -->
                    <div class="col-6">
                        予算
                    </div>
                    <div class="col-6">
                        100円
                    </div>
                    <!-- いいね、お気に入り　-->
                    <div class="col-6">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span style="">9999999</span>
                    </div>
                    <div class="col-6">
                        <i class="bi bi-bookmark-star"></i>
                        <span style="">9999999</span>
                    </div>
                </div>
                <div style="border-bottom: 1px solid #000000; margin-left:auto;margin-right:auto;"></div>
            </div>


            <div class="row" style="border-bottom: 1px solid #000000;">
                <!-- 画像 -->
                <div class="col-4" style="margin-bottom: 5px; margin-top: 5px;">
                    <image src="img/PepperRice.png"style="width:100%">
                </div>

                <div class="col-8 row">
                    <!-- タイトル -->
                    <div class="col-12">
                        ペッパーライス
                    </div>
                    <!-- 予算 -->
                    <div class="col-6">
                        予算
                    </div>
                    <div class="col-6">
                        100円
                    </div>
                    <!-- いいね、お気に入り　-->
                    <div class="col-6">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span style="">9999999</span>
                    </div>
                    <div class="col-6">
                        <i class="bi bi-bookmark-star"></i>
                        <span style="">9999999</span>
                    </div>
                </div>
            </div>

            




        </div>

        <div class="newpost"><br>
            <h1 style="text-align:left">・最新の投稿</h1>


            <div class="row" style="border-bottom: 1px solid #000000;">
                <!-- 画像 -->
                <div class="col-4" style="margin-bottom: 5px; margin-top: 5px;">
                    <image src="img/PepperRice.png"style="width:100%">
                </div>

                <div class="col-8 row">
                    <!-- タイトル -->
                    <div class="col-12">
                        ペッパーライス
                    </div>
                    <!-- 予算 -->
                    <div class="col-6">
                        予算
                    </div>
                    <div class="col-6">
                        100円
                    </div>
                    <!-- いいね、お気に入り　-->
                    <div class="col-6">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span style="">9999999</span>
                    </div>
                    <div class="col-6">
                        <i class="bi bi-bookmark-star"></i>
                        <span style="">9999999</span>
                    </div>
                </div>
            </div>


        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    </div>



    <!-- 下のナビゲーションバー -->
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
</body>
</html>