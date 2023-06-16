<!DOCTYPE html>
    <html lang="ja">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- cssの導入 -->
      <link rel="stylesheet" href="./css/style.css?v=2">
      <link rel="stylesheet" href="./css/resettingMailaddress.css">
          <!-- javascriptの導入 -->
    <script src="./script/script.js"></script>
    
    <!-- bootstrapのCSSの導入 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <title>設定画面</title>
    </head>

    <body>
    <!-- <img class="resettingMailaddresslogo" src="img/SumaDeliIcon.png" alt="ロゴです"> -->

    
      <div class="container">
      <div class="child" style="text-align:center">
        <div class="container d-flex flex-column justify-content-center align-items-center mt-auto mb-auto">
          <!-- <div class="mailaddress">メールアドレスの再設定</div> -->

          <form action="change_user_name.php" method="post">
          <p class="changetext">・ユーザー名</p>
          <p><input type="text" name="Chenge_user_name" value="" class="textbox" placeholder="例：麻生太郎"></p>
          <p><input type="submit" value="ユーザー名を設定する" class="changeButton"></p>
          </form>

          <form action="introduction.php" method="post">
          <p class="changetext">・紹介文</p>
          <p><input type="text" name="Change_introduction" value="" class="textbox" placeholder="例：よろしくお願いします。"></p>
          <p><input type="submit" value="紹介文を設定する" class="changeButton"></p>
          </form>

          <form action="DAO.php" method="post" enctype="multipart/form-data">
          <p class="changetext">・アイコン</p>
          <input type="file" name="icon" />
          <div id="preview"></div>
          <?php
          require_once 'DAO.php';
          $dao = new DAO();
          // $result_icon = $dao->display_the_icon();
          // foreach($result_icon as $row){
          //     $img = base64_encode($row['user_icon']);
          //     echo "<img src=data:images/png;base64,".$img.">";
          // }
          ?>
          <input type="submit" value="変更する" class="changeButton">
          </form>

          <form action="change_prefecture.php" method="post">
          <p class="changetext">・都道府県</p>
          <p><select name="change_user_prefecture">
                    <option value="0">県を指定しない</option>
                    <option value="1">北海道</option>
                    <option value="2">青森県</option>
                    <option value="3">岩手県</option>
                    <option value="4">宮城県</option>
                    <option value="5">秋田県</option>
                    <option value="6">山形県</option>
                    <option value="7">福島県</option>
                    <option value="8">茨城県</option>
                    <option value="9">栃木県</option>
                    <option value="10">群馬県</option>
                    <option value="11">埼玉県</option>
                    <option value="12">千葉県</option>
                    <option value="13">東京都</option>
                    <option value="14">神奈川県</option>
                    <option value="15">新潟県</option>
                    <option value="16">富山県</option>
                    <option value="17">石川県</option>
                    <option value="18">福井県</option>
                    <option value="19">山梨県</option>
                    <option value="20">長野県</option>
                    <option value="21">岐阜県</option>
                    <option value="22">静岡県</option>
                    <option value="23">愛知県</option>
                    <option value="24">三重県</option>
                    <option value="25">滋賀県</option>
                    <option value="26">京都府</option>
                    <option value="27">大阪府</option>
                    <option value="28">兵庫県</option>
                    <option value="29">奈良県</option>
                    <option value="30">和歌山県</option>
                    <option value="31">鳥取県</option>
                    <option value="32">島根県</option>
                    <option value="33">岡山県</option>
                    <option value="34">広島県</option>
                    <option value="35">山口県</option>
                    <option value="36">徳島県</option>
                    <option value="37">香川県</option>
                    <option value="38">愛媛県</option>
                    <option value="39">高知県</option>
                    <option value="40">福岡県</option>
                    <option value="41">佐賀県</option>
                    <option value="42">長崎県</option>
                    <option value="43">熊本県</option>
                    <option value="44">大分県</option>
                    <option value="45">宮崎県</option>
                    <option value="46">鹿児島県</option>
                    <option value="47">沖縄県</option>
                </select>
                </p>
          <input type="submit" value="変更を確定する" class="changeButton">
          </form>

          <p class="changetext">・メールアドレスの変更は<a href="resettingMailaddress.php">こちら</a></p>
          <p class="changetext">・パスワードの変更は<a href="resettingPassword.php">こちら</a></p>

          <form action="logout.php" method="post">
          <input type="submit" value="ログアウト" class="changeButton">
          </form>

            </div>
          </div>
      </div>
    
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    </html>