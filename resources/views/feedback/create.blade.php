<!DOCTYPE html>
<html>
<head>
    <title>Rate your experience</title>
</head>
<body style="font-family:Arial;text-align:center;padding:30px">

<h2>⭐ Rate your coffee</h2>

<form method="POST" action="{{ route('feedback.store', $order->receipt_token) }}">
    @csrf

    <select name="rating" required>
        <option value="">Choose rating</option>
        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
        <option value="4">⭐⭐⭐⭐ Very good</option>
        <option value="3">⭐⭐⭐ Good</option>
        <option value="2">⭐⭐ Not good</option>
        <option value="1">⭐ Bad</option>
    </select>

    <br><br>

    <textarea name="comment" placeholder="Your comment (optional)"></textarea>

    <br><br>

    <button type="submit">Send feedback</button>
</form>

</body>
</html>
