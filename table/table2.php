<!DOCTYPE html>
<html>
<head>
  <title>Product List Preview</title>
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
  </style>
</head>
<body>
  <h1>Product List Preview</h1>
  <table id="previewTable">
    <tr>
      <th>Product Name</th>
      <th>Price</th>
      <th>Stock</th>
      <th>Description</th>
    </tr>
  </table>

  <script>
    const productTableData = JSON.parse(localStorage.getItem("productTableData"));
    const previewTable = document.getElementById("previewTable");

    if (productTableData && productTableData.length > 0) {
      productTableData.forEach(rowData => {
        const newRow = previewTable.insertRow();
        rowData.forEach(data => {
          const cell = newRow.insertCell();
          cell.textContent = data;
        });
      });
    }
  </script>
</body>
</html>
