<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office - Credit Card Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Update Credit Card Details</h2>
    <form id="creditCardForm">
        <label for="card">Choose a Credit Card:</label>
        <select id="card" name="card"></select>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="extra_info">Extra Info:</label>
        <input type="text" id="extra_info" name="extra_info">
        <label for="tae">TAE:</label>
        <input type="number" step="0.01" id="tae" name="tae" required>
        <button type="submit">Submit</button>
    </form>
</div>

<script>
    function fetchCreditCards() {
        fetch('http://localhost:8000/api/v1/credit-cards')
            .then(response => response.json())
            .then(data => {
                const cardSelect = document.getElementById('card');
                cardSelect.innerHTML = '';
                data['data'].forEach(card => {
                    const option = document.createElement('option');
                    option.value = card.id;
                    option.textContent = card.title;
                    cardSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching credit cards:', error));
    }

    document.getElementById('creditCardForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const data = {
            id: document.getElementById('card').value,
            edits: {
                title: document.getElementById('title').value,
                extra_info: document.getElementById('extra_info').value,
                TAE: document.getElementById('tae').value,
            },
            product_type: 'credit-cards'

        };

        fetch('http://localhost:8000/api/v1/back-office/edits', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(result => alert('Data saved successfully!'))
            .catch(error => alert('Error saving data.'));
    });

    fetchCreditCards();
</script>
</body>
</html>
