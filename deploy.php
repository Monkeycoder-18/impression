<?php
// Look for the secret in your exact dedicated security directory
$secret_file = '/home/impress5/git_secret/.webhook_secret';

if (!file_exists($secret_file)) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "Configuration Error: Secret file missing.";
    exit;
}

$secret = trim(file_get_contents($secret_file));

// Safely grab headers across various cPanel PHP handlers
$headers = array_change_key_case(getallheaders() ?: []);
if (empty($headers)) {
    foreach ($_SERVER as $key => $value) {
        if (strpos($key, 'HTTP_') === 0) {
            $headers[str_replace('_', '-', strtolower(substr($key, 5)))] = $value;
        }
    }
}
$hubSignature = $headers['x-hub-signature'] ?? '';

list($algo, $hash) = explode('=', $hubSignature, 2) + [null, null];
$payload = file_get_contents('php://input');
$payloadHash = hash_hmac($algo, $payload, $secret);

// Verify signature matching
if ($hash === $payloadHash) {
    // Run the git pull command on the current folder directory
    exec('cd ' . __DIR__ . ' && git pull 2>&1', $output);
    echo "Success:\n" . implode("\n", $output);
} else {
    header('HTTP/1.1 403 Forbidden');
    echo "Access Denied.";
}
