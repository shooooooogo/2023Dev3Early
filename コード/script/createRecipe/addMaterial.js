// 材料全体の個数カウント
let materialNumberCount=1;
const materialNumber = document.getElementById("materialNumber");

// 材料追加のメソッド
function addMaterial(){
    // 追加するやつを読み込み
    const AES = document.getElementById("addMaterialSpan");
    
    // 材料〇のpタグ
    materialNumberCount+=1;
    const label=document.createElement("p");
    label.className="materialNumber ms-2";
    label.innerHTML="・材料"+materialNumberCount;
    AES.appendChild(label);

    // 材料名のinputタグ
    const input1 = document.createElement("input");
    input1.className = "class-name textInput col-5 ms-3";
    input1.setAttribute("type","text");
    input1.name = "materialName[]";
    input1.setAttribute("placeholder","材料名");
    AES.appendChild(input1);

    // 材料の分量のinputタグ
    const input2 = document.createElement("input");
    input2.className = "textInput col-5 offset-1";
    input2.setAttribute("type","text");
    input2.name = "materialQuantity[]";
    input2.setAttribute("placeholder","分量");
    AES.appendChild(input2);
    
    // 材料の費用のinputタグ
    const input3 = document.createElement("input");
    input3.className = "class-name textInput col-11 ms-3";
    input3.setAttribute("type","number");
    input3.name = "materialCost[]";
    input3.setAttribute("placeholder","材料の費用");
    AES.appendChild(input3);

    //材料の個数を変更
    materialNumber.value=materialNumberCount;
}