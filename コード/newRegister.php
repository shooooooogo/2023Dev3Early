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
    
    <!-- この画面専用のcss -->
    <link rel="stylesheet" href="./css/newRegister.css">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">


</head>
<body>
    <!-- この中に要素を追加 -->
<center>
        <img class="newRegisterlogo" src="img/SumaDeliIcon.png" alt="ロゴです">

    <div class="SmartDelicious">
        
    </div>

    <div class="input-Area">
    <form method="post" action="newMemberInsert.php">
        

        <div class="register-info">登録情報を入力</div>

        <div class="inline-block"><input type="email" class="textbox" name="email" placeholder="メールアドレス"></div>
        <div class="inline-block"><input type="password" class="textbox" name="password" placeholder="パスワード"></div>
        <div class="inline-block"><input type="text" class="textbox" name="username" placeholder="ユーザー名"></div>

    </div>

    <div class="button-Area">
        <a href="#"><button class="button">戻る</button></a>
        <input type="submit" class="button" value="登録">
    </div>
</form>
</center>
    
    <!-- /この中に要素を追加 -->

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