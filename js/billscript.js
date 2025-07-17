$(document).ready(function() {
  // Function to update search results
  function updateResults(query) {
    const resultsContainer = $("#searchResults");
    resultsContainer.empty();

    // ใช้ Ajax เพื่อดึงข้อมูลจากฐานข้อมูล MySQL
    $.ajax({
      url: "fetch_data.php",
      method: "POST",
      dataType: "json",
      success: function(data) {
        const filteredData = data.filter(item => item.toLowerCase().includes(query.toLowerCase()));

        if (filteredData.length === 0) {
          resultsContainer.append('<li class="list-group-item">No results found</li>');
        } else {
          filteredData.forEach(item => {
            resultsContainer.append(`<li class="list-group-item">${item}</li>`);
          });
        }

        // ซ่อนหรือแสดงผลลัพธ์ขึ้นอยู่กับการมีข้อความใน input
        if (query.trim() === "") {
          resultsContainer.hide();
        } else {
          resultsContainer.show();
        }
      },
      error: function(error) {
        console.error("Error fetching data:", error);
      }
    });
  }

  // Event listener for input change
  $("#company_name").on("input", function() {
    const searchTerm = $(this).val();
    updateResults(searchTerm);
  });

  // Update the form input when a result is clicked
  $("#searchResults").on("click", "li", function() {
    const selectedValue = $(this).text();
    $("#company_name").val(selectedValue);
    $("#searchResults").hide(); // ซ่อน UI เมื่อเลือกค่า
  });
});
