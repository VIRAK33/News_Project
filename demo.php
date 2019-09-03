<!------- Start of header.php --------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>
    <link rel="stylesheet" href="pages/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages/css/css.css">
    <link rel="stylesheet" href="pages/css/style.css">

    <link rel="stylesheet" href="pages/OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="pages/OwlCarousel/dist/assets/owl.theme.default.min.css">
</head>
<body>
  
    <?php
 
        $htmlblock = '
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav">
        <a class="navbar-brand" href="index.html">News</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sport
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#football">Football</a>
                        <a class="dropdown-item" href="#volley_ball">Volley ball</a>
                        <a class="dropdown-item" href="#boxing">Boxing</a>
                        <a class="dropdown-item" href="#swimming">Swiming</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/User_table/login.php">Login</a>
                </li>

            </ul>
        </div>
    </nav>';

    ?>
   

</body>

</html>

<!----- END OF FOOTER  ------->