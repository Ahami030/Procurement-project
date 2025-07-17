<!DOCTYPE html>
<html>
<head>
  <title>Product List</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    #addButton {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <h1>Product List</h1>
  <table id="productTable">
    <tr>
      <th>Product Name</th>
      <th>Price</th>
      <th>Stock</th>
      <th>Description</th>
    </tr>
    <tr>
      <td>Product 1</td>
      <td>$19.99</td>
      <td>10</td>
      <td>Product 1 Description</td>
    </tr>
    <tr>
      <td>Product 2</td>
      <td>$29.99</td>
      <td>5</td>
      <td>Product 2 Description</td>
    </tr>
    <tr>
      <td>Product 3</td>
      <td>$9.99</td>
      <td>15</td>
      <td>Product 3 Description</td>
    </tr>
    <!-- Add more rows for additional products -->
  </table>

  <button id="addButton" onclick="addRow()">Add Row</button>
  <button id="previewButton" onclick="sendToPreviewPage()">Preview</button>


  <script>
    function addRow() {
      const table = document.getElementById('productTable');
      const newRow = table.insertRow(table.rows.length);
      
      const cell1 = newRow.insertCell(0);
      const cell2 = newRow.insertCell(1);
      const cell3 = newRow.insertCell(2);
      const cell4 = newRow.insertCell(3);
      
      const productName = document.createElement("input");
      productName.type = "text";
      cell1.appendChild(productName);
      
      const productPrice = document.createElement("input");
      productPrice.type = "text";
      cell2.appendChild(productPrice);
      
      const productStock = document.createElement("input");
      productStock.type = "text";
      cell3.appendChild(productStock);
      
      const productDescription = document.createElement("input");
      productDescription.type = "text";
      cell4.appendChild(productDescription);
    }
    function sendToPreviewPage() {
      const tableData = [];
      const tableRows = document.querySelectorAll("#productTable tr:not(:first-child)");

      tableRows.forEach(row => {
        const rowData = [];
        const cells = row.querySelectorAll("td input");
        cells.forEach(cell => rowData.push(cell.value));
        tableData.push(rowData);
      });

      localStorage.setItem("productTableData", JSON.stringify(tableData));
      window.location.href = "table2.php";
    }
  </script>
</body>
</html>
