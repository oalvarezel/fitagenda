# Relatório de desenvolvimento — FitAgenda

**Responsável:** Isaac (Pessoa 2)  
**Data do relatório:** 17/11/2026  
**Período:** desenvolvimento realizado em diferentes sessões, até 17/11/2026  
**Tempo dedicado:** não cronometrado  
**Branch:** `feat/cadastro`  
**Status:** Etapa individual concluída e funcionalidades testadas localmente

## 1. Objetivo do trabalho

Desenvolver as funcionalidades de cadastro e edição de agendamentos do FitAgenda, incluindo os formulários, a validação dos dados e a comunicação com o banco MySQL. A proposta era permitir que o usuário registrasse uma aula esportiva e, posteriormente, alterasse as informações de um agendamento existente, sem precisar manipular o banco manualmente.

## 2. Responsabilidade e metodologia de desenvolvimento

Fiquei responsável pela Pessoa 2, com foco no cadastro e na edição. Trabalhei nos arquivos do projeto pelo Visual Studio Code, utilizando HTML, JavaScript e PHP. Para acompanhar as alterações, usei o GitHub Desktop e o GitHub; para executar o sistema localmente, utilizei o XAMPP, com Apache e MySQL.

A implementação foi feita por etapas, com escrita e ajustes do código no editor e testes após cada avanço. Usei o ChatGPT como apoio para organizar o trabalho, entender comandos e operadores, analisar mensagens de erro e receber orientações de correção. A ferramenta também serviu como referência para exemplos de sintaxe, que foram conferidos e ajustados durante a implementação. A execução dos testes, a configuração do ambiente e a integração com o repositório foram realizadas no computador do responsável.

O processo seguiu estas etapas:

1. Construção do formulário de cadastro e identificação dos campos necessários.
2. Implementação das validações em JavaScript, com testes de datas, horários e nome do aluno.
3. Conexão do formulário ao processamento PHP e à operação `INSERT` no MySQL.
4. Criação da página de edição, com busca do registro pelo ID e preenchimento automático dos campos.
5. Implementação do `UPDATE`, validação dos dados recebidos e mensagens de confirmação.
6. Correção de problemas encontrados nos testes e em conflitos de versionamento.
7. Integração com a listagem e com o visual desenvolvido pela Pessoa 1, seguida dos testes finais.

## 3. Atividades realizadas

### Formulário de cadastro

- Desenvolvimento de `pages/cadastro.php`, com os campos nome do aluno, atividade esportiva, data, horário e status.
- Utilização de atributos HTML como `name`, `id` e `required` para identificar os dados e facilitar a validação.
- Configuração do formulário para enviar os dados por `POST` ao arquivo `actions/salvar.php`.

### Validações com JavaScript

- Desenvolvimento do arquivo `assets/js/cadastro.js` para validar os dados antes do envio.
- Verificação do nome informado, removendo espaços extras com `trim()`.
- Comparação da data e do horário selecionados com o momento atual, impedindo agendamentos no passado.
- Correção do uso de `preventDefault()`: o envio passou a ser bloqueado apenas quando uma validação falhava, permitindo que os dados corretos chegassem ao PHP.

### Cadastro no MySQL

- Implementação de `actions/salvar.php`, aproveitando a conexão PDO disponibilizada pela Pessoa 4.
- Recebimento e validação dos valores enviados pelo formulário, incluindo atividade, status, data e horário.
- Utilização de consulta preparada para executar o `INSERT` na tabela `agendamentos`.
- Redirecionamento para a página de gerenciamento após o cadastro.

### Edição de agendamentos

- Criação de `pages/editar.php` para receber o ID do agendamento pela URL.
- Validação do ID com `filter_input()` e busca do registro por meio de `SELECT` com PDO.
- Preenchimento automático do formulário com os dados existentes, utilizando `htmlspecialchars()` na exibição dos valores.
- Desenvolvimento de `actions/atualizar.php`, responsável por receber os novos dados e executar o `UPDATE` apenas no registro selecionado, com `WHERE id = ?`.
- Inclusão de validação no PHP para impedir a marcação de agendamentos ativos em datas ou horários já passados.

### Mensagens, integração e correções

- Inclusão de parâmetros de sucesso no redirecionamento após cadastrar e editar.
- Participação na adaptação de `list/lista.php` para exibir mensagens de confirmação, em conjunto com a funcionalidade da Pessoa 3.
- Integração das páginas de cadastro e edição à identidade visual criada pela Pessoa 1, preservando a lógica dos formulários.
- Correção de conflitos no `cadastro.js` durante o uso do Git, inclusive alterações antigas guardadas em *stash*.
- Configuração e importação da estrutura do banco local para que os testes PHP funcionassem no XAMPP.

### Testes realizados

- Cadastro de agendamento pelo formulário e conferência do registro na listagem e no phpMyAdmin.
- Edição de um agendamento de teste e confirmação da alteração no MySQL por consulta `SELECT`.
- Testes de validação de dados e mensagens de sucesso.
- Participação na verificação integrada do CRUD, inclusive navegação, exclusão de um registro de teste e responsividade do sistema. A implementação do `DELETE` permaneceu sob responsabilidade da Pessoa 3.

## 4. Arquivos trabalhados

Os principais arquivos da etapa individual foram:

- `pages/cadastro.php`
- `assets/js/cadastro.js`
- `actions/salvar.php`
- `pages/editar.php`
- `actions/atualizar.php`

Também houve ajuste de integração em `list/lista.php` para exibir as mensagens de sucesso, sem substituir a responsabilidade da Pessoa 3 pela listagem.

## 5. Git e GitHub

O desenvolvimento foi realizado na branch `feat/cadastro`, com commits e envio das alterações ao GitHub. Durante o trabalho, ocorreram trocas de branch, utilização de *stash* e conflitos entre versões do JavaScript, que precisaram ser analisados e corrigidos antes de continuar.

Após os testes das funcionalidades individuais, as alterações passaram a ser integradas às outras partes do FitAgenda. A versão completa foi verificada no ambiente local antes da integração definitiva à branch `main`.

## 6. Resultado final

A etapa de cadastro e edição foi concluída e testada no ambiente local. O FitAgenda passou a permitir o registro de novos agendamentos, a recuperação dos dados já cadastrados e sua atualização pelo formulário, com persistência no MySQL.

Além da programação, esta etapa ajudou a compreender melhor o funcionamento do envio de formulários, das consultas preparadas, das validações no navegador e no servidor e da integração entre arquivos desenvolvidos por integrantes diferentes.

**Responsável pela atividade:** Isaac (Pessoa 2)  
**Tempo dedicado:** 8 horas  
**Status da etapa individual:** Concluída.

---

*Relatório organizado com apoio do ChatGPT a partir das atividades desenvolvidas e dos testes realizados. A IA foi utilizada como ferramenta de orientação, explicação de comandos, revisão e apoio à resolução de problemas. A implementação, os testes locais e as decisões de integração foram conduzidos pelo responsável.*
