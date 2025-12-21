<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: right;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>

<h2>{{ $title }}</h2>

<table>
    <thead>
        <tr>
            <th>الرقم</th>
            <th>الاسم</th>
            <th>الهاتف</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($partners as $partner)
        <tr>
            <td>{{ $partner->id }}</td>
            <td>{{ $partner->name }}</td>
            <td>{{ $partner->phone ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
