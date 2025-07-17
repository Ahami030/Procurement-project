<!DOCTYPE html>
<html>
<head>
    <title>Local Storage Table</title>
</head>
<body>
    <h1>Local Storage Table Example</h1>

    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" required>

        <label for="age">Age:</label>
        <input type="number" id="age" required>

        <button type="button" onclick="addDataToTable()">Add Data</button>
    </form>

    <table id="userTable">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
    </table>

    <script>
        // Function to add data to the table and save to Local Storage
        function addDataToTable() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const age = document.getElementById('age').value;

            const table = document.getElementById('userTable');
            const newRow = table.insertRow(-1);
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);
            const cell4 = newRow.insertCell(3);

            cell1.innerHTML = name;
            cell2.innerHTML = email;
            cell3.innerHTML = age;
            cell4.innerHTML = '<button onclick="deleteData(event)">Delete</button>';

            const data = {
                name: name,
                email: email,
                age: age,
            };

            // Get existing data from Local Storage (if any) and add the new data
            let existingData = JSON.parse(localStorage.getItem('userData')) || [];
            existingData.push(data);
            localStorage.setItem('userData', JSON.stringify(existingData));
        }

        // Function to display data from Local Storage on page load
        function displayDataFromLocalStorage() {
            const table = document.getElementById('userTable');
            const data = JSON.parse(localStorage.getItem('userData')) || [];

            for (let i = 0; i < data.length; i++) {
                const newRow = table.insertRow(-1);
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                const cell4 = newRow.insertCell(3);

                cell1.innerHTML = data[i].name;
                cell2.innerHTML = data[i].email;
                cell3.innerHTML = data[i].age;
                cell4.innerHTML = '<button onclick="deleteData(event)">Delete</button>';
            }
        }

        // Call the function to display data on page load
        displayDataFromLocalStorage();

        // Function to delete data from the table and Local Storage
        function deleteData(event) {
            const row = event.target.parentNode.parentNode;
            const name = row.cells[0].innerText;
            const email = row.cells[1].innerText;
            const age = row.cells[2].innerText;

            // Remove the row from the table
            row.parentNode.removeChild(row);

            // Remove the data from Local Storage
            const data = JSON.parse(localStorage.getItem('userData')) || [];
            const newData = data.filter((item) => {
                return !(item.name === name && item.email === email && item.age === age);
            });
            localStorage.setItem('userData', JSON.stringify(newData));
        }
    </script>
</body>
</html>
