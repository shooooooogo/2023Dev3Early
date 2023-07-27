// 材料全体の個数カウント
let materialNumberCount=1;
const materialNumber = document.getElementById("materialNumber");

// 追加するやつを読み込み
const AES = document.getElementById("addMaterialSpan");

// 材料追加のメソッド
function addMaterial(){

    //材料の個数を変更
    materialNumberCount+=1;
    materialNumber.value=materialNumberCount;

    //追加していく要素の格納先となるdivタグの作成
    let newMaterialSpan = document.createElement("span");
    newMaterialSpan.id = "Material_" + materialNumberCount;
    AES.appendChild(newMaterialSpan);
    
    // 材料〇のpタグ
    const label=document.createElement("p");
    label.className="materialNumber ms-3";
    label.innerHTML="材料"+materialNumberCount;
    newMaterialSpan.appendChild(label);

    // 材料名のinputタグ
    const input1 = document.createElement("input");
    input1.className = "class-name textInput col-5 ms-3";
    input1.setAttribute("type","text");
    input1.name = "materialName[]";
    input1.setAttribute("placeholder","材料名");
    newMaterialSpan.appendChild(input1);

    // 材料の分量のinputタグ
    const input2 = document.createElement("input");
    input2.className = "textInput col-5 offset-1";
    input2.setAttribute("type","text");
    input2.name = "materialQuantity[]";
    input2.setAttribute("placeholder","分量");
    newMaterialSpan.appendChild(input2);
    
    // 材料の費用のinputタグ
    const input3 = document.createElement("input");
    input3.className = "class-name textInput col-11 ms-3";
    input3.setAttribute("type","number");
    input3.name = "materialCost[]";
    input3.setAttribute("placeholder","材料の費用");
    newMaterialSpan.appendChild(input3);

}

// 材料を一つ削除
function deleteMaterial() {
    // 手順を一つ削除
    if(materialNumberCount>=2){
        let material_element = document.getElementById("Material_"+materialNumberCount);
        material_element.remove();
    }
    
    // 変数を-1する
    if(materialNumberCount>=2){
        materialNumberCount--;
        materialNumber.value=materialNumberCount;
    }
}