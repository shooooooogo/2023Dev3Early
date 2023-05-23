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
    <!-- 謎のナビゲーションバー？ -->
    <!-- <div class="header_inner">
        <div class="header_comment row justify-content-between">
             なんていうか見出しのコメント的な奴
            <div class="header_caption col align-self-start">
                食費をカットしよう
            </div>
            ユーザアイコン
            <div class="col align-self-end">
                <i class="bi bi-person-circle" style="text-align:right"></i>
            </div>
        </div>
    </div> -->

    <!-- ナビゲーションバー(本気) -->
    <header id="header">
        <div class="text-start">
            <img class="logo" src="img/SumaDeliIcon.png" alt="スマデリ">
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
                
                <!-- ロゴ -->
                <div class="text-center mb-3">
                    <img class="logo" src="img/SumaDeliIcon.png" alt="スマデリ">
                </div>
                


                <!-- 虫眼鏡付きの検索ボックス -->
                <li>
                    <form action="#" method="post" class="search_container">
                        <input type="text" size="25" placeholder="料理名・食材名">
                        <input type="submit" value="&#xf002">
                    </form>
                </li>

                <li><a href="#">Top画面</a></li>  
                <li><a href="#">ランキング</a></li>  
                <li><a href="#">料理検索</a></li>
                <li><a href="#">マイページ</a></li>
                <li><a href="#">レシピを作る</a></li>
                <li><a href="#">ログアウト</a></li>  
                
               
            </ul>            
        </div>
    </nav>

    <!-- フォント例 -->
    <div style="text-align:center">
        <p class="fontGothic">pゴシック</p>
        <p class="fontGothicBold">p太字ゴシック</p>
        <h3 class="fontGothic">h3ゴシック見出し</h3>
        <h4 class="fontGothic">h4ゴシック見出し</h4>
        <h5 class="fontGothic">h5ゴシック見出し</h5>
        <h6 class="fontGothic">h6ゴシック見出し</h6>
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