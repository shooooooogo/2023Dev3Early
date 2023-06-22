let howToCount = 1;//作り方の数を記録する
const howToDiv = document.getElementsByClassName("How_To");//要素を追加していく場所を見つける
// 追加するボタンが押された度、How_To1タグ内にある要素を全てもう一つ追加する
function add() {
    
    howToCount++;//今から作るものが作り方手順の何番目かを確認する変数を+1する

    //手順の間の線を引くdivタグ
    let borderDiv = document.createElement("div");
    borderDiv.className = "How_To_Border mt-3 mb-1";
    howToDiv[0].appendChild(borderDiv);

    //追加していく要素の格納先となるdivタグの作成
    let newHowToDiv = document.createElement("div");
    newHowToDiv.className = "row";
    newHowToDiv.id = "How_To" + howToCount;
    howToDiv[0].appendChild(newHowToDiv);

    // 手順の番号が書かれたpタグの作成
    let newHowToP = document.createElement("p");
    newHowToP.className = "HowToNumber ms-2";
    newHowToP.innerHTML = "・手順"+howToCount;
    newHowToDiv.appendChild(newHowToP);
    
    //画像の格納先となるspanタグの作成   
    let newPreviewSpan = document.createElement("span");
    newPreviewSpan.className = "How_To_preview offset-1 col-3";
    newPreviewSpan.id = "How_To_preview" + howToCount;
    newHowToDiv.appendChild(newPreviewSpan);

    //画像をアップロードするinputタグを作成
    let newInput = document.createElement("input");
    newInput.type = "file";
    newInput.className = "file-input noneDisplay";
    newInput.name = "How_To_image[]";
    newInput.id = "How_To_image" + howToCount;
    newInput.setAttribute('onchange',"handleFileSelectHowTo('How_To_image"+howToCount+"','image"+howToCount+"')");
    newPreviewSpan.appendChild(newInput);

    //imgタグの作成
    let newImage = document.createElement("img");
    newImage.src = "img/How_To_Default.png";
    newImage.className = "HowToImg";
    newImage.id = "image" + howToCount;
    newImage.alt = "Image";
    let targetImageId = "How_To_image"+howToCount;
    newImage.setAttribute('onclick',"document.getElementById('"+targetImageId+"').click()");
    newPreviewSpan.appendChild(newImage);

    //textareaを格納するspanタグの生成
    let newTextSpan = document.createElement("span");
    newTextSpan.className="offset-2 col-3";
    newHowToDiv.appendChild(newTextSpan);

    //textareaを生成
    let newTextArea = document.createElement("textarea");
    newTextArea.className = "border";
    newTextArea.name = "HowTo[]";
    newTextArea.id = "How_To_Text"+howToCount;
    newTextArea.cols = "20";
    newTextArea.rows = "4";
    newTextArea.maxlength = "60";
    newTextArea.placeholder = "60文字の制限があります";
    newTextSpan.appendChild(newTextArea);

    howToNumber.value=howToCount;
    
}

// function imgChange(e,id){
//     // 各手順の写真のIDを持つinputタグを特定(特定するために引数でidを渡したい)
//     var files2 = document.getElementById("How_To_image"+id);
//     if (e.target.files2.length > 0) {
//         alert("あ");
//         var fileHowTo = e.target.files2[0];
//       } else {
//         alert("ファイルがアップロードされていません。");
//       }
      
//     var reader = new FileReader();

//     reader.onload = function() {
//         var img = document.querySelector(id);
//         img.src = reader.result;
//     };

//     reader.readAsDataURL(fileHowTo);
// }

function handleFileSelectHowTo(inputId,imgId) {
    const input = document.getElementById(inputId);
    const files = input.files;

    for (const file of files) {
        previewFileHowTo(file,inputId,imgId);
    }
}

function previewFileHowTo(file,inputId,imgId) {
    let reader = new FileReader();
    reader.onload = function(e) {
        let img = document.getElementById(imgId);
        let imageUrl = e.target.result;
        img.src = imageUrl;
    };

    reader.readAsDataURL(file);
}