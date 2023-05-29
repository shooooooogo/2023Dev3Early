// document.querySelector('#addMaterial').addEventListener('click', () => {
//     const newForm = document.createElement('input');
//     newForm.type = 'text';

//     const newLabel = document.createElement('label');
//     newLabel.textContent = '連絡事項：';

//     newLabel.appendChild(newForm);
//     document.querySelector('#addMaterialSpan').appendChild(newLabel);
// });

function addMaterial(){
    const AES = document.getElementById("addMaterialSpan");
    const input1 = document.createElement("input");
    input1.className = 'class-name';
    input1.setAttribute("type","text");
    AES.appendChild(input1);
}