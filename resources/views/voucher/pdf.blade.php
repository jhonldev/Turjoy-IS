<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $code }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap');

        body {
            font-family: 'Merriweather Sans', sans-serif;
            padding: 10px;
        }

        .title {
            font-weight: bold;
            text-align: center;
        }

        h2 {
            color: #FF6B6B;
        }

        h3 {
            font-weight: bold;

        }

        p {
            font-weight: bold;
        }

        span {
            font-weight: 700;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

        }

        .total {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .total-pay {
            margin-bottom: 0px;
            text-align: center;
        }

        .method-pay {
            color: #EAEAEA;
            font-weight: bold;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class=" title">Comprobante de Reserva de Pasaje: </h1>
    <div>
        <h3>Viajes Turjoy</h3>
        <h3>Fecha:
            <span>{{ $purchase_date_es }}</span>
    </h3>
    </div>
    <div>
        <h2>Detalles de la reserva</h2>
        <p>Codigo de reserva:
            <span>{{ $code }}</span>
        </p>
        <p>Ciudad de origen:
            <span>{{ $origin }}</span>
        </p>
        <p>Ciudad de destino:
            <span>{{ $destination }}</span>
        </p>
        <p>Día de la reserva:
            <span>{{ $reservation_date_es }}</span>
        </p>
        <p>Cantidad de asientos:
            <span>{{ $quantity_seats}}</span>
        </p>
        <p>Fecha de la compra:
            <span>{{ $purchase_date_es }}</span>
        </p>
    </div>
    <hr>
    <div class="total">
        <p class="total-pay">Total pagado: {{ $payment }}</p>
    </div>
</body>

</html>
