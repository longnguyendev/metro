<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>

    <!-- <div id="loading">
        <div class="spinner-border" role="status">
        </div>
    </div> -->

    @include('header')
    <div id="loading">
        <div class="d-flex justify-content-center align-items-center">
            <div class="spinner-border text-primary spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="container content">
        <div class="row">
            <div class="banner">
            </div>
            <div class="col-2">
                <div style="background: #dde6f3; margin-top: 50px; border-radius: 8px">
                    <h5 class="text-center" style="background: #ffd900; border-radius: 8px 8px 0 0; padding: 5px;">Danh sách các Tuyến</h5>
                    <ul class="route-selection" style="list-style: none;">
                    </ul>
                </div>

            </div>
            <div class="col-10">
                <div class="container-fluid mt-0">
                    <div class="p-5 my-5 bg-light border border-light-subtle rounded-3 route">
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
            </div>

        </div>
    </div>


    @include('footer')
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="/js/jquery-3.6.3.min.js"></script>

    <script>
        var initRouteId = 1;
        var initData = [];
        var $loading = $('#loading').hide();
        $(document)
            .ajaxStart(function() {
                $loading.show();
            })
            .ajaxStop(function() {
                $loading.hide();
            });
        $.ajax({
            url: '/api/routes',
            method: 'get',
        }).done(({
            data
        }) => {
            initData = data
            data.forEach((route) => {
                const para = document.createElement("li");
                para.className = "route-item"
                para.innerHTML = route.name
                para.addEventListener("click", () => render(route.route_id));
                $(".route-selection").append(para)
            })
            render(initRouteId);
        })

        function render(route_id) {
            $(".route-dot-input").empty();
            $(".route-label").empty();
            var routeData = initData.find((route) => route.route_id === route_id)
            $(".route-name").html(routeData['name']);
            routeData.stations.forEach((station, index) => {
                $(".route-dot-input").append(`<input class="col g-0 station" type="radio" name="station" ${index===0?"checked":""} data-bs-toggle="tooltip" data-bs-custom-class="route-tooltip" data-bs-placement="bottom" data-bs-html="true" data-bs-title="Tuyến ${station.routes.map(route=> "<span class='badge text-bg-light'>"+route.route_id+"</span>").join(" ")}">`)
                $(".route-label").append(`<div class="col g-0 station-info">
                            <span>${station.name}</span>
                        </div>`)
            });
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        }
    </script>
    <!-- <script src="/js/app.js"></script> -->
</body>

</html>