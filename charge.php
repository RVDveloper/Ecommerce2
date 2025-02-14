<?php
require_once 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51QsQLfLXZjkx9hbv0QGx6O4TudMmO6niCACP3KYIO2iP5zhchorasVZ140lVyE2Mc5VJwtdQlSEJd9fDXxLIcmh800RLUIASU3');

$token = $_POST['stripeToken'];
$amount = 1000; // Monto en centimos (ej. $10.00)
$currency = 'eur';

try {
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => $currency,
        'description' => 'Pago de ejemplo',
        'source' => $token,
    ]);

    // Si el pago es exitoso, guarda la información en tu base de datos
    $payment_id = $charge->id;
    $amount = $charge->amount / 100; // Convertir a dólares
    $status = $charge->status;

    // Conectar a la base de datos MySQL
    $mysqli = new mysqli("localhost", "root", "", "nectar");

    // Insertar el pago en la base de datos
    $stmt = $mysqli->prepare("INSERT INTO pagos (payment_id, amount, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $payment_id, $amount, $status);
    $stmt->execute();
    $stmt->close();

    echo "Pago exitoso!";
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error: " . $e->getMessage();
}
?>