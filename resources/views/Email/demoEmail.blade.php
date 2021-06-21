<!DOCTYPE html>
<html>

<head>
    <title>LearnWithAnik</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

    </style>
</head>

<body>
    <h3 style="text-align: center">Thank you for your payment</h3>
    <p style="text-align: center">Your payment description given below</p>
    <table id="customers">
        <tr>
            <th>SL</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PRICE</th>
            <th>PAYMENT DATE</th>
        </tr>
        <tr>
            <td>{{ $mailData['sl'] }}</td>
            <td>{{ $mailData['name'] }}</td>
            <td>{{ $mailData['email'] }}</td>
            <td>{{ $mailData['price'] }} USD</td>
            <td>{{ $mailData['date'] }}</td>
        </tr>
    </table>

</body>

</html>
