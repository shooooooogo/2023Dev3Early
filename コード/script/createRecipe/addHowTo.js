// 複数の画像読み込み用
const fileInput = document.getElementById('How_To_image1');
let howToCount = 1;//作り方の数を記録する

const handleFileSelect = () => {
    const files = fileInput.files;
        for (let i = 0; i < files.length; i++) {
            previewFile(files[i]);
        }
}

// // 画像一つ用(エラー起きた)
// const fileInput = document.getElementById('How_To_image1');
// const handleFileSelect = () => {
//     const files = fileInput.files;
//         for (let i = 0; i < files.length; i++) {
//             previewFile(files[i]);
//         }
// }


function previewFile(file) {
    // プレビュー画像を追加する要素
    const preview = document.getElementById('How_To_preview');

    // FileReaderオブジェクトを作成
    const reader = new FileReader();

    // ファイルが読み込まれたときに実行する
    reader.onload = function (e) {
        const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
        const img = document.createElement("img"); // img要素を作成
        img.src = imageUrl; // 画像のURLをimg要素にセット
        img.className="previewImg";
        // preview内の画像をいったん削除して表示されるのを一つにする
        preview.innerHTML="";

        preview.appendChild(img); // #previewの中に追加
    }

    // いざファイルを読み込む
    reader.readAsDataURL(file);
}

// previewのidを持つ要素(fileInput)が何かしら変更されたとき(投稿される画像のアップロード、変更等)
fileInput.addEventListener('change', handleFileSelect);


// 画像がクリックされたときに、連動する
document.getElementBy.addEventListener("click", () => {
    document.querySelector("input").click();
});
  

// 画像がアップロードされたときに、How_To_previewのクラスを持つdivタグの中の要素を削除し、アップロードされた画像を表示する
function changeImage() {
  var file = document.getElementById("How_To_image1").files[0];
  if (file) {
    var reader = new FileReader();
    reader.onload = function() {
      var image = document.getElementById("How_To_preview1");
      image.innerHTML = "";
      image.appendChild(document.createElement("img")).src = reader.result;
    };
    reader.readAsDataURL(file);
  }
}

// 追加するボタンが押された度、How_To1タグ内にある要素を全てもう一つ追加する
function add() {
  howToCount++;//今から作るものが作り方手順の何番目かを確認する変数を+1する

  var howToDiv = document.getElementByClass("How_To");//要素を追加していくdivタグを見つける
  
  //追加していく要素の格納先となるdivタグの作成
  var newHowToDiv = document.createElement("div");
  newHowToDiv.id = "How_To" + howToCount;
  howToDiv.appendChild(newHowToDiv);

  //画像をアップロードするinputタグを作成
  var newInput = document.createElement("input");
  newInput.type = "file";
  newInput.className = "file-input";
  newInput.name = "How_To_image" + howToCount;
  newInput.id = "How_To_image" + howToCount;
  newHowToDiv.appendChild(newInput);
  
  //画像の格納先となるdivタグの作成   
  var newPreviewDiv = document.createElement("div");
  newPreviewDiv.className = "How_To_preview";
  newPreviewDiv.id = "How_To_preview" + howToCount;
  newHowToDiv.appendChild(newPreviewDiv);
  
  //imgタグの作成
  var newImage = document.createElement("img");
  newImage.src = "How_To_Default.png";
  newImage.id = "image" + howToCount;
  newImage.alt = "Image";
  newPreviewDiv.appendChild(newImage);
}
