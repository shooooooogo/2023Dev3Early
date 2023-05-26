document.querySelector('#addMaterial').addEventListener('click', () => {
    const newForm = document.createElement('input');
    newForm.type = 'text';
  
    const newLabel = document.createElement('label');
    newLabel.textContent = '連絡事項：';
  
    newLabel.appendChild(newForm);
    document.querySelector('div').appendChild(newLabel);
  });