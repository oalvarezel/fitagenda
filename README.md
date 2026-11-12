# FitAgenda — Sistema de Agendamento de Aulas Esportivas

## Sobre o projeto

O **FitAgenda** é um sistema web desenvolvido como trabalho acadêmico da disciplina de Desenvolvimento Web, do curso de Gestão da Tecnologia da Informação, no semestre 2026.2.

O objetivo é criar uma plataforma para gerenciar agendamentos de atividades esportivas de maneira simples, organizada e intuitiva.

O projeto terá foco na construção de uma interface moderna e responsiva, integrada a funcionalidades de processamento e armazenamento de dados.

**Status:** Em desenvolvimento.

## Tecnologias utilizadas

O projeto será desenvolvido utilizando:

- **HTML5:** estruturação das páginas.
- **CSS3:** estilização e responsividade.
- **JavaScript:** interatividade e validação dos formulários.
- **PHP:** processamento das informações no servidor.
- **MySQL:** armazenamento e gerenciamento dos dados.
- **Git e GitHub:** versionamento e colaboração.

## Funcionalidades previstas

- Cadastro de agendamentos esportivos.
- Visualização dos agendamentos cadastrados.
- Edição das informações dos registros.
- Exclusão de agendamentos.
- Pesquisa por nome do aluno.
- Filtros por status.
- Painel inicial com indicadores.
- Interface responsiva para diferentes dispositivos.

O sistema utilizará operações **CRUD (Create, Read, Update e Delete)**, permitindo criar, consultar, atualizar e excluir registros no banco de dados.

## Organização da equipe

O desenvolvimento será dividido em quatro áreas:

| Integrante | Responsabilidade | Branch |
|---|---|---|
| Pessoa 1 | Front-end, design e painel inicial | `feat/interface` |
| Pessoa 2 | Formulários, cadastro e edição | `feat/cadastro` |
| Pessoa 3 | Listagem, pesquisa e exclusão | `feat/consulta` |
| Pessoa 4 | Banco de dados, integração e testes | `feat/banco` |

As funcionalidades serão desenvolvidas individualmente e integradas por meio de Pull Requests.

## Organização do repositório

- **`main`:** versão oficial e integrada do sistema.
- **`feat/interface`:** desenvolvimento da interface.
- **`feat/cadastro`:** cadastro e edição.
- **`feat/consulta`:** listagem, pesquisa e exclusão.
- **`feat/banco`:** banco de dados e conexão PHP.

Todas as modificações deverão ser testadas antes de sua integração à branch principal.

## Como executar o projeto

O ambiente previsto utiliza PHP, MySQL e XAMPP. Para criar a estrutura, importe `database/fitagenda.sql` pelo phpMyAdmin. O arquivo cria o banco `fitagenda` e a tabela `agendamentos` caso ainda não existam, sem apagar registros.

Em ambiente XAMPP, a conexão PHP usa por padrão `localhost`, banco `fitagenda`, usuário `root` e senha vazia. Para outros ambientes, configure `DB_HOST`, `DB_NAME`, `DB_USER` e `DB_PASSWORD` no ambiente do PHP. O CI do GitHub Actions fornece suas próprias credenciais.

Os dados fictícios em `database/seeds.sql` são opcionais. Importe-os pelo phpMyAdmin com o banco `fitagenda` selecionado ou execute `mysql -u root fitagenda < database/seeds.sql`. Uma segunda execução sequencial não deve duplicar os exemplos que já existam; os scripts não apagam nem atualizam registros existentes. A verificação não é atômica: execuções simultâneas ainda podem inserir duplicatas.

Para preparar a apresentação presencial, inicie Apache e MySQL no XAMPP, importe a estrutura no computador da apresentação, configure a conexão caso os padrões locais sejam diferentes e carregue os seeds apenas se desejar exemplos iniciais. Os registros criados ficam no MySQL local. Cada integrante tem um banco independente; GitHub compartilha código e scripts, não os dados locais. Consulte [docs/instalacao.md](docs/instalacao.md) para o passo a passo completo.

## Referência

O projeto utiliza como referência didática o repositório [Academia — CRUD de Alunos](https://github.com/Alex5762/academia-alunos-crud).

O FitAgenda será desenvolvido com identidade visual, estrutura de dados e funcionalidades próprias.

## Informações acadêmicas

**Curso:** Gestão da Tecnologia da Informação

**Disciplina:** ARA2739 — Desenvolvimento Web em HTML5, CSS, JavaScript e PHP

**Professor:** Felipe Alves de Oliveira

**Semestre:** 2026.2

**Data de entrega:** 18/11/2026

**Equipe:** 4 integrantes

## Objetivo acadêmico

Aplicar os conhecimentos adquiridos durante a disciplina por meio do desenvolvimento colaborativo de um sistema web funcional, integrando front-end, back-end e banco de dados.
