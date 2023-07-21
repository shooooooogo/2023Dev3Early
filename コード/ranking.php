<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロトタイプ</title>
    <!-- cssの導入 -->
    <link rel="stylesheet" href="css/style.css?v=2">
    <link rel="stylesheet" href="./css/ranking.css">
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

    <!-- 個別cssの読み込み場所 -->

    <!--  -->
    <title>ランキング</title>   
</head>
<body>

    <header id="header">
        <div class="text-start">
            <a href="top.php"><img class="logo" src="img/SumaDeliIcon.png" alt="スマデリ"></a>
        </div>
        
    </header>
<svg xmlns="http://www.w3.org/2000/svg" width="200" height="500" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
</svg>

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
                    <a href="myPage.php" class="row ml-5" style="text-decoration: none;">
                        <img class="col-3 img-fluid" src="img/UserIcon_default.png">
                        <h3 class="col-6 text-start ml-3 pt-2" style="text-decoration: none; color: #333333;">ユーザ名</h3>
                    </a>
                </div>


                <!-- 虫眼鏡付きの検索ボックス -->
                <li class="text-start">
                    <form action="searchResult.php" method="post" class="search_container">
                        <input type="text" name="recipe_name" size="15" placeholder="料理名・食材名">
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
    <ul class="slider slick-initalizad stick-slider slick-dotted">== $0
<div class="flex">
  <figure class="sampledish1"><img src="img/naporitan.png" alt="料理" style="width: 180px"></figure>
  <div class="right">
    <p class="title">nameA ナポリタン</p>
    <p class="text" style="text-align:left">予算　○○円　<br>
        いいね数　○○
    </p>
  </div>
</div>

<div class="flex">
  <figure class="sampledish2"><img src="img/iekeiramen.png" alt="料理" style="width: 180px"></figure>
  <div class="right">
    <p class="title">   nameB 家系ラーメン</p>
    <p class="text">    予算　○○円　<br>                    
            いいね数　○○
    </p>
  </div>
</div>
<div class="flex">
  <figure class="sampledish3"><img src="img/omurice.png" alt="料理" style="width: 180px" ></figure>
  <div class="right">
    <p class="title">   nameC オムライス</p>
    <p class="text" >    予算　○○円　 <br>               
            いいね数　○○
    </p>
  </div>
</div>
<ul>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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