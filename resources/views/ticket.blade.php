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
    <div class="container mt-5 mb-auto">
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="phone">
        </div>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tuyến</th>
                        <th scope="col">Thời Gian Đặt</th>
                        <th scope="col">Ga lên</th>
                        <th scope="col">Ga xuống</th>
                        <th scope="col">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody class="info">
                    <!-- <tr class="info">
                        <td>R1C1</td>
                        <td>R1C2</td>
                        <td>R1C3</td>
                        <td>R1C3</td>
                        <td>R1C3</td>

                    </tr>
                    <tr class="info">
                        <td>R1C1</td>
                        <td>R1C2</td>
                        <td>R1C3</td>
                        <td>R1C3</td>
                        <td>R1C3</td>

                    </tr>
                    <tr class="info">
                        <td>R1C1</td>
                        <td>R1C2</td>
                        <td>R1C3</td>
                        <td>R1C3</td>
                        <td>R1C3</td>

                    </tr> -->

                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
    </div>
    @include('footer')
    <script src="/js/jquery-3.6.3.min.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script>
        const btnSubmit = document.querySelector("#btnSubmit");
        btnSubmit.addEventListener('click', function() {
            let phone = document.querySelector("#phone").value;
            ticket = {
                phone
            };

            $.ajax({
                url: '/api/kiemtra',
                method: 'post',
                contentType: 'application/json',
                data: JSON.stringify(ticket),
                success: function({
                    data
                }) {
                    $('.info').empty();
                    data.forEach(element => {
                        $('.info').append(`<tr><td>${element.ticket_id}</td><td>${element.create_at}</td><td>${element.route_name}</td><td>${element.station_name_start}</td><td>${element.station_name_end}</td><td>${element.total}</td></tr>`)
                        // $('.info').append(`<td>${element.create_at}</td>`)
                        // $('.info').append(`<td>${element.route_name}</td>`)
                        // $('.info').append(`<td>${element.station_name_start}</td>`)
                        // $('.info').append(`<td>${element.station_name_end}</td>`)
                        // $('.info').append(`<td>${element.total}</td>`)
                    });
                }
            })
        })
    </script>
</body>

</html>