<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FreeWill Lawyer">
    <meta name="keywords" content="FreeWill Lawyer free wills free legal contracts" />
    <meta name="author" content="FreeWill Lawyer">
    <meta name="copyright" content="FreeWill Lawyer">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <link rel="shortcut icon" href="/img/Freewill-logos/Freewill-logos_black.webp" />
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel='stylesheet' href='/css/index.css' />
    <script src='/js/router.js'></script>

    <title>NFLDLAW - FreeWill Lawyer</title>
</head>

<body>
    <!-- header end -->



    <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <ul class='navbar-nav'>
         
         <li class='nav-item'> <button class="navbar-toggler" id='btn-menu-collapse' type="button" data-toggle="collapse" data-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
  
          </button></li></ul>
        <a class='nav-link' href=''>
        <span class='text-bold'> NFLD LEGAL </span>    
        <img class='img-fluid'src='/img/Freewill-logos/Freewill-logos_black.webp' alt='logo' style='max-height: 150px' />
    </a>

        <ul class="navbar-nav" id='nav-section-topMenu'>
            <li class="nav-item">
                <a class="nav-link" href="/">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/home/about/">About Us</a>
            </li>
            <li class='nav-item'>
                <a href='/home/login/' class='nav-link'>Login</a>
            </li>
            <li>
                <a href='/home/register/'><button class='btn btn-transparent started'>Get Started</button></a>
            </li>

        </ul>
        <div class="collapse navbar-collapse" id="navbarNav">

        </div>
    </nav>

    <script>
                let btnCollapse = document.getElementById('btn-menu-collapse');
                let navMenu = document.getElementById('nav-section-topMenu');

                btnCollapse.addEventListener('click', () => {

                    if (navMenu.style.display === 'flex') {
                        navMenu.style.display = 'none';
                    } else {
                        navMenu.style.display = 'flex';
                    }
                });
            </script>