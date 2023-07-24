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

        <!--  ランキング画面の自動横スクcss -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-1.css">

    <!-- この画面のcss-->
    <link rel="stylesheet" href="./css/top.css">

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
            <a href="top.php"><img class="logo" src="img/SumaDeliIcon.png"  alt="スマデリ"></a>
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
                <!-- <div class="text-center mb-3">
                    <a href="top.php"><img class="logo" src="img/SumaDeliIcon.png" alt="スマデリ"></a>
                </div> -->
                
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
                <div class="mt-3" style="border-bottom: 1px solid #ff7800;"></div>
                <li><a href="top.php">Top画面</a></li>  
                <li><a href="ranking.php">ランキング</a></li>  
                <li><a href="mypage.php">マイページ</a></li>
                <li><a href="createRecipe.php">レシピを作る</a></li>
                
               
            </ul>            
        </div>
    </nav>

    <!-- この中に要素を追加 -->
    <div class="ranking">
    <ul class="slider">

        <li class="slider-item slider-item01">
            <a style="color: #FF7800;text-decoration: none; text-align: center;" 
                    href="ranking.php?ver=1">
                    総合ランキング
            </a>
            <?php
                $allRankingData = $dao->selectAllRanking();
                if(count($allRankingData)>=5){
                    for($i=0; $i<5; $i++){
                        echo 
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".($i+1)."位</h3>
                            <image class='col-3 img-fluid' src='".$allRankingData[$i]['recipe_image']."' >
                            <h3 class='col-6'>".$allRankingData[$i]['goodCount']."ポイント</h3>
                        </div>";
                    }
                }else{
                    $i = 1;
                    foreach ($allRankingData as $allRanking) {
                    
                        echo 
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".$i."位</h3>
                            <image class='col-3' src='".$allRanking['recipe_image']."' style='height:80px'>
                            <h3 class='offset-1 col-5'>".$allRanking['goodCount']."ポイント</h3>
                        </div>";
                        $i++;
                        if($i>5){
                            break;
                        }
                    }
                }

            ?>
            <a style="color: #FF7800;text-decoration: none; text-align: center;" 
                    href="ranking.php?ver=1">
                    ランキングの詳細はこちら
            </a>

        </li>

        <li class="slider-item slider-item02" href="momentRanking.php">
            <a style="color: #FF7800;text-decoration: none; text-align: center;" 
                    href="ranking.php?ver=2">
                    瞬間ランキング
            </a>
            <?php
                $MRData = $dao->selectMomentRanking();
                if(count($allRankingData)>=5){
                    for($k=0; $k<5; $k++){
                        echo 
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".($k+1)."位</h3>
                            <image class='col-3' src='".$allRankingData[$k]['recipe_image']."' style='height:80px'>
                            <h3 class='col-6'>".$allRankingData[$k]['goodCount']."ポイント</h3>
                        </div>";
                    }
                }else{
                    $k = 1;
                    foreach ($allRankingData as $allRanking) {
                    
                        echo 
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".$k."位</h3>
                            <image class='col-3' src='".$allRanking['recipe_image']."' style='height:80px'>
                            <h3 class='offset-1 col-5'>".$allRanking['goodCount']."ポイント</h3>
                        </div>";
                        $k++;
                        if($k>5){
                            break;
                        }
                    }
                }

            ?>

            <a style="color: #FF7800;text-decoration: none; text-align: center;" 
                    href="ranking.php?ver=2">
                    ランキングの詳細はこちら
            </a>
        </li>
        <?php
        $user_prefecture;
        if(!empty($userdata['prefecture_id'])){
            echo 
            "<li class='slider-item slider-item03' href='prefectureOverallRanking.php'>
                <a style='color: #FF7800;text-decoration: none; text-align: center;'
                    href='overallRanking.php?ver=3'>
                    ".$user_prefecture['prefecture_name']."総合ランキング
                </a>";

                $PARData = $dao->selectPrefectureAllRanking($userdata['prefecture_id']);

                if(count($MRData)>=5){
                    for($j=0; $j<5; $j++){
                        echo 
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".($j+1)."位</h3>
                            <image class='col-3' src='".$PARData[$j]['recipe_image']."' style='height:80px'>
                            <h3 class='col-6'>".$PARData[$j]['goodCount']."ポイント</h3>
                        </div>";
                    }
                }else{
                    $j = 1;
                    foreach ($PARData as $PAR) {
                        
                        echo 
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".$j."位</h3>
                            <image class='col-3' src='".$PAR['recipe_image']."' style='height:80px'>
                            <h3 class='offset-1 col-5'>".$PAR['goodCount']."ポイント</h3>
                        </div>";
                        $j++;
                        if($j>5){
                            break;
                        }
                    }
                }



            echo 
                "<a style='color: #FF7800;text-decoration: none; text-align: center;' 
                href='ranking.php?ver=3'>
                    ランキングの詳細はこちら
                </a>
            </li>
            <li class='slider-item slider-item03' href='prefectureOverallRanking.php'>
                <a style='color: #FF7800;text-decoration: none; text-align: center;'
                        href='ranking.php?ver=4'>
                        ".$user_prefecture['prefecture_name']."瞬間ランキング
                </a>";

                $PMRData = $dao->selectPrefectureMomentRanking($userdata['prefecture_id']);

                if(count($MRData)>=5){
                    for($l=0; $l<5; $l++){
                        echo 
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".($l+1)."位</h3>
                            <image class='col-3' src='".$PMRData[$l]['recipe_image']."' style='height:80px'>
                            <h3 class='col-6'>".$PMRData[$l]['goodCount']."ポイント</h3>
                        </div>";
                    }
                }else{
                    $l = 1;
                    foreach ($PMRData as $PMR) {
                        
                        echo
                        "<div class='ranking-content row' style='margin:5px'>
                            <h3 class='col-2'>".$l."位</h3>
                            <image class='col-3' src='".$PMR['recipe_image']."' style='height:80px'>
                            <h3 class='offset-1 col-5'>".$PMR['goodCount']."ポイント</h3>
                        </div>";
                        $l++;
                        if($l>5){
                            break;
                        }
                    }
                }
        
            echo
                "<a style='color: #FF7800;text-decoration: none; text-align: center;' 
                href='ranking.php?ver=4'>
                    ランキングの詳細はこちら
                </a>
            </li>";
            
        
        
        }
        ?>

        
        

</div>

<div class="proposalButton">
        <a href="suggestRecipe.php"><button class="suggestButton">提案</button></a>
</div>


    <!-- /この中に要素を追加 -->


    <!-- 下のナビゲーションバー -->
    <br><br><br><br><br>
    <footer class="text-center">
        <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-4" style="color: #FF7800;text-decoration: none; padding:3%"><i class="bi bi-house-fill" style="margin-left:20%;font-size:40px"></i></a>
            <a href="myPage.php" class="col-4"style="color: black;text-decoration: none; padding:3%"><i class="bi bi-person-circle" style="font-size:40px"></i></a>
            <a href="createRecipe.php" class="col-4"style="color: black;text-decoration: none; padding:3%"><i class="bi bi-journal-check" style="margin-right:20%;font-size:40px"></i></a>
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

        <!--  ランキング画面の自動横スクjs -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="js/6-1-1.js"></script>

    <!-- この画面のjs -->
    <script src="script/top.js"></script>
</body>
</html>