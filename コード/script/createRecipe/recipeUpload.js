
function recipeUpload(recipe_id) {
    let uploadOpinion = window.confirm('ボタンをクリックしてください');
    if(uploadOpinion){
        var xhr = new XMLHttpRequest();
        xhr.open("POST","../../XML/recipeUpload.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("recipe_id=" + encodeURIComponent(recipe_id));
    }
}