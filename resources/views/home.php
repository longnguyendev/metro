<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="p-3 my-5 bg-light border border-light-subtle rounded-3 route">
            <div id="route-name-wrapper">
                <div class="route-name rounded-pill d-inline-block">

                </div>
                <div id="routes">

                </div>
            </div>

            <div class="route-line-holder">
                <div class="row route-dot route-dot-input">
                </div>
                <div class="row route-dot route-label">
                </div>
            </div>
        </div>
    </div>
    <script>
        $.ajax({
            url: "http://127.0.0.1:8000/api/route/<?php echo $id ?>",
            type: "get",
        }).done(({
            data
        }) => {

            $(".route-name").html(data['name']);
            let list = document.createElement('ul');

            data.stations.forEach((station, index) => {
                $(".route-dot-input").append(`<input class="col g-0 station" type="radio" name="station" ${index===0?"checked":""}>`)
                $(".route-label").append(`<div class="col g-0 station-info">
                        <span>${station.name}</span>
                    </div>`)
            });

        })
        $.ajax({
            url: "http://127.0.0.1:8000/api/route",
            type: "get",
        }).done(({
            data
        }) => {
            data.forEach(element => {

                $("#routes").append(`<a class="route" href="/${element['route_id']}">${element['name']}</a>`);
            });



        })
    </script>
</body>

</html>