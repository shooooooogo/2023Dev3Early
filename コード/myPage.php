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
            <a href="top.php"><img class="logo" src="img/SumaDeliIcon.png" alt="スマデリ"></a>
        </div>
    </header>

   

    <!-- この中に要素を追加 -->
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
            <p class="follow user-info-text"><span class="user-info-text-bold">フォロー数</span>：9,999人</p>
            <p class="follow user-info-text"><span class="user-info-text-bold">フォロワー数</span>：9,999人</p>
            <textarea name="#" class="introduction user-info-text" cols="50" >テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</textarea>
        </div>

        <!-- ログインまたは新規登録 -->
        <h1 class="user-register">
            <a href="./newRegister.php" class="user-register-link">新規登録</a>
            または<a href="./login.php" class="user-register-link">ログイン</a>
        </h1>


    </div>

    
        
    <!-- /この中に要素を追加 -->


    <!-- 下のナビゲーションバー ※リンク未定義-->
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