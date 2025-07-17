<!DOCTYPE html>
<html>
<head>
    <title>Table with IndexedDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <table id="myTable">
        <tr>
            <th>Column 1 Heading</th>
            <th>Column 2 Heading</th>
            <th>Column 3 Heading</th>
            <th>Column 4 Heading</th>
            <th>Column 5 Heading</th>
        </tr>
        <tr>
            <td>1</td>
            <td><input type="text" value="Data 1B"></td>
            <td><input type="text" value="Data 1C"></td>
            <td><input type="text" value="Data 1D"></td>
            <td><input type="text" value="Data 1E"></td>
        </tr>
    </table>
    
    <button id="addRowBtn" onclick="addRow()">Add Row</button>
    <button id="insertToIndexedDBBtn" onclick="insertToIndexedDB()">Insert to IndexedDB</button>

    <script>
        let rowCount = 1; // Initial number of rows (change this if needed)

        function addRow() {
            rowCount++;

            const table = document.getElementById('myTable');
            const newRow = table.insertRow();
            
            const cell1 = newRow.insertCell();
            const cell2 = newRow.insertCell();
            const cell3 = newRow.insertCell();
            const cell4 = newRow.insertCell();
            const cell5 = newRow.insertCell();
           

            cell1.innerHTML = `${rowCount}`;
            cell2.innerHTML = `<input type="text" value="Data ${rowCount}B">`;
            cell3.innerHTML = `<input type="text" value="Data ${rowCount}C">`;
            cell4.innerHTML = `<input type="text" value="Data ${rowCount}D">`;
            cell5.innerHTML = `<input type="text" value="Data ${rowCount}E">`;
        }

        function insertToIndexedDB() {
            const table = document.getElementById('myTable');
            const rows = table.rows;

            const dataToInsert = [];
            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
                const cells = rows[i].cells;
                const data = {
                    column1: cells[0].innerText,
                    column2: cells[1].querySelector('input').value,
                    column3: cells[2].querySelector('input').value,
                    column4: cells[3].querySelector('input').value,
                    column5: cells[4].querySelector('input').value,
                };
                dataToInsert.push(data);
            }

            // Now, you can save the dataToInsert array to IndexedDB using your preferred IndexedDB library or wrapper.
            // Here's a simple example using the native IndexedDB API:
            const dbName = "myDatabase";
            const storeName = "myTableData";
            const request = indexedDB.open(dbName, 1);

            request.onupgradeneeded = function(event) {
                const db = event.target.result;
                const objectStore = db.createObjectStore(storeName, { keyPath: "id", autoIncrement: true });
                objectStore.createIndex("column1", "column1", { unique: false });
                objectStore.createIndex("column2", "column2", { unique: false });
                objectStore.createIndex("column3", "column3", { unique: false });
                objectStore.createIndex("column4", "column4", { unique: false });
                objectStore.createIndex("column5", "column5", { unique: false });
            };

            request.onsuccess = function(event) {
                const db = event.target.result;
                const transaction = db.transaction([storeName], "readwrite");
                const objectStore = transaction.objectStore(storeName);

                dataToInsert.forEach(function(data) {
                    const request = objectStore.add(data);
                    request.onsuccess = function(event) {
                        console.log("Data inserted successfully with ID: " + event.target.result);
                    };
                    request.onerror = function(event) {
                        console.error("Error inserting data: ", event.target.error);
                    };
                });

                transaction.oncomplete = function() {
                    db.close();
                    console.log("Data insertion transaction completed.");
                };

                transaction.onerror = function(event) {
                    console.error("Error in data insertion transaction: ", event.target.error);
                };
            };

            request.onerror = function(event) {
                console.error("Error opening database: ", event.target.error);
            };
        }
    </script>
</body>
</html>
