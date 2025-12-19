<?php
/**
 * Validation Helper
 * Provides static methods for common validation tasks.
 */

function validateName($name) {
    // Permitir letras, espacios, acentos y ñ. No números ni símbolos especiales.
    return preg_match('/^[a-zA-Z\sñÑáéíóúÁÉÍÓÚ]+$/', $name);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    // Al menos 6 caracteres, sin espacios en blanco al inicio o fin (ya se hace trim)
    return strlen($password) >= 6;
}

function validateNit($nit) {
    // Formato simple: solo números y guiones
    return preg_match('/^[0-9-]+$/', $nit);
}

function validatePhone($phone) {
    // Formato: números, guiones, espacios, paréntesis, +
    return preg_match('/^[0-9\-\+\s\(\)]+$/', $phone);
}

function validateUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

