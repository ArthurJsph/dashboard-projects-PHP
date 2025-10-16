<?php
session_start();
require_once 'conexao.php';

try {
    $stmt = $pdo->query('SELECT * FROM projetos ORDER BY id DESC');
    $projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $projetos_json = json_encode($projetos);
} catch (PDOException $e) {
    $projetos_json = json_encode([]);
}

$isAdmin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Portfólio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <div id="root"></div>

    <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script type="text/babel">
        const initialProjects = <?php echo $projetos_json; ?>;

        function App() {
            const isAdmin = <?php echo $isAdmin ? 'true' : 'false'; ?>;
            const [projects, setProjects] = React.useState(initialProjects);

            return (
                <div className="container mt-4">
                    <nav className="d-flex justify-content-between align-items-center py-3 mb-4 border-bottom">
                        <h1 class="h2">Meu Portfólio</h1>
                        <div>
                            {isAdmin ? (
                                <a href="dashboard.php" className="btn btn-primary">Painel Admin</a>
                            ) : (
                                <a href="login.php" className="btn btn-secondary">Login</a>
                            )}
                        </div>
                    </nav>
                    
                    {projects.length > 0 ? (
                        <div className="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            {projects.map(project => (
                                <div className="col" key={project.id}>
                                    <div className="card h-100 shadow-sm">
                                        <img src={project.imagem_url} className="card-img-top" alt={`Imagem do projeto ${project.titulo}`} style={{ height: '200px', objectFit: 'cover' }} />
                                        <div className="card-body">
                                            <h5 class="card-title">{project.titulo}</h5>
                                            <p class="card-text text-muted">{project.descricao}</p>
                                        </div>
                                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                                            <a href={project.link_github} target="_blank" className="btn btn-outline-dark">GitHub</a>
                                            <a href={project.link_deploy} target="_blank" className="btn btn-outline-success">Ver Deploy</a>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div class="alert alert-info text-center" role="alert">
                            Nenhum projeto encontrado.
                        </div>
                    )}
                </div>
            );
        }

        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
</body>
</html>