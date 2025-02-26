<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Cards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .card {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .card img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        .card-details {
            flex: 1;
        }
        .card-details p {
            margin: 5px 0;
        }
        .card-details pre {
            background: #f8f8f8;
            padding: 10px;
            border-radius: 5px;
            white-space: pre-wrap;
        }
        .sort-controls {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h2>Credit Card Listings</h2>

<div class="sort-controls">
    <label for="sort-by">Sort By: </label>
    <select id="sort-by">
        <option value="title">Title</option>
        <option value="TAE">TAE</option>
    </select>

    <label for="sort-direction">Sort Direction: </label>
    <select id="sort-direction">
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
    </select>

    <button onclick="fetchCards()">Sort</button>
</div>

<div id="card-container"></div>

<script>
    async function fetchCards() {
        const sortBy = document.getElementById('sort-by').value;
        const sortDirection = document.getElementById('sort-direction').value;

        try {
            const response = await fetch(`http://localhost:8000/api/v1/credit-cards?sort=${sortBy}&sort_direction=${sortDirection}`);
            const data = await response.json();
            if (data.errors.length > 0) {
                console.error("API Error:", data.error);
                return;
            }
            displayCards(data.data);
        } catch (error) {
            console.error("Error fetching credit cards:", error);
        }
    }

    function displayCards(cards) {
        const container = document.getElementById("card-container");
        container.innerHTML = "";
        cards.forEach(card => {
            const cardDiv = document.createElement("div");
            cardDiv.classList.add("card");
            cardDiv.innerHTML = `
                    <img src="${card.logo}" alt="${card.title}">
                    <div class="card-details">
                        <h3>${card.title}</h3>
                        <p><strong>Bank:</strong> ${card.bank_name}</p>
                        <p><strong>Annual Cost:</strong> ${card.annual_cost}</p>
                        <p><strong>First Year Fee:</strong> ${card.fee_first_year}</p>
                        <p><strong>Second Year Fee:</strong> ${card.fee_second_year}</p>
                        <p><strong>Type:</strong> ${card.card_type}</p>
                        <p><strong>Special Offers:</strong></p>
                        <pre>${card.special_offers}</pre>
                        <p><strong>Extra Info:</strong></p>
                        <pre>${card.extra_info}</pre>
                    </div>
                `;
            container.appendChild(cardDiv);
        });
    }

    fetchCards();
</script>
</body>
</html>
