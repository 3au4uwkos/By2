document.getElementById('addDependency').addEventListener('click', function() {
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

  // Add inputs to new columns
  const keyCol = document.createElement('div');
  keyCol.classList.add('col');
  keyCol.appendChild(keyInput);

  const valueCol = document.createElement('div');
  valueCol.classList.add('col');
  valueCol.appendChild(valueInput);

  newPair.appendChild(keyCol);
  newPair.appendChild(valueCol);

  // Append the new pair to the dependency container
  document.getElementById('dependencyContainer').appendChild(newPair);
});

document.getElementById('testForm').addEventListener('submit', function(event) {
  event.preventDefault();  // Prevent the form from submitting normally

  // Collect test name and description
  const testName = document.getElementById('testName').value;
  const testDescription = document.getElementById('testDescription').value;

  // Collect all keys and values
  const keys = document.querySelectorAll('input[name="key[]"]');
  const values = document.querySelectorAll('input[name="value[]"]');

  // Create an array to store key-value pairs in the format: [key1, value1, key2, value2, ...]
  const dependencies = [];
  for (let i = 0; i < keys.length; i++) {
    dependencies.push(keys[i].value, values[i].value);
  }

  // Create the final JSON object
  const jsonObj = {
    name: testName,
    description: testDescription,
    dependencies: dependencies
  };

  // Send the JSON object to CreationController.php via POST method
  fetch('../controllers/CreationController.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(jsonObj) // Convert JSON object to a string
  })
  .then(response => response.json()) // Parse the JSON response
  .then(data => {
    // Display success or error message based on response
    const responseMessage = document.getElementById('responseMessage');
    if (data.status === 'success') {
      responseMessage.innerHTML = '<div class="alert alert-success">Test created successfully!</div>';
    } else {
      responseMessage.innerHTML = '<div class="alert alert-danger">Error: ' + data.message + '</div>';
    }
  })
  .catch(error => {
    console.error('Error:', error);
    // Display error message
    document.getElementById('responseMessage').innerHTML = '<div class="alert alert-danger">An error occurred while creating the test.</div>';
  });
});

