document.addEventListener('DOMContentLoaded', function() {
    // Open a connection to the IndexedDB database
    var request = window.indexedDB.open('tableDB', 1);

    request.onerror = function(event) {
        console.error('Error opening database:', event.target.errorCode);
    };

    request.onsuccess = function(event) {
        var db = event.target.result;

        // Start a new transaction to perform database operations
        var transaction = db.transaction(['tables'], 'readonly');
        var tableStore = transaction.objectStore('tables');

        // Get all saved tables from the object store
        var getAllRequest = tableStore.getAll();

        getAllRequest.onsuccess = function(event) {
            var savedTables = event.target.result;

            // Populate the savedTables div with clickable links
            var savedTablesDiv = document.getElementById('savedTables');
            savedTables.forEach(function(savedTable, index) {
                var tableLink = document.createElement('a');
                tableLink.href = '#';
                tableLink.textContent = 'Table ' + (index + 1);
                tableLink.dataset.tableIndex = index;
                savedTablesDiv.appendChild(tableLink);
            });

            // Display the first saved table by default
            displayTablePreview(savedTables[0].tableHTML);

            // Handle clicks on the links
            savedTablesDiv.addEventListener('click', function(event) {
                var target = event.target;
                if (target.tagName === 'A') {
                    var selectedIndex = parseInt(target.dataset.tableIndex, 10);
                    displayTablePreview(savedTables[selectedIndex].tableHTML);
                }
            });
        };

        getAllRequest.onerror = function(event) {
            console.error('Error getting saved tables:', event.target.error);
        };

        transaction.oncomplete = function() {
            // Close the database connection when the transaction is done
            db.close();
        };
    };
});

// Function to display the table in the preview div
function displayTablePreview(tableHTML) {
    document.getElementById('preview').innerHTML = tableHTML;
}
