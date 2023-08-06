<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Davis Gibson Laravel Site</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .form-check {
                opacity: 0.8;
            }

            .searchResult {
                width: 300px;
                height: 250px;
                opacity: 0.9;
                transition: all .1s ease-in-out;
                cursor: pointer;
                border-radius: 7px;
            }

            .searchResult:hover {
                transform: scale(1.08);
            }

            .fa-user {
                opacity: 0.3;
            }

            .searchResultDetails {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 1fr 1fr;
            }

            .searchResultTitle {
                opacity: 0.9;
            }

            #resultsContainer {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }

            .searchResultDetail {
                opacity: 0.6;
            }

            .loader {
                opacity: 0.8;
            }

            [data-is-favorite=true] {
                border: 3px solid #FFE300;
            }

            #search:disabled {
                background-color: #d3d5e0;
            }
        </style>
    </head>
    <body class="antialiased" style="background-color: #f7f8ff">
        <div class="mx-auto col-12 col-md-12 col-lg-10 col-xl-6">
            <nav class="navbar navbar-light mb-4" style="background-color: #f7f8ff; border-bottom: 1px solid #c4c6d8; border-radius: 2px;">
              <h1><a class="navbar-brand fs-5" href="/">Star Wars: Return of the API <small class="text-muted ml-2">by Davis Gibson</small></a></h1>
            </nav>
            @yield('content')
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        @stack('scriptstack')
    </body>
</html>
