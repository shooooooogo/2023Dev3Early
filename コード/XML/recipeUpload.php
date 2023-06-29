<?php
    require_once '../DAO.php';
    $dao = new DAO();

    $dao->recipeUpload($_POST['recipe_id']);

?>