<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset("css/admin.css")}}">
    <link rel="stylesheet" href="{{ asset("css/adminNav.css")}}">
    <!-- <link rel="stylesheet" href="{{ asset("css/adminDash.css")}}"> -->
    <!-- <link rel="stylesheet" href="{{ asset("css/adminAccCTRL.css")}}"> -->

</head>
<body class="adminPage">

    <nav class="side-navbar">
        @include("layouts.adminnav")
    </nav>
    
    <main>
        @include("page.admin-$part")
    </main>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>