<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
    @include('header')
    <!-- <form action="/api/dangky" method="post"> -->
    <!-- phone
    <input type="text" name="phone" id="phone">
    route_id
    <input type="text" name="route_id" id="route_id">
    station_id_start
    <input type="text" name="station_id_start" id="station_id_start">
    station_id_end
    <input type="text" name="station_id_end" id="station_id_end">
    count
    <input type="text" name="count" id="count">
    <button id="submitBtn">dang ky</button> -->
    <!-- </form> -->
    <div class="container form-register mb-auto">
        <div class="mb-3">
            <label for="route_id" class="form-label">Tuyến</label>
            <select class="form-select form-select-lg" name="route_id" id="route_id">
                <!-- <option selected>Select one</option> -->
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ga lên</label>
            <select class="form-select form-select-lg" name="station_id_start" id="station_id_start">
                <!-- <option selected>Select one</option> -->
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ga xuống</label>
            <select class="form-select form-select-lg" name="station_id_end" id="station_id_end">
                <!-- <option selected>Select one</option> -->

            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Số Lượng</label>
            <input type="text" class="form-control" name="count" id="count" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="">
        </div>
        <div class="d-grid gap-2">
            <button type="button" name="submitBtn" id="submitBtn" class="btn btn-primary">Button</button>
        </div>
    </div>

    @include('footer')
</body>
<script src="/js/jquery-3.6.3.min.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
<script>
    $.ajax({
        url: '/api/routes',
        method: 'get',
        success: function({
            data,
            index
        }) {
            // $("#station_id_start").append(`<option value="${data['0']['stations'].station_id}">${data['0']['stations'].name}</option>`)
            let curentRouteId = 1;
            data.forEach(element => {
                if (element.route_id == curentRouteId) {
                    element.stations.forEach(element => {
                        $("#station_id_start").append(`<option value="${element.station_id}">${element.name}</option>`)
                        $("#station_id_end").append(`<option value="${element.station_id}">${element.name}</option>`)
                    })

                }
                const newOption = document.createElement('option');
                newOption.setAttribute('value', element.route_id);
                newOption.innerText = element.name;
                newOption.addEventListener('click', function() {
                    console.log(this)
                })

                $("#route_id").append(newOption)

            });
            const route_id = document.querySelector("#route_id");
            route_id.addEventListener('change', function() {
                $("#station_id_start").empty()
                $("#station_id_end").empty()
                data.forEach((element) => {

                    if (element.route_id == this.value) {
                        element.stations.forEach((element) => {
                            $("#station_id_start").append(`<option value="${element.station_id}">${element.name}</option>`)
                            $("#station_id_end").append(`<option value="${element.station_id}">${element.name}</option>`)
                        })
                    }
                })


            })

        }
    });

    const submitBtn = document.querySelector("#submitBtn");
    submitBtn.addEventListener('click', function() {
        let phone = document.querySelector("#phone");
        let route_id = document.querySelector("#route_id");
        let station_id_start = document.querySelector("#station_id_start");
        let station_id_end = document.querySelector("#station_id_end");
        let count = document.querySelector("#count");
        let ticket = {
            phone: phone.value,
            route_id: route_id.value,
            station_id_start: station_id_start.value,
            station_id_end: station_id_end.value,
            count: count.value
        };


        $.ajax({
            url: '/api/dangky',
            method: 'post',
            contentType: 'application/json',
            data: JSON.stringify(ticket),
            success: function(response) {
                console.log(response);
                alert(response.message)
                phone.value = ""
                route_id.value = ""
                station_id_start.value = ""
                station_id_end.value = ""
                count.value = ""
            },
            error: function(response) {
                alert(Object.values(response.responseJSON.errors).flat(1).join(' '))
            }
        })
    })
</script>

</html>