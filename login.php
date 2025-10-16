<?php
require_once 'security.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (login($username, $password)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Usuário ou senha inválidos!';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 350px;">
        <h2 class="card-title text-center mb-4">Login</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Usuário:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Senha:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary w-50 me-2">Entrar</button>
        <button type="button" class="btn btn-secondary w-50" onclick="window.history.back();">Voltar</button>
    </div>
</form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>