<!DOCTYPE html>
<html>
<head>
    <title>New Contact Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
        .intro {
            font-size: 18px;
            color: #444;
            margin-bottom: 20px;
        }
        .highlight {
            font-weight: bold;
            color: #007bff;
        }
        .message-content {
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Contact Request</h1>

        <p class="intro">
            You have received a new message from {{$contactDetails['firstname']}} {{$contactDetails['lastname'] }} at email adress {{ $contactDetails['email'] }}. Here are the details of the contact request:
        </p>

        <p class="message-content">
            <strong>Message:</strong><br>
            {{ $contactDetails['message'] }}
        </p>

        <p>
            Please respond to this request as soon as possible.
        </p>
    </div>
</body>
</html>
