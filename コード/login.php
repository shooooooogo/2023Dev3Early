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
        .loginlabel{font-size: 25px;margin: 70px 0 40px;font-family: Meiryo;}
        .textbox{width: 267px;margin: 15px 0;padding: 5px;font-size: 15px;text-align: center;border: 1px solid #ccc;border-radius: 5px;background-color: #4b49496b;}
        .kyouchou{color:red;text-decoration:none;}
        /* .btn{border:none;background-color:#FF7800;border-radius:5px} */
        .btn{
            width: 267px;
            padding: 15px;
            font-size: 20px;
            color: #000;
            font-family: "Meiryo";
            /* border: 0.5px solid #696969; */border: none;
            border-radius: 5px;
            background-color: #FF7800;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .toplogo{width: 200px;margin-top:20px;}
        .space{margin-top: 20px;}

    </style>


    


    <!-- DB接続するであろうコード -->

    
</head>
<body>
    <center>
        <img class="toplogo" src="img/SumaDeliIcon.png" alt="ロゴじゃい"/>

        <!-- <h1 class="loginlabel">ログイン</h1> -->
        <div class="loginlabel">ログイン</div>
        

        <form method="post" action="login_check.php">
            <input class="textbox" type="email" name="mail" placeholder=" メールアドレス"><br>
            <input class="textbox" type="password" name="password" placeholder=" パスワード"><br><br>
            <div class="space"></div>
            <input type="submit" value="ログイン" class="btn"><br>
        </form>

        <br>

        <p>パスワードを忘れた方は<a class="kyouchou" href="resettingPassword.php">こちら</a></p><br>
        

        <a href="newRegister.php" ><input type="button" class="btn" value="新規登録"></a>




    </center>
</body>
</html>

<?php
session_start();
if(isset($_SESSION['id']) == true  &&
     isset($_SESSION['name']) == true ){
        header('Location: top.php');
        exit();
}
?>