<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
    body {
        font-weight: bolder;
		background: url('/img/SVG/404_page.svg') rgba(158, 190, 248, 0.137) 5vw 5vh no-repeat fixed;
	
    }

    .card {
        width: auto;
        margin: auto;
        background-color: rgba(245, 245, 245, 0.199);
    }
    </style>

</head>

<body>

    <div class='container'>

            <div class='col-md'>
                <div class='col-sm'>
				<img class='img-fluid' src='/img/Freewill-logos/Freewill-logos_black.png' style='align-content: start; max-width: 300px; max-height: 300px' />
				<h1 class='m-4' style='font-style: italic;'>404 - File Not Found</h1>
                    <small class='text-center m-4' style='font-size: 24px;  font-style: italic;'> Sorry we cant find the
                        resource <br/>you are looking for </small><br/><br/>
					<span class='mt-4'> To go back to home page <a href='/'> Click here </a> </span>
					 <img class='img-fluid' src='' />
                </div>
            </div>
        </div>



    <?php if (! empty($message) && $message !== '(null)') : ?>
    <?= nl2br(esc($message)) ?>
    <?php else : ?>

    <?php endif ?>
</body>

</html>