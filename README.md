# 📊 Dashboard de Projetos - PHP Puro

Um sistema completo de gerenciamento de portfólio desenvolvido em **PHP puro** para fins educacionais, demonstrando conceitos fundamentais de desenvolvimento web backend.

## 🎯 Objetivo do Projeto

Este projeto foi criado para demonstrar e ensinar conceitos essenciais do PHP puro, incluindo:
- Autenticação e autorização
- Operações CRUD com banco de dados
- Estrutura MVC básica
- Segurança em aplicações web
- Integração frontend/backend

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 8+ (puro, sem frameworks)
- **Frontend**: HTML, CSS, Bootstrap 5, React (via CDN)
- **Banco de Dados**: MySQL
- **Servidor Local**: XAMPP
- **Gerenciamento de Dependências**: Composer
- **Segurança**: DotEnv para variáveis de ambiente

## 📋 Funcionalidades

### 🔐 Sistema de Autenticação
- Login seguro com sessões PHP
- Middleware de proteção de rotas
- Logout com limpeza de sessão

### 📱 Área Pública (Home)
- Exibição do portfólio de projetos
- Interface responsiva com Bootstrap
- Componentes React para interatividade

### 👨‍💻 Painel Administrativo
- Adicionar novos projetos
- Editar projetos existentes
- Excluir projetos
- Visualização em tempo real

### 🗄️ Gerenciamento de Dados
- CRUD completo de projetos
- Conexão segura com MySQL via PDO
- Prepared statements para prevenir SQL Injection

## 🏗️ Estrutura do Projeto

```
dashboard-projects/
├── 📄 api.php           # Endpoints da API REST
├── 🔌 conexao.php       # Configuração da conexão com banco
├── 🎮 controller.php    # Controlador principal (CRUD)
├── 📊 dashboard.php     # Painel administrativo
├── ✏️ edit.php          # Página de edição de projetos
├── 🏠 home.php          # Página inicial pública
├── 🔐 login.php         # Página de login
├── 🚪 logout.php        # Script de logout
├── 🛡️ security.php      # Funções de segurança e autenticação
├── 📝 README.md         # Documentação do projeto
└── 🔒 .gitignore        # Arquivos ignorados pelo Git
```

## 🚀 Como Executar

### Pré-requisitos
- XAMPP instalado
- PHP 8.0+
- MySQL
- Composer

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone https://github.com/ArthurJsph/dashboard-projects-PHP.git
   cd dashboard-projects-PHP
   ```

2. **Instale as dependências**
   ```bash
   composer install
   ```

3. **Configure o banco de dados**
   - Crie um banco MySQL chamado `dashboard_projetos`
   - Execute o script SQL abaixo:
   
   ```sql
   CREATE TABLE projetos (
       id INT AUTO_INCREMENT PRIMARY KEY,
       titulo VARCHAR(255) NOT NULL,
       descricao TEXT,
       imagem_url VARCHAR(500),
       link_github VARCHAR(500),
       link_deploy VARCHAR(500),
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```

4. **Configure as variáveis de ambiente**
   - Crie um arquivo `.env` na raiz do projeto:
   
   ```env
   # Configuração do Banco de Dados
   DB_HOST=localhost
   DB_NAME=dashboard_projetos
   DB_USER=root
   DB_PASSWORD=
   DB_PORT=3306
   
   # Credenciais do Administrador
   ADMIN_USER=admin
   ADMIN_PASS=123456
   ```

5. **Inicie o servidor**
   - Coloque o projeto na pasta `htdocs` do XAMPP
   - Inicie Apache e MySQL no painel do XAMPP
   - Acesse: `http://localhost/dashboard-projects/home.php`

## 📚 Conceitos PHP Demonstrados

### 1. **Estrutura de Sessões**
```php
session_start();
$_SESSION['admin_logged_in'] = true;
```

### 2. **Conexão com Banco (PDO)**
```php
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

### 3. **Prepared Statements**
```php
$stmt = $pdo->prepare("INSERT INTO projetos (titulo, descricao) VALUES (?, ?)");
$stmt->execute([$titulo, $descricao]);
```

### 4. **Middleware de Autenticação**
```php
function checkLogin() {
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit();
    }
}
```

### 5. **Sanitização de Dados**
```php
$titulo = htmlspecialchars($_POST['titulo']);
```

## 🔒 Segurança Implementada

- ✅ Uso de prepared statements (previne SQL Injection)
- ✅ Sanitização de dados de entrada
- ✅ Validação de sessões
- ✅ Variáveis de ambiente para credenciais
- ✅ Headers de segurança CORS
- ✅ Validação de métodos HTTP

## 🌐 Endpoints da API

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api.php?action=listar_projetos` | Lista todos os projetos |
| POST | `/controller.php?action=adicionar_projeto` | Adiciona novo projeto |
| POST | `/controller.php?action=editar_projeto` | Edita projeto existente |
| POST | `/controller.php?action=excluir_projeto` | Exclui projeto |

## 📖 Aprendizados Práticos

Este projeto aborda conceitos fundamentais para quem está aprendendo PHP:

1. **Estrutura MVC básica** - Separação de responsabilidades
2. **Manipulação de formulários** - $_POST, $_GET, validação
3. **Gerenciamento de sessões** - Login, logout, middleware
4. **Operações de banco** - CRUD completo com PDO
5. **Segurança web** - Prevenção de ataques comuns
6. **Estrutura de projeto** - Organização de arquivos PHP

## 🎓 Para Estudantes

Este projeto é ideal para:
- Estudantes iniciantes em PHP
- Desenvolvedores migrando de outras linguagens
- Quem quer entender conceitos web fundamentais
- Preparação para frameworks (Laravel, CodeIgniter, etc.)

## 🤝 Contribuições

Contribuições são bem-vindas! Este é um projeto educacional, então:
- Foque na clareza e simplicidade do código
- Documente bem as mudanças
- Mantenha os comentários em português
- Priorize código didático sobre otimizações complexas

## 📄 Licença

Este projeto está sob licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👨‍💻 Autor

**Arthur Joseph**
- GitHub: [@ArthurJsph](https://github.com/ArthurJsph)

---

*Projeto desenvolvido para fins educacionais - PHP Puro em ação! 🚀*