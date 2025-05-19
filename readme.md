Descrição do Projeto:

Site Institucional para Imobiliária com Painel Administrativo.
Este projeto consiste no desenvolvimento completo de um site institucional para uma imobiliária, com objetivo de divulgar imóveis disponíveis para venda e aluguel, apresentar a empresa e seus serviços, e permitir a gestão de conteúdo através de um painel administrativo protegido por login.

Tecnologias Utilizadas
HTML5 e CSS3: Estrutura e estilização das páginas.
Bootstrap: Framework front-end utilizado para garantir responsividade e design moderno.
PHP: Linguagem de programação usada no back-end para lógica de autenticação, conexão com banco de dados e exibição dinâmica dos imóveis.
MySQL com phpMyAdmin: Banco de dados relacional utilizado para armazenar informações de usuários e imóveis.
XAMPP: Servidor local utilizado para executar o projeto durante o desenvolvimento (Apache + MySQL).
JavaScript (Bootstrap ): Para funcionalidades como o carrossel de imagens e dropdowns.

Estrutura de Páginas
Home: Exibição dinâmica dos imóveis em destaque (últimos cadastrados, à venda e para alugar), com carrossel/banner no topo.
Imóveis: Listagem completa dos imóveis disponíveis, com filtros por tipo (venda, aluguel).
Sobre: Informações institucionais da imobiliária, missão, visão e valores.
Serviços: Detalhamento dos serviços prestados, como avaliação, intermediação e consultoria.
Contato: Formulário de contato funcional, com dados enviados por e-mail ou armazenados no banco (opcional).
Área Admin (restrita): Login protegido com sessões PHP. Após o login, o usuário tem acesso ao painel para cadastrar, editar e excluir imóveis, com upload de imagens.



<!-- estrutura do projeto -->
Estrutura do Projeto IMOBILIARIA

IMOBILIARIA/
├── admin/ # Painel administrativo (restrito a usuários logados)
│ ├── adicionar.php # Página para adicionar novo imóvel
│ ├── editar.php # Página para editar imóvel existente
│ ├── excluir.php # Página para excluir imóvel
│ ├── imoveis.php # Painel com listagem dos imóveis
│ ├── index.php # Página de login do admin
│ └── logout.php # Encerrar sessão do administrador
│
├── assets/ # Recursos estáticos (estilos, scripts, imagens)
│ ├── css/
│ ├── img/
│ ├── js/
│ └── responsividade/
│ └── responsividade.css # CSS para tornar o site responsivo
│
├── includes/ # Arquivos comuns utilizados em múltiplas páginas
│ ├── db.php # Conexão com o banco de dados (PDO)
│ ├── footer.php # Rodapé do site
│ └── header.php # Cabeçalho do site
│
├── aluguel.php # Página com listagem de imóveis para aluguel
├── contato.php # Página de formulário de contato
├── detalhes.php # Página com detalhes de um imóvel específico
├── home.php # Página inicial (com imóveis em destaque)
├── imoveis.php # Página com todos os imóveis
├── servicos.php # Página com a lista de serviços oferecidos
├── sobre.php # Página "Sobre nós"
└── venda.php # Página com listagem de imóveis à venda
