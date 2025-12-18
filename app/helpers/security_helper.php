<?php
/**
 * Security Helper
 * Handles CSRF tokens and IP extraction.
 */

/*
 * Generate CSRF Token
 * Creates a token and stores it in session if not exists.
 * Returns the token.
 */
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/*
 * Validate CSRF Token
 * Checks if the posted token matches the session token.
 * Returns boolean.
 */
function validateCsrfToken($token) {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/*
 * Get Client IP Address
 * Attempts to get the most accurate IP address.
 */
function getClientIp() {
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return sanitizeString($ip); // Using validation_helper
}

/*
 * Get User Agent
 */
function getUserAgent() {
    return isset($_SERVER['HTTP_USER_AGENT']) ? sanitizeString($_SERVER['HTTP_USER_AGENT']) : 'Unknown';
}

/*
 * Sanitize String
 * Sanitizes a string for safe output.
 */
function sanitizeString($str) {
    if (is_null($str)) {
        return '';
    }
    return htmlspecialchars(strip_tags(trim($str)), ENT_QUOTES, 'UTF-8');
}
