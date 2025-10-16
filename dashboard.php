<?php
require_once 'security.php';
require_once 'conexao.php';

checkLogin();

$stmt = $pdo->query('SELECT * FROM projetos ORDER BY id DESC');
$projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$current_user = $_SESSION['username'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center pb-2 mb-4 border-bottom">
            <h2 class="h2">Painel de Administração</h2>
            <div class="d-flex align-items-center">
                <p class="mb-0 me-3 d-none d-md-block">Olá, <span class="fw-bold"><?php echo htmlspecialchars($current_user); ?></span>!</p>
                <a href="home.php" class="btn btn-secondary me-2">Home</a>
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <h3 class="card-title">Adicionar Novo Projeto</h3>
            <form action="controller.php?action=adicionar_projeto" method="POST">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="imagem_url" class="form-label">URL da Imagem</label>
                    <input type="text" class="form-control" id="imagem_url" name="imagem_url">
                </div>
                <div class="mb-3">
                    <label for="link_github" class="form-label">Link do GitHub</label>
                    <input type="text" class="form-control" id="link_github" name="link_github">
                </div>
                <div class="mb-3">
                    <label for="link_deploy" class="form-label">Link de Deploy</label>
                    <input type="text" class="form-control" id="link_deploy" name="link_deploy">
                </div>
                <div class="mb-3">
                    <label for="tecnologias_usadas" class="form-label">Tecnologias (separadas por vírgula)</label>
                    <input type="text" class="form-control" id="tecnologias_usadas" name="tecnologias_usadas">
                </div>
                <button type="submit" class="btn btn-primary w-100">Adicionar Projeto</button>
            </form>
        </div>

        <hr>

        <h3 class="mt-4 mb-3">Projetos Existentes</h3>
        <ul class="list-group">
            <?php foreach ($projetos as $projeto): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="h5 mb-1"><?php echo htmlspecialchars($projeto['titulo']); ?></h4>
                        <p class="mb-1 text-muted"><?php echo nl2br(htmlspecialchars($projeto['descricao'])); ?></p>
                        <small>ID: <?php echo htmlspecialchars($projeto['id']); ?></small>
                    </div>
                    <div>
                        <a href="edit.php?id=<?php echo $projeto['id']; ?>" class="btn btn-sm btn-primary me-2">Editar</a>
                        <a href="controller.php?action=deletar_projeto&id=<?php echo $projeto['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar?');">Deletar</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>