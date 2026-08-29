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
    // 1. Pull the latest code updates from GitHub
    exec('cd ' . __DIR__ . ' && git pull 2>&1', $output);

    // 2. Force cPanel to deploy the files using your .cpanel.yml instructions
    exec('/usr/local/cpanel/bin/git-deploy 2>&1', $deploy_output);

    // Format the response log clearly for your GitHub panel
    echo "=== Git Pull Log ===\n" . implode("\n", $output) . "\n\n";
    echo "=== cPanel Deployment Log ===\n" . implode("\n", $deploy_output);
} else {
    header('HTTP/1.1 403 Forbidden');
    echo "Access Denied.";
}
