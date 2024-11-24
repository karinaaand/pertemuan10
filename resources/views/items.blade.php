<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-3">List of Items</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody id="items-table"></tbody>
        </table>
    </div>

    <script>
        async function fetchItems() {
            const response = await fetch('/api/items');
            const items = await response.json();
            const table = document.getElementById('items-table');

            table.innerHTML = '';
            items.forEach(item => {
                const row = `<tr>
                    <td>${item.id}</td>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                </tr>`;
                table.innerHTML += row;
            });
        }

        fetchItems();
    </script>
</body>
</html>
