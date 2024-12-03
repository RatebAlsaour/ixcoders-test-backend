{{-- resources/views/emails/email.blade.php --}}
    <!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير المهام اليومية</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        p {
            font-size: 16px;
            color: #34495e;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<h1>مرحباً!</h1>
<p>إليك تقرير المهام الخاصة بك لهذا اليوم:</p>

<ul>
    @foreach ($tasks as $task)
        <li>
            <strong>{{ $task->title }}</strong><br>
            وصف المهمة: {{ $task->description }}<br>
            تاريخ الإنشاء: {{ $task->created_at }}<br>
        </li>
    @endforeach
</ul>

<p>مع تحيات فريق العمل.</p>
</body>
</html>
