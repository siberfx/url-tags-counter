<?php

require_once __DIR__ . '/Service/HtmlParser.php';

if ($_REQUEST && ($url = $_REQUEST['url']) && !empty($url)) {

    $hasError = false;

//    Замените на нужный URL ($url)
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Validate url
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        $hasError = true;
    } else {
        $htmlParser = new HtmlParser($url);
        $htmlParser->parse();
        $results = $htmlParser->showTagsWithCount();
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>HtmlParser :: Введите URL-адрес</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
          integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap"/>

    <style>
        body {
            background-color: #eee;
            font-family: "Poppins", sans-serif;
            font-weight: 300;
        }

        .height {
            height: 15vh;
        }

        .search {
            position: relative;
            box-shadow: 0 0 40px rgba(51, 51, 51, .1);

        }

        .search input {

            height: 60px;
            text-indent: 25px;
            border: 2px solid #d6d4d4;

        }


        .search input:focus {

            box-shadow: none;
            border: 2px solid blue;


        }

        .search .fa-search {

            position: absolute;
            top: 20px;
            left: 16px;

        }

        .search button {

            position: absolute;
            top: 5px;
            right: 5px;
            height: 50px;
            width: 110px;
            background: blue;

        }
    </style>

</head>
<body>

<section>
    <div class="container">
        <h1 class="mt-5 mb-3 text-center text-primary">Введите URL-адрес, который вы хотите использовать для подсчета
            html-тегов:</h1>
        <div class="row height d-flex justify-content-center align-items-center">

            <div class="col-8">

                <div class="search">
                    <i class="fa fa-search"></i>
                    <form action="" method="GET">
                        <input name="url" type="text" class="form-control" placeholder="https://siberfx.com">
                        <button type="submit" class="btn btn-primary">Поиск</button>
                    </form>
                    <?php if(isset($hasError) && $hasError): ?>
                        <p class="alert alert-danger">Не валидный URL (https://.....)</p>
                    <?php
                    endif
                    ?>
                </div>

            </div>


            <div class="col-8 pt-4">

                <?php
                if (isset($results)):
                    ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Тег</th>
                            <th>встречается</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($results as $key => $result) {

                            echo '<tr>
                                <td>' . $result['tag'] . '</td>
                                <td>' . $result['count'] . '</td>
                            </tr>';
                        }


                        ?>
                        </tbody>
                    </table>
                <?php
                endif;
                ?>
            </div>

        </div>
    </div>
</section>


<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Core theme JS-->
<script>

</script>
</body>
</html>
