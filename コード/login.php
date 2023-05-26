<!-- このコードはすべて上村によって書かれています。
上村の許可を得ずソースに変更を加えたり自作発言等上村に不利益が生じる場合
ソース破損罪または迷惑罪にあたり罰せられる可能性があります -->

<!DOCTYPE html>
<html lang="Ja">
<head>

    <!-- cssの導入 なんかわからんけど読み込めてなさそう-->
    <link rel="stylesheet" href="css/style.css?v=2">

    <!-- 拡大縮小禁止するよん -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>

    <!-- このページのstyleをここに記す -->
    <style>
        .kyouchou{color:red;text-decoration:none;}
        .btn{border:none;background-color:#FF7800;border-radius:5px}
        .toplogo{width: 200px;}

    </style>


    


    <!-- DB接続するであろうコード -->

    
</head>
<body>
    <center>
        <img class="toplogo" src="img/SumaDeliIcon.png" alt="ロゴじゃい"/>

        <b><p>ログイン</p></b>
        

        <form method="post" action="top.php">
            <input type="email" name="mail" placeholder=" メールアドレス"><br>
            <input type="password" name="password" placeholder=" パスワード"><br><br>
            <input type="submit" value="ログイン" class="btn"><br>
        </form>

        <br>

        <p>パスワードを忘れた方は<a class="kyouchou" href="resettingPassword.php">こちら</a></p><br>
        

        <a href="newMember.php" ><input type="button" class="btn" value="新規登録"></a>




    </center>
</body>
</html>