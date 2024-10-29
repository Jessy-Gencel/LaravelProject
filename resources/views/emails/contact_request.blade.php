<!DOCTYPE html>
<html>
<head>
    <title>New Contact Request</title>
</head>
<body>
    <h1>New Contact Request</h1>
    <p><strong>First Name:</strong> {{ $contactDetails['firstname'] }}</p>
    <p><strong>Last Name:</strong> {{ $contactDetails['lastname'] }}</p>
    <p><strong>Email:</strong> {{ $contactDetails['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactDetails['message'] }}</p>
</body>
</html>
