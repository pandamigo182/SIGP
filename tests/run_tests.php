<?php
// Simple Test Runner
// Execute via CLI: php tests/run_tests.php

// 1. Environment Setup
define('APPROOT', dirname(__DIR__) . '/app');
define('URLROOT', 'http://localhost/SIGP');
define('SITENAME', 'TestEnv');

// Require Config (Bootstraps .env)
require_once APPROOT . '/config/config.php';
require_once APPROOT . '/core/Database.php';
// Require Helpers
require_once APPROOT . '/helpers/validation_helper.php';
require_once APPROOT . '/helpers/security_helper.php';

$passed = 0;
$failed = 0;

function assertTest($condition, $message){
    global $passed, $failed;
    if($condition){
        echo " [PASS] $message\n";
        $passed++;
    } else {
        echo " [FAIL] $message\n";
        $failed++;
    }
}

echo "Running SIGP Tests...\n";
echo "=====================\n";

// --- Test 1: Validation Helper ---
echo "\nTesting validation_helper.php:\n";
assertTest(validateEmail('test@test.com') == true, 'Valid Email');
assertTest(validateEmail('invalid-email') == false, 'Invalid Email');
assertTest(validateName('Juan Perez') == true, 'Valid Name');
assertTest(validateName('Juan123') == false, 'Invalid Name (Numbers)');
assertTest(validateUrl('https://google.com') == true, 'Valid URL (HTTPS)');
// assertTest(validateUrl('google.com') == false, 'Invalid URL (No Protocol)'); // Depends on implementation

// --- Test 2: Security Helper ---
echo "\nTesting security_helper.php:\n";
$raw = "<script>alert('xss')</script>";
$sanitized = sanitizeString($raw);
assertTest($sanitized === 'alert(&#039;xss&#039;)', 'Sanitize String removes/encodes tags');

// Add more tests here...


// --- Test 3: Database Connection & Transaction ---
echo "\nTesting Database Integration:\n";
try {
    $db = new Database();
    // Verify connection indirectly via a simple query
    $db->query("SELECT 1 as val");
    $res = $db->single();
    assertTest($res->val == 1, 'Database Connection Successful');

    // Transaction Test
    // Note: Database class might not expose beginTransaction directly.
    // Let's check Database.php. It exposes $dbh indirectly? No, it's private.
    // We might need to add beginTransaction to Database.php or use raw PDO if we could access it.
    // Wait, Database.php doesn't have beginTransaction/commit/rollBack methods exposed.
    // We should ADD them to Database.php first for proper testing and usage.
    
    // For now, let's just query.
    $db->query("SELECT count(*) as c FROM usuarios");
    $count = $db->single()->c;
    assertTest(is_numeric($count), 'Can query existing users table');

    // TEST TRANSACTION: Insert -> Check -> Rollback -> Check
    $db->beginTransaction();
    $testEmail = 'test_transaction_' . time() . '@test.com';
    
    // Insert Mock User
    $db->query("INSERT INTO usuarios (nombre, email, password, role_id) VALUES (:nom, :email, :pass, 5)");
    $db->bind(':nom', 'Test Transaction User');
    $db->bind(':email', $testEmail);
    $db->bind(':pass', '123456');
    $db->execute();
    
    // Verify it exists INSIDE transaction
    $db->query("SELECT * FROM usuarios WHERE email = :email");
    $db->bind(':email', $testEmail);
    $row = $db->single();
    assertTest($row && $row->email === $testEmail, 'User inserted inside transaction');
    
    // Rollback
    $db->rollBack();
    
    // Verify it does NOT exist after rollback
    $db->query("SELECT * FROM usuarios WHERE email = :email");
    $db->bind(':email', $testEmail);
    $rowRefuted = $db->single(); // single() fetches. rowCount() helps too.
    assertTest(!$rowRefuted, 'User removed after rollback');

} catch(Exception $e){
    assertTest(false, 'Database Error: ' . $e->getMessage());
}

echo "\n=====================\n";
echo "Results: $passed Passed, $failed Failed.\n";

if($failed > 0) exit(1);
