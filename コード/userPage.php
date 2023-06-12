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

</head>
<body>

    <!-- この中に要素を追加 -->
        <img class=UserIcon_default>

        
    <!-- /この中に要素を追加 -->

    <!-- ここら辺はマイページからパクってくる -->
    
    <div style="width:90%;margin-left:auto;margin-right:auto; border-top: 1px solid #000000;">
        <div class="popular"><br>
            <h1 style="text-align:left">・人気のレシピ</h1>
            <!-- ここからレシピの塊 -->
            <div class="row">
                <!-- 画像 -->
                <div class="col-4">
                    <image src="img/PepperRice.png"style="width:100%">
                </div>

                <div class="offset-1 col-7 row">
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
                    <div class="col-5">
                        <i class="bi bi-hand-thumbs-up"></i>
                    </div>
                    <div class="col-6">
                        <i class="bi bi-bookmark-star"></i>
                    </div>
                </div>


            </div>
        </div>
        <br>
        <div class="newpost"><br>
            <h1 style="text-align:left">・最新の投稿</h1>

        </div>
        <br><br><br><br><br><br>

    </div>



    <!-- 下のナビゲーションバー ※リンク未定義-->
    <footer class="text-center">
        <div class="row footerBar fontGothicBold">
            <a href="#" class="col-3" style="margin-left:5%"><img class="imgIcon" src="img/Home.png"></a>
            <a href="#" class="offset-1 col-3"><img class="imgIcon" src="img/Mypage.png"></a>
            <a href="#" class="offset-1 col-3"><img class="imgIcon" src="img/Recipe.png"></a>
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