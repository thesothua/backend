<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- <script src="jquery-3.7.1.min.js"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>


    @php
        $id = 14;
    @endphp


    <h1>Hello Laravel buddy</h1>

    <script>
        $(document).ready(function() {
            let data = {
                username: 'praveen',
                password: '4t9gdsfGn.',

            }
    
            data = JSON.stringify(data);
            jQuery.ajax({
                url: `http://127.0.0.1:8000/api/product/{{$id}}`,
                type: 'GET',
                headers: {
                    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjk5MjAzMjA0LCJleHAiOjE2OTkyMDY4MDQsIm5iZiI6MTY5OTIwMzIwNCwianRpIjoidDFEbFI3QnJRRGJtTE9FUiIsInN1YiI6IjE2IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.IsSDDbA2LK-6yhO_bm1yjKcxCG3RvNO21v0e4lMv1hk"
                },  
                // data: data,
                success: function(data) {
                    $("#para").html(data);
                }
            });
        });



        // var xmlHttp = new XMLHttpRequest();
        // xmlHttp.open("POST", `{{ route('user.register') }}`, false); 
    </script>

</body>

</html>
