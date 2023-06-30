<!-- ほぼ完成 -->
<?php
require_once 'DAO.php';
$dao = new DAO();
$searchRecipe = $dao->recipeSearch($_POST['recipe_name']);
foreach($searchRecipe as $row){
    // $img = base64_encode($row['recipe_image']);
    // echo "<img src=data:images/png;base64,".$img.">";
    $img = $row['recipe_image'];
    echo "<p><img src=$img></p>";
    echo "<p>$row[recipe_name]</p>";
    echo "<p>$row[recipe_introduction]</p>";
        // header("Location: ");
        // exit();
}
?>