<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 8px 8px 0 0;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <p>Dear <span class="highlight">{{ $name }}</span>,</p>

            <p>{{ $response }}</p>

            <p>We hope this resolves your concern. If you have any further questions or need assistance, feel free to reply to this email or contact us.</p>

            <br>
            <p>Best regards,</p>
            <p>The Admin Team</p>
        </div>
    </div>
</body>
</html>

