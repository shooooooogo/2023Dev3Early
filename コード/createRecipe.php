<?php
session_start();
if(isset($_SESSION['id']) == false  &&
     isset($_SESSION['name']) == false ){
        header('Location: login.php');
        exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピを作成</title>
    <!-- cssの導入 -->
    <link rel="stylesheet" href="css/style.css?v=2">

    <!-- javascriptの導入 -->
    <script src="./script/script.js"></script>
    
    <!-- bootstrapのCSSの導入 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- 検索ボックス導入のためのcss -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- header導入のためのcss -->
    <!-- <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css"> -->
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/css/5-1-14.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">

    <!-- 個別cssの読み込み場所 -->
    <link rel="stylesheet" href="css/createRecipe.css">

    <?php
        //DAOの呼び出し
        require_once 'DAO.php';
        $dao = new DAO();

        //マイページなので、セッションのidを利用して自分のユーザ情報を検索
        $userdata = $dao->selectUser($_SESSION['id']);
        $user_prefecture = $dao->selectPrefecture($userdata['prefecture_id']);

    ?>
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
                        <?php
                            echo"
                                <img class='col-3 img-fluid' id='iconsize' src='".$userdata['user_icon']."'>
                                <h3 class='col-6 text-start ml-3 pt-2' style='text-decoration: none; color: #333333;'>".$userdata['user_name']."</h3>
                            ";
                        ?>
                    </a>
                </div>


                <!-- 虫眼鏡付きの検索ボックス -->
                <li class="text-start">
                    <form action="searchResult.php" method="post" class="search_container">
                        <input type="text" size="15" placeholder="料理名・食材名">
                        <input type="submit" value="&#xf002">
                    </form>
                </li>
                <div class="mt-3" style="border-bottom: 1px solid #ff7800;"></div>
                <li><a href="top.php">Top画面</a></li>
                <li><a href="ranking.php">ランキング</a></li>
                <li><a href="myPage.php">マイページ</a></li>
                <li><a href="createRecipe.php">レシピを作る</a></li>
            </ul>            
        </div>
    </nav>

    <!-- このdivの中に要素を書き込んでください -->
    <!-- ※注意！クラス名やcss等個々の中に関連する物をいじる場合はjavascriptも同期できるようにコーディングしてください -->
    <div class="container-fluid elements">
        
        <!-- 見出し -->
        <div class="text-center" style="margin: 50px 0px 50px 0px;">
            <p style="font-size: 32px;font-weight:bold;">レシピ作成</p>
        </div>
        <form class="row" method="post" action="createRecipeRemind.php" enctype="multipart/form-data">
        
            <!-- レシピのタイトル -->
            <span class="mb-5">
                <h1  class="ms-2" style="margin-top:10px;">・レシピのタイトル</h1>
                <input class="textInput col-11 ms-3" type="text" name="recipe_name" placeholder="(例)さばの味噌煮" required>
            </span>

            <!-- サムネイル画像 -->
            <span class="row mb-5">
                <h1 class="mt-3 ms-2"style="margin-top:10px;">・サムネイル</h1>
                <!-- 追加された画像を表示する物 -->
                <div class="mb-3" id="preview"></div>

                <!-- 画像追加のinputタグ -->
                <div class="text-center mt-3">
                <input class="inputs suggestButton noneDisplay" type="file" name="recipe_image" id="recipe_image">
                <input type="button" class=" offset-3 col-6 suggestButton" onclick="document.getElementById('recipe_image').click()" value="アップロード" style="text-align:center;">
                </div>
                
                
            </span>
        
            <!-- 紹介文 -->
            <span class="mb-5">
                <h1 class="ms-2"style="margin-top:10px;">・紹介文</h1>
                <input class="textInput col-11 ms-3" type="text" name="recipe_intro" placeholder="ここに紹介文を入力してください">
            </span>
        
            <!-- 材料 -->
            <span>

                <h1 class="ms-2"style="margin-top:10px;">・材料</h1>
                
                <!-- 材料の個数を数えて送るタグ -->
                <input type="hidden" id="materialNumber" name="materialNumber" value=1>
                
                <!-- 何人前？ -->
                <input class="textInput mb-4 col-11 ms-3" type="text" name="recipe_people" placeholder="何人前" required>
            </span>
            
            <!-- 余裕あれば追加した材料入力欄を消せる機能を追加したい -->
            <!-- 材料の入力フォームを追加するボタン -->
            <span class="text-center" id="addMaterial" name="addMaterialButton" onclick="addMaterial()">+  材料入力欄を一つ追加する</span>

            <!-- 材料の入力フォーム -->
            <span id="addMaterialSpan">
                <span id="Material_1">
                    <p class="materialNumber ms-3">材料1</p>
                    <input class="textInput col-5 ms-3" type="text" name="materialName[]" placeholder="材料名" required>
                    <input class="textInput col-5 offset-1" type="text" name="materialQuantity[]" placeholder="分量" required>
                    <input class="textInput col-11 ms-3" type="number" name="materialCost[]" placeholder="材料の費用" required>
                </span>
            </span>
            <div class="mb-5">
                <p class="deleteMaterial text-center" onclick="deleteMaterial()">-材料入力欄を一つ削除する</p>
            </div>
           
            
            <!-- 作り方 -->
            <span class="mb-5" id="addHowToSpan">
                <h1 class="ms-3"style="margin-top:10px;">・作り方</h1>
                
                <!-- 作り方の数を数えて送るタグ -->
                <input type="hidden" id="howToNumber" name="howToNumber" value=1>

                <p class="text-center" onclick="add()">+手順入力欄を一つ追加する</p>
                
                <div class="How_To">
                    <div class="row" id="How_To1">
                        <p class=" HowToNumber ms-3">手順1</p>
                        <!-- 追加された画像を表示する物 -->
                        <span class="How_To_preview  offset-1 col-3" id="How_To_preview1">
                            <input type="file" class="file-input noneDisplay" name="How_To_image[]" id="How_To_image1" onchange='handleFileSelectHowTo("How_To_image1","image1")'>
                            <img src="img/How_To_Default.png" class="HowToImg" id="image1" alt="Image" onclick="document.getElementById('How_To_image1').click()">
                        </span>
                        <span class="offset-2 col-3">
                            <textarea class="border" name="HowTo[]" id="How_To_Text1" cols="20" rows="4" maxlength="60" placeholder="60文字の制限があります"></textarea>
                        </span>
                    </div>
                </div>
                <div>
                    <p class="deleteHowTo text-center" onclick="deleteHowTo()">-手順を一つ削除する</p>
                </div>
                
                
            </span>

            <!-- 時間帯 -->
            <div class="mb-5" style="text-align: center;">
                <h1>時間帯(以下の内から選択)</h1><br>
                <label class="selectbox-005">
                    <select class="select" name="time_zone_id" style="text-align: center;" required>
                        <option value="" hidden>選択してください</option>
                        <option value="0">時間帯を指定しない</option>
                        <option value="1">朝食</option>
                        <option value="2">昼食</option>
                        <option value="3">夕食</option>
                        <option value="4">おやつ</option>
                    </select>
                </label>
            </div>

            <!-- ジャンル -->
            <div class="mb-5" style="text-align: center;">
                <h1>ジャンル</h1><br>
                <label class="selectbox-005">
                    <select class="select" name="genre_id" style="text-align: center;">
                        <?php
                            $genres = $dao->selectAllGenre();
                            echo "<option value='' hidden>選択してください</option>";
                            foreach ($genres as $genre) {
                                echo"<option value='".$genre['genre_id']."'>".$genre['genre_name']."</option>";
                            }
                                                
                        ?>
                    </select>
                </label>
            </div>


            <!-- 都道府県 -->
            <div class="mb-5" style="text-align: center;">
                <h1>都道府県</h1><br>
                <label class="selectbox-005">
                    <select class="select" name="prefecture_id" style="text-align: center;">
                        <option value="" hidden>選択してください</option>
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
                </label>
            </div>
            
            <input type="submit" class="suggestButton mt-3 mb-5" style="margin: auto;margin-top:10px" value="登録する">

        </form>
        <br>
        

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
    <br><br><br>
    <footer class="text-center">
    <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-4" style="color: black;text-decoration: none;"><i class="bi bi-house-fill" style="margin-left:10%;font-size:40px"></i></a>
            <a href="myPage.php" class="col-4"style="color: black;text-decoration: none;"><i class="bi bi-person-circle" style="font-size:40px"></i></a>
            <a href="createRecipe.php" class="col-4"style="color: #FF7800;text-decoration: none;"><i class="bi bi-journal-check" style="margin-right:10%;font-size:40px"></i></a>
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

    <!-- 固有のjs -->
    <script src="script/createRecipe/addMaterial.js"></script>
    <script src="script/createRecipe/addHowTo.js"></script>
    <script src="script/createRecipe/addRecipe_Image.js"></script>
</body>
</html>