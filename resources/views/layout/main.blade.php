<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
         body {
            background-color: #121212; /* deeper dark */
            color: #e0e0e0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .main{
            width: 70%;
            margin:auto;
            padding: 20px 0;
        }
        
    </style>
</head>
<body>
    
    <div class="main">
        @yield('main')
    </div>
</body>
</html>