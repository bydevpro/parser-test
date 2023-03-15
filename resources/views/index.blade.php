<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>JSON</title>
</head>
<body>
  <div class='container'>
    <div class='row'>
      <div class='col-md-6'>
        <!-- отображаем на json в читаемом виде -->
        <pre><?php echo json_encode(json_decode($request), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?></pre>
      </div>
    </div>
  </div>
</body>
</html>