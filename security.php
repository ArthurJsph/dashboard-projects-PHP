<?php
// admin/security.php

session_start();

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function login($username, $password) {
    $admin_user = $_ENV['ADMIN_USER'];
    $admin_pass = $_ENV['ADMIN_PASS'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        return true;
    }
    return false;
}

function checkLogin() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit();
    }
}

function logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}