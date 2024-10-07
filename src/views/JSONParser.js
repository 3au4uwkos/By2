
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

  fetch("TestCreator.php",{
    method: "POST",
    headers: {
      'Content-Type' : 'application/json',
    },
    body: output
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === 'error') {
        // Display error message to user
        document.getElementById('error-message').innerText = data.message;
    } else {
        // Handle success (e.g., redirect to another page)
    }
})
.catch(error => {
    console.error('Error:', error);
})})
