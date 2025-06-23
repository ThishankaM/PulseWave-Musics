<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Form</title>
    <link rel="stylesheet" href="subscriptionform.css">
</head>
<body>

<div class="form-container">
    <h2>PulseWave Upgrade</h2>
    <form action="process_subscription.php" method="POST">
        <!-- Name -->
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <!-- Subscription Type -->
        <div class="form-group">
            <label for="subscription_type">Subscription Type:</label>
            <select id="subscription_type" name="subscription_type" required>
                <option value="basic">Basic - $5/month</option>
                <option value="standard">Standard - $10/month</option>
                <option value="premium">Premium - $15/month</option>
            </select>
        </div>

        <!-- Payment Method -->
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <!-- Card Details -->
        <div class="form-group">
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" maxlength="16" placeholder="1234 5678 9012 3456" pattern="\d{16}" required>
        </div>

        <div class="form-group">
            <label for="expiry_date">Expiry Date:</label>
            <input type="month" id="expiry_date" name="expiry_date" required>
        </div>

        <div class="form-group">
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="123" pattern="\d{3}" required>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit"><a href="index.php" style="text-decoration: none; color : white;">Subscribe Now</a></button>
        </div>
    </form>
</div>

</body>
</html>
