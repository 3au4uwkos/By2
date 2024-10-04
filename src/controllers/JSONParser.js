// Create a new div for the new input row
  const newPair = document.createElement('div');
  newPair.classList.add('form-row', 'mb-3');

  // Create the key input
  const keyInput = document.createElement('input');
  keyInput.type = 'text';
  keyInput.classList.add('form-control');
  keyInput.name = 'key[]';
  keyInput.placeholder = 'Key';
  keyInput.required = true;

  // Create the value input
  const valueInput = document.createElement('input');
  valueInput.type = 'text';
  valueInput.classList.add('form-control');
  valueInput.name = 'value[]';
  valueInput.placeholder = 'Value';
  valueInput.required = true;


  const keyCol = document.createElement('div');
  keyCol.classList.add('col');
  keyCol.appendChild(keyInput);

  const valueCol = document.createElement('div');
  valueCol.classList.add('col');
  valueCol.appendChild(valueInput);

  newPair.appendChild(keyCol);
  newPair.appendChild(valueCol);


  document.getElementById('inputContainer').appendChild(newPair);




document.getElementById('addPair').addEventListener('click', function() {

  const newPair = document.createElement('div');
  newPair.classList.add('form-row', 'mb-3');

  const keyInput = document.createElement('input');
  keyInput.type = 'text';
  keyInput.classList.add('form-control');
  keyInput.name = 'key[]';
  keyInput.placeholder = 'Key';
  keyInput.required = true;


  const valueInput = document.createElement('input');
  valueInput.type = 'text';
  valueInput.classList.add('form-control');
  valueInput.name = 'value[]';
  valueInput.placeholder = 'Value';
  valueInput.required = true;

  const keyCol = document.createElement('div');
  keyCol.classList.add('col');
  keyCol.appendChild(keyInput);

  const valueCol = document.createElement('div');
  valueCol.classList.add('col');
  valueCol.appendChild(valueInput);

  newPair.appendChild(keyCol);
  newPair.appendChild(valueCol);

  document.getElementById('inputContainer').appendChild(newPair);
});

document.getElementById('keyValueForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const keys = document.querySelectorAll('input[name="key[]"]');
  const values = document.querySelectorAll('input[name="value[]"]');

  const jsonObj = {};
  for (let i = 0; i < keys.length; i++) {
    jsonObj[keys[i].value] = values[i].value;
  }

  const output = JSON.stringify(jsonObj);

  fetch(alert("//localhost:3000/src/views/TestCreator.php"),{
    method: "POST",
    body : output
  })
});
