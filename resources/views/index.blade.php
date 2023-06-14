<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="/css/style.css" rel="stylesheet">
    <title></title>
</head>

<body class="d-flex flex-wrap align-items-center" style="height: 700px; background: #D7D7D7;">
    <form action="{{ route('store') }}" method="POST" class="col-4 mx-auto mt-5 rounded-4"
        style="background: #2C2D31;  padding: 90px 110px 90px 110px; box-shadow: 1.2em 1.2em 20px rgba(122,122,122,0.5); ">

        {{-- H1 --}}
        <div class="d-flex mx-auto justify-content-center">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#2DB656"
                    class="bi bi-alarm me-4" viewBox="0 0 16 16">
                    <path
                        d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z" />
                    <path
                        d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z" />
                </svg>
            </div>
            <p class="fw-bold text-center"
                style="color: #ffffff; font-family: Montserrat; font-size: 25px;">
                Калькулятор<br>событий</p>
        </div>

        {{-- Форма --}}
        @csrf

        <input type="text" class="form-control rounded-pill py-3 ps-4 mt-5"
            style="border: none; font-family: Montserrat;" placeholder="Название" name="title">

        <input type="text" class="form-control rounded-pill py-3 ps-4 mt-4"
            style="border: none; font-family: Montserrat;" placeholder="Место" name="place">

        <input type="date" class="form-control rounded-pill py-3 ps-4 mt-4"
            style="border: none; font-family: Montserrat;" placeholder="Дата" name="date">
        <button type="submit" class="btn rounded-pill col-12 py-3 mt-5 fw-bolder"
            style="background: #2DB656; color: #ffffff; font-family: Montserrat;">Отправить</button>


    </form>
    <div class="col-12 d-flex flex-wrap justify-content-center mt-5 pb-5">
        <div class="col-4 rounded-4 p-" style="background: #ffffff;padding: 90px 110px 90px 110px;">
            <p class="col-12 py-3 fw-bold display-6">Все запросы</p>
            <table class="table table-hover">
                <tbody>
                    @php
                        use Carbon\Carbon;
                    @endphp
                    @foreach ($events as $event)
                        <tr>
                            <td>
                                {{ "Событие $event->title в $event->place, дата - " }}{{ Carbon::createFromFormat('Y-m-d', $event->date)->format('d.m.Y') }}<br>

                                @if ($event->period >= 0)
                                    {{ 'произойдет через ' . abs($event->period) . " $event->period_type" }}
                                @else
                                    {{ 'произошло ' . abs($event->period) . $event->period_type . ' назад' }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
