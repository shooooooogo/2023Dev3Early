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

    
     <?php
        //DAOの呼び出し
        require_once 'DAO.php';
        $dao = new DAO();

        //マイページなので、セッションのidを利用して自分のユーザ情報を検索
        $userdata = $dao->selectUser($_SESSION['id']);

        var_dump($userdata);


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

    <!-- この中に要素を追加 -->

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
                    <a href="myPage.php" class="row ml-5 noDecoration">
                        <img class="col-3 img-fluid" src="img/UserIcon_default.png">
                        <h3 class="col-6 text-start ml-3 pt-2 text-black">ユーザ名</h3>
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

       <div class="user">
        <!-- ユーザートップ ($userdataを用いて、各種情報を表示する) -->
        <div class="user-top">
            <img src="<?php echo $userdata['user_icon'] ?>" alt="アイコン" class="user-icon">
            <h1 class="user-name"><?php echo $userdata['user_name'] ?></h1>
            <div class="user-setting">
                <a href="setting.php" style="color: black;">
                    <i class="bi bi-gear-fill"></i>
                </a>
            </div>
        </div>

        <!-- ユーザー情報 -->
        <div class="user-info">
            <!-- 所在地　県名 -->
            <p class="prefecture user-info-text">
                <?php
                    if(empty($userdata['prefecture_id'])){//県に関する情報がnullもしくは0か
                        echo "所在地不明";
                    }else {
                        $prefecture = $dao->selectPrefecture($userdata['prefecture_id']);
                        echo $prefecture['prefecture_name'];
                    }
                ?>
            </p>

            <!-- フォロー人数 -->
            <p class="follow user-info-text">
                <span class="user-info-text-bold">
                    <?php
                        $followCount = $dao->countFollowers($_SESSION['id']);
                        echo "フォロー　：".number_format($followCount[0])."人";
                    ?>
                </span>
            </p>
            <!-- フォロワー人数 -->
            <p class="follow user-info-text">
                <span class="user-info-text-bold">
                    <?php
                        $followerCount = $dao->countFollows($_SESSION['id']);
                        echo "フォロワー：".number_format($followerCount[0])."人";
                    ?>
                </span>
            </p>
            <!-- テキストエリアでは変更できてしまうため、pタグに変えました。　石川 -->
            <p name="#" class="introduction user-info-text-bold">
                <?php
                    echo "紹介文:<br>".$userdata['user_introduction'];
                ?>
            </p>
            <!-- <textarea name="#" class="introduction user-info-text" cols="40" row="3">ここにユーザーの紹介文を表示</textarea> -->
        </div>
    </div>

    <!-- ログインまたは新規登録 -->
    <h1 class="user-register">
            <a href="./newRegister.php" class="user-register-link">新規登録</a>
            または<p class="user-register-link" onclick="if(confirm('ログアウトしますか？')){window.location.href = 'logout.php';}">ログイン</p>
            <!-- <a href="./login.php" class="user-register-link" onclick="comfirm('ログアウトしますか？')">ログイン</a> -->
    </h1>

    <div class="myPage-content">
        <!-- タブ -->
        <ul class="myPage-content-tab">
            <!-- いいねのコンテンツ -->
            <li class="myPage-content-tablist likestab is-active" data-target="likes">いいね</li>

            <!-- お気に入りのコンテンツ -->
            <li class="myPage-content-tablist favoritestab" data-target="fovorites">お気に入り</li>

            <!-- 投稿済みのコンテンツ -->
            <li class="myPage-content-tablist postedtab" data-target="posted">投稿済み</li>

            <!-- 下書きのコンテンツ -->
            <li class="myPage-content-tablist draftstab" data-target="drafts">下書き</li>
        </ul>

        <div class="pane-group">
            <div class="scrollRange">
                    <!-- いいねタブの中 -->
                    <div id="likesTab" class="panel likestab is-show">
                        <!-- 各タブの中の投稿内容ここから -->
                        
                        <!-- <div class="div-underline">
                            <a href="dishDetail.php" style="color: black;text-decoration: none;">
                            <div class="myPage-content-posts">
                                <div class="myPage-content-posted">
                                    <img src="./img/PepperRice.png" alt="投稿写真" class="post-image">
                                        <div class="post-image-float">
                                            <div class="post-text-name">いいねペッパーライス</div>
                                            <div class="post-text-budget">予算　9,999円</div>
                                        </div>
                                        <div class="post-like">
                                            <i class="bi bi-hand-thumbs-up">9,999</i>
                                            <i class="bi bi-bookmark-star verylike">9,999</i>
                                        </div>
                                </div>
                            </div>
                            </a>
                            <div class="post-underline"></div>
                        </div> -->
                        
                        <!-- 各タブの投稿内容ここまで -->

                        <?php

                            $selectGR = $dao->selectGoodRecipes($_SESSION['id']);

                            foreach ($selectGR as $row) {

                                echo "<div class='div-underline'>
                                <div class='myPage-content-posts'>
                                    <div class='myPage-content-posted'>
                                        <img src='".$row['recipe_image']."' alt='投稿写真' class='post-image'>
                                        <div class='post-image-float'>
                                            <div class='post-text-name'>".$row['recipe_name']."</div>
                                            <div class='post-text-budget'>予算　".$row['sumCost']."円</div>
                                        </div>
                                        <div class='post-like'>
                                        <i class='bi bi-hand-thumbs-up'>".$row['goodCount']."</i>
                                        <i class='bi bi-bookmark-star verylike'>".$row['favoriteCount']."</i>
                                        </div>
                                    </div>
                                </div>
                                <div class='post-underline'></div>
                            </div>";       

                                
                            }

                        ?>



                    <!-- </div>       -->
                    <br><br></div>      
                    <!-- // いいねタブの中 -->

                    <!-- お気に入りタブの中 -->
                    <div id="favoritesTab" class="panel favoritestab">
                        <!-- 各タブの中の投稿内容ここから -->
                        <div class="div-underline">
                        
                        <!-- <div class="myPage-content-posts">
                                <div class="myPage-content-posted">
                                    <img src="./img/PepperRice.png" alt="投稿写真" class="post-image">
                                        <div class="post-image-float">
                                            <div class="post-text-name">お気に入りペッパーライス</div>
                                            <div class="post-text-budget">予算　9,999円</div>
                                        </div>
                                        <div class="post-like">
                                            <i class="bi bi-hand-thumbs-up">9,999</i>
                                            <i class="bi bi-bookmark-star verylike">9,999</i>
                                        </div>
                                </div>
                            </div>
                        <div class="post-underline"></div> -->
                    
                        <?php

                            $selectFR = $dao->selectFavoriteRecipes($_SESSION['id']);

                            foreach ($selectFR as $row) {

                                echo "<div class='div-underline'>
                                <div class='myPage-content-posts'>
                                    <div class='myPage-content-posted'>
                                        <img src='".$row['recipe_image']."' alt='投稿写真' class='post-image'>
                                        <div class='post-image-float'>
                                            <div class='post-text-name'>".$row['recipe_name']."</div>
                                            <div class='post-text-budget'>予算　".$row['sumCost']."円</div>
                                        </div>
                                        <div class='post-like'>
                                            <i class='bi bi-hand-thumbs-up'>".$row['goodCount']."</i>
                                            <i class='bi bi-bookmark-star verylike'>".$row['favoriteCount']."</i>
                                        </div>
                                    </div>
                                </div>
                                <div class='post-underline'></div>
                            </div>";       

                                
                            }

                        ?>
                        
                        </div>
                        <!-- 各タブの投稿内容ここまで -->

                        
                        
                    <br><br></div>      
                    <!-- // いいねタブの中 -->
                
                    <!-- 投稿済みタブの中 -->
                    <div id="postedTab" class="panel postedtab">
                    
                    <!-- 各タブの中の投稿内容ここから -->
                        <div class="div-underline">
                            
                            <!-- <div class="myPage-content-posts">
                                <div class="myPage-content-posted">
                                    <img src="./img/PepperRice.png" alt="投稿写真" class="post-image">
                                        <div class="post-image-float">
                                            <div class="post-text-name">投稿済みペッパーライス</div>
                                            <div class="post-text-budget">予算　9,999円</div>
                                        </div>
                                        <div class="post-like">
                                            <i class="bi bi-hand-thumbs-up">9,999</i>
                                            <i class="bi bi-bookmark-star verylike">9,999</i>
                                        </div>
                                </div>
                            </div>
                            <div class="post-underline"></div> -->
                        
                            <?php
                            $selectUR = $dao->selectUploadRecipes($_SESSION['id']);

                            foreach ($selectUR as $row) {

                                echo "<div class='div-underline'>
                                <div class='myPage-content-posts'>
                                    <div class='myPage-content-posted'>
                                        <img src='".$row['recipe_image']."' alt='投稿写真' class='post-image'>
                                        <div class='post-image-float'>
                                            <div class='post-text-name'>".$row['recipe_name']."</div>
                                            <div class='post-text-budget'>予算　".$row['sumCost']."円</div>
                                        </div>
                                        <div class='post-like'>
                                            <i class='bi bi-hand-thumbs-up'>".$row['goodCount']."</i>
                                            <i class='bi bi-bookmark-star verylike'>".$row['favoriteCount']."</i>
                                        </div>
                                    </div>
                                </div>
                                <div class='post-underline'></div>
                            </div>";       

                                
                            }

                            ?>                            
                        
                        </div>
                        <!-- 各タブの投稿内容ここまで -->
                    
                        

                        <br><br></div>
                    <!-- // 投稿済みタブの中 -->

                     <!-- 下書きタブの中 -->
                    <!-- 各タブの中の投稿内容ここから -->
                    
                    <div id="draftsTab" class="panel draftstab">
                        <div class="div-underline">
                            <div class="myPage-content-posts">
                                <div class="myPage-content-posted">
                                    <img src="./img/PepperRice.png" alt="投稿写真" class="post-image">
                                        <div class="post-image-float">
                                            <div class="post-text-name">下書きペッパーライス</div>
                                            <div class="post-text-budget">予算　9,999円</div>
                                        </div>
                                        <div class="post-like">
                                            <i class="bi bi-hand-thumbs-up">9,999</i>
                                            <i class="bi bi-bookmark-star verylike">9,999</i>
                                        </div>
                                </div>
                            </div>
                            <div class="post-underline"></div>
                        

                            <?php

                            $selectDR = $dao->selectDraftRecipes($_SESSION['id']);

                            foreach ($selectDR as $row) {

                                echo "<div class='div-underline'>
                                    <div class='myPage-content-posts'>
                                        <div class='myPage-content-posted'>
                                            <img src='".$row['recipe_image']."' alt='投稿写真' class='post-image'>
                                            <div class='post-image-float'>
                                                <div class='post-text-name'>".$row['recipe_name']."</div>
                                                <div class='post-text-budget'>予算　".$row['sumCost']."円</div>
                                            </div>
                                            <div class='post-like'>
                                                <i class='bi bi-hand-thumbs-up'>".$row['goodCount']."</i>
                                                <i class='bi bi-bookmark-star verylike'>".$row['favoriteCount']."</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='post-underline'></div>
                                </div>";       

                                
                            }

                            ?>
                        
                    </div>
                    
                        <!-- 各タブの投稿内容ここまで -->
                    
                    
                        
                    
                        <br><br></div>
                    <!-- // 下書きタブの中 -->
            </div>
            
        </div>
    </div>
    <!-- /この中に要素を追加 -->


    <!-- 下のナビゲーションバー -->
    <br><br><br><br><br>
    <footer class="text-center">
        <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-4" style="color: black;text-decoration: none;"><i class="bi bi-house-fill" style="margin-left:10%;font-size:40px"></i></a>
            <a href="mypage.php" class="col-4"style="color: #FF7800;text-decoration: none;"><i class="bi bi-person-circle" style="font-size:40px"></i></a>
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

    <!-- このページのJs -->
    <script src="script/myPage.js"></script>
</body>
</html>