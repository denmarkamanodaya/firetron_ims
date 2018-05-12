<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
    
<script>
// $.ajax({ 
//     type: "GET",
//     cache: false,
//     crossDomain: true,
//     dataType: 'jsonp',
//     contentType: "application/json; charset=utf-8",
//     async: false,
//     url: "http://firetron-ims.local/check/P001/1000",
//     beforeSend: function(xhr){xhr.setRequestHeader('Access-Control-Allow-origin', true);},
//     success: function(data)
//     {

//     },
//     complete: function (data)
//     {
//         var json=JSON.stringify(data);
//         json=JSON.parse(json)

//       for (var key in json) {
//           if (json.hasOwnProperty(key)) {
//             console.log(key + " -> " + json[key].code);
//           }
//         }
//     },
//     error: function(data) {
//         //console.log(data);
//     }
// }); 
  






// $.get( "http://firetron-ims.local/check/P001/1000", function( data, success, xhr) {
  
//     xhr.setRequestHeader('Access-Control-Allow-origin', true);

//   var json = JSON.stringify(data);
//   json = JSON.parse(json);  

//   for (var key in json) {
//       if (json.hasOwnProperty(key)) {
//         console.log(key + " -> " + json[key].code);
//       }
//     }
//   // console.log(json[0].code);
// });

</script>
</html>
