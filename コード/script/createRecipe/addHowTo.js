// // 複数の画像読み込み用
// const fileInput = document.getElementById('How_To_image1');

// const handleFileSelectHowTo = () => {
//     const files = fileInput.files;
//         for (let i = 0; i < files.length; i++) {
//             previewFile2(files[i]);
//         }
// }

// // 画像一つ用(エラー起きた)
// const fileInput = document.getElementById('How_To_image1');
// const handleFileSelect = () => {
//     const files = fileInput.files;
//         for (let i = 0; i < files.length; i++) {
//             previewFile(files[i]);
//         }
// }


// function previewFile2(file) {
//     // プレビュー画像を追加する要素
//     const preview = document.getElementById('How_To_preview');

//     // FileReaderオブジェクトを作成
//     const reader = new FileReader();

//     // ファイルが読み込まれたときに実行する
//     reader.onload = function (e) {
//         const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
//         const img = document.createElement("img"); // img要素を作成
//         img.src = imageUrl; // 画像のURLをimg要素にセット
//         img.className="previewImg";
//         // preview内の画像をいったん削除して表示されるのを一つにする

//         preview.appendChild(img); // #previewの中に追加
//     }

//     // いざファイルを読み込む
//     reader.readAsDataURL(file);
// }

// // previewのidを持つ要素(fileInput)が何かしら変更されたとき(投稿される画像のアップロード、変更等)
// fileInput.addEventListener('change', handleFileSelectHowTo);
  

// // 画像がアップロードされたときに、How_To_previewのクラスを持つdivタグの中の要素を削除し、アップロードされた画像を表示する
// function changeImage() {
//   var file = document.getElementById("How_To_image1").files[0];
//   if (file) {
//     var reader = new FileReader();
//     reader.onload = function() {
//       var image = document.getElementById("How_To_preview1");
//       image.innerHTML = "";
//       image.appendChild(document.createElement("img")).src = reader.result;
//     };
//     reader.readAsDataURL(file);
//   }
// }
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
    newInput.name = "How_To_image" + howToCount;
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
    newTextArea.name = "HowTo"+howToCount;
    newTextArea.id = "How_To_Text"+howToCount;
    newTextArea.cols = "20";
    newTextArea.rows = "4";
    newTextArea.maxlength = "60";
    newTextArea.placeholder = "60文字の制限があります";
    newTextSpan.appendChild(newTextArea);

    
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