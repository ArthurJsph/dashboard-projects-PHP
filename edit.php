<?php
require_once 'security.php';
require_once 'conexao.php';

checkLogin();

$id = $_GET['id'] ?? 0;
$projeto = null;
$error = '';

if ($id > 0) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = ?');
        $stmt->execute([$id]);
        $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$projeto) {
            $error = 'Projeto não encontrado!';
        }
    } catch (PDOException $e) {
        $error = 'Erro ao buscar projeto no banco de dados.';
    }
} else {
    $error = 'ID do projeto não fornecido.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Projeto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Editar Projeto</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $error; ?>
            </div>
            <p class="text-center"><a href="dashboard.php" class="btn btn-secondary mt-3">Voltar para o Dashboard</a></p>
        <?php else: ?>
            <div class="card p-4 shadow-sm">
                <form action="controller.php?action=editar_projeto" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($projeto['id']); ?>">
                    
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($projeto['titulo']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="5"><?php echo htmlspecialchars($projeto['descricao']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagem_url" class="form-label">URL da Imagem</label>
                        <input type="text" class="form-control" id="imagem_url" name="imagem_url" value="<?php echo htmlspecialchars($projeto['imagem_url']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="link_github" class="form-label">Link do GitHub</label>
                        <input type="text" class="form-control" id="link_github" name="link_github" value="<?php echo htmlspecialchars($projeto['link_github']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="link_deploy" class="form-label">Link de Deploy</label>
                        <input type="text" class="form-control" id="link_deploy" name="link_deploy" value="<?php echo htmlspecialchars($projeto['link_deploy']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tecnologias_usadas" class="form-label">Tecnologias (separadas por vírgula)</label>
                        <input type="text" class="form-control" id="tecnologias_usadas" name="tecnologias_usadas" value="<?php echo htmlspecialchars($projeto['tecnologias_usadas']); ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary w-50 me-2">Salvar Alterações</button>
                        <a href="dashboard.php" class="btn btn-secondary w-50">Cancelar</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>