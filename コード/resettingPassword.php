<!DOCTYPE html>
    <html lang="ja">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- cssの導入 -->
      <link rel="stylesheet" href="./css/style.css?v=2">
      <link rel="stylesheet" href="./css/resettingPassword.css">
          <!-- javascriptの導入 -->
    <script src="./script/script.js"></script>
    
    <!-- bootstrapのCSSの導入 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <title>パスワードの再設定画面</title>


    </head>

    <body>
    <img class="resettingPasswordlogo" src="img/SumaDeliIcon.png" alt="ロゴです">
    <form action="resettingPassMailInsert.php" method="post">
      <div class="container">
        <div class="child" style="text-align:center">
          <div class="container d-flex flex-column justify-content-center align-items-center mt-auto mb-auto">
            <div class="fontMeiryo">
              <p class="changepassword">パスワードの再設定</p>
              <p class="changetext">・メールアドレス</p>
          <input type="email" name="passmail" value="" class="textbox" placeholder="既存メールアドレス">
              <p class="pass">・前のパスワード</p>
              <input type="password" name="beforepassword" value="" class="textbox" placeholder="既存パスワード">
              <p class="pass new-pass">・新しいパスワード</p>
              <input type="password" name="afterpassword" value="" class="textbox" placeholder="新規パスワード"><br>
              <input type="submit" value="変更する" class="changebutton">
            </div>
          </div>
        </div>
      </div>
    </form>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    </html>
    
    <!-- cssの導入 -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <!-- <link rel="stylesheet" href="css/resettingMailaddress.css"> -->

    <!-- javascriptの導入 -->
    <!-- <script src="./script/script.js"></script> -->
    
    <!-- bootstrapのCSSの導入 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    
<!-- <form action="home.php" method="post">
  <div class="container">
<div class="child" style="text-align:center"> -->
  <!-- <div class="container d-flex flex-column justify-content-center align-items-center mt-auto mb-auto"> -->
    <!-- <p>メールアドレスの再設定</p>
    <p class="mb-2">・前のメールアドレス</p>
    <p><input type="text" name="beforeMail" value=""></p>
    <p class="mb-2">・新しいメールアドレス</p>
    <p><input type="text" name="afterMail" value=""></p>
    <p><input type="submit" value="変更する" class="btn btn-warning"></p> -->
    <!-- </div> -->
  <!-- </div>
</div>
</form> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> -->


    <!-- <div class="fontMeiryoBold" style="text-align:center">
       <div class="container d-flex flex-column justify-content-center align-items-center mt-auto mb-auto"> 
        <p>メールアドレスの再設定</p>
         <p class="mb-2">・前のメールアドレス</p>
          <input type="text" name="beforeMail" value="" class="form-control mb-2"> 
          <p class="mb-2">・新しいメールアドレス</p> 
          <input type="text" name="afterMail" value="" class="form-control mb-2"> 
          <input type="submit" value="変更する" class="btn btn-warning">
         </div>
         </div> -->