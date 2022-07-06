<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    New reservation
                </div>

                <div class="card-body">
                    Hello {{ $reservation->lastname . ' ' . $reservation->firstname }} <br>

                    You made a reservation from our site at {{ $reservation->created_at->format('d/m/Y H:i:s') }} with these information: 

                    <div class="row my-4">
                        <div class="col md-6">Firstname:</div>
                        <div class="col md-6">{{ $reservation->firstname }}</div>
                    </div>

                    <div class="row my-4">
                        <div class="col md-6">Lastname:</div>
                        <div class="col md-6">{{ $reservation->lastname }}</div>
                    </div>

                    <div class="row my-4">
                        <div class="col md-6">Email:</div>
                        <div class="col md-6">{{ $reservation->email }}</div>
                    </div>

                    <div class="row my-4">
                        <div class="col md-6">Phone:</div>
                        <div class="col md-6">{{ $reservation->phone }}</div>
                    </div>

                    <div class="row my-4">
                        <div class="col md-6">Date:</div>
                        <div class="col md-6">{{ $reservation->date }}</div>
                    </div>

                    <div class="row my-4">
                        <div class="col md-6">Hour:</div>
                        <div class="col md-6">{{ $reservation->hour }}</div>
                    </div>

                    <div class="row my-4">
                        <div class="col md-6">Persons:</div>
                        <div class="col md-6">{{ $reservation->person }}</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>