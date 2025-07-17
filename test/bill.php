<!DOCTYPE html>
<html lang="th">

<head>
    <title>เพิ่มบิลใหม่</title>
    <meta charset="UTF-8">
</head>

<body>
    <h2>เพิ่มบิลใหม่</h2>

    <form action="insert_bill.php" method="post">
        <label for="company_name">ชื่อบริษัท:</label>


        <input type="text" id="company_name" name="company_name" lang="th" placeholder="Search..."><br><br>
        <ul class="list-group" id="searchResults">
            <!-- Search results will be displayed here -->
        </ul>

        <label for="price">ราคา:</label>
        <input type="text" id="price" name="price" placeholder="จำนวนเงิน"><br><br>

        <input type="text" id="billNo." name="billNo" placeholder="เลขที่บิล"><br><br>


        <input type="submit" value="เพิ่มบิล">
    </form>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="billscript.js"></script> <!-- Include your custom JavaScript file -->