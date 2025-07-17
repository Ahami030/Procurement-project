<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Bootstrap 5 + SweetAlert2 Example</title>
</head>
<body>

<div class="container mt-5">
  <button type="button" class="btn btn-primary" onclick="showAlert('Primary Button')">Primary Button</button>
  <button type="button" class="btn btn-secondary" onclick="showAlert('Secondary Button')">Secondary Button</button>
  <button type="button" class="btn btn-success" onclick="showAlert('Success Button')">Success Button</button>
  <button type="button" class="btn btn-danger" onclick="showAlert('Danger Button')">Danger Button</button>
  <button type="button" class="btn btn-warning" onclick="showAlert('Warning Button')">Warning Button</button>
  <button type="button" class="btn btn-info" onclick="showAlert('Info Button')">Info Button</button>
  <button type="button" class="btn btn-light" onclick="showAlert('Light Button')">Light Button</button>
  <button type="button" class="btn btn-dark" onclick="showAlert('Dark Button')">Dark Button</button>
  <button type="button" class="btn btn-link" onclick="showAlert('Link Button')">Link Button</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function showAlert(buttonText) {
    Swal.fire({
      title: 'Button Clicked!',
      text: buttonText,
      icon: 'success',
      confirmButtonText: 'OK'
    });
  }
</script>
</body>
</html>
