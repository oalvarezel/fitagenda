# Relatório de desenvolvimento — FitAgenda

**Responsável:** Thiago Gomes Fernandes de Souza (Pessoa 3)  
**Data:** 17/11/2026  
**Tempo dedicado:** aproximadamente 3 horas  
**Branch:** `feat/consulta`  
**Status:** Etapa individual concluída

## 1. Objetivo do trabalho

Desenvolver as funcionalidades de listagem, pesquisa, filtros e exclusão de agendamentos do FitAgenda. A proposta era permitir que os registros fossem visualizados de forma organizada, que o usuário encontrasse agendamentos pelo nome do aluno ou pelo status e que pudesse excluir registros quando necessário. Também fez parte da responsabilidade integrar o botão de edição à página desenvolvida pela Pessoa 2.

## 2. Responsabilidade e metodologia de desenvolvimento

Fiquei responsável pela Pessoa 3, concentrando o trabalho na consulta e no gerenciamento dos agendamentos. O desenvolvimento foi realizado localmente, no Visual Studio Code, utilizando PHP com PDO, MySQL, HTML, Bootstrap e JavaScript para a confirmação de exclusões.

A construção e os ajustes dos arquivos foram conduzidos pelo responsável, com escrita e organização do código no editor. O ChatGPT foi utilizado como apoio para esclarecer o funcionamento de comandos, revisar a lógica de pesquisa e filtragem, orientar validações de parâmetros e identificar problemas de segurança e integração. Os exemplos e orientações recebidos foram aplicados e testados no ambiente local.

O processo seguiu estas etapas:

1. Estruturação da página de listagem dos agendamentos e do arquivo de exclusão.
2. Implementação da consulta ao banco de dados usando a conexão PDO do projeto.
3. Criação da pesquisa por nome e do filtro por status, recebidos por parâmetros `GET`.
4. Organização da tabela e formatação das informações apresentadas ao usuário.
5. Implementação da exclusão por `POST`, com validação do identificador e confirmação antes do envio.
6. Integração do botão Editar à página da Pessoa 2.
7. Revisão dos arquivos, correção de erros e testes no XAMPP com os dados do MySQL.

## 3. Atividades realizadas

### Listagem de agendamentos

- Desenvolvimento de `list/lista.php` para consultar os registros da tabela `agendamentos`.
- Utilização da conexão PDO centralizada em `config/database.php`, disponibilizada pela Pessoa 4.
- Construção de tabela dinâmica para exibir ID, aluno, atividade, data, horário, status e ações.
- Formatação das datas no padrão brasileiro (`d/m/Y`) e exibição dos horários de maneira simplificada.
- Identificação visual dos status agendado, concluído e cancelado por meio de badges com cores diferentes.
- Utilização de `htmlspecialchars()` para exibir textos recebidos do banco com tratamento adequado de caracteres especiais.

### Pesquisa e filtros

- Implementação de pesquisa pelo nome do aluno utilizando o operador SQL `LIKE`.
- Recebimento dos parâmetros de busca e status pelo método `GET`.
- Validação dos status permitidos com `in_array()`, evitando utilizar valores não previstos no banco.
- Montagem dinâmica da consulta SQL e uso de parâmetros preparados com PDO, em vez de concatenar valores diretamente na instrução.
- Ordenação dos agendamentos pelo ID em ordem decrescente, deixando os mais recentes no início da tabela.

### Exclusão de registros

- Desenvolvimento do arquivo `list/excluir.php` para processar pedidos de exclusão.
- Utilização do método `POST`, evitando executar a exclusão por um simples link de navegação.
- Validação do ID recebido com `filter_input()` e `FILTER_VALIDATE_INT`.
- Execução de `DELETE FROM agendamentos WHERE id = ?` com consulta preparada.
- Inclusão de confirmação em JavaScript, usando `confirm()`, antes de enviar o formulário de exclusão.
- Redirecionamento para a listagem após a operação.

### Integração com a edição

- Criação e conferência do botão Editar para cada linha da tabela.
- Envio do ID do registro pela URL, no formato `editar.php?id=...`.
- Integração com a página `pages/editar.php`, desenvolvida pela Pessoa 2, mantendo a responsabilidade pela atualização dos dados com essa pessoa.

### Revisões e testes

- Ajustes de caminhos dos arquivos PHP para utilizar a conexão correta do projeto.
- Revisão de nomes de colunas e valores de status para coincidir com a estrutura MySQL.
- Testes locais de exibição de registros, pesquisa, filtros e exclusão de um agendamento de teste.
- Participação na verificação do CRUD integrado, com confirmação de que a exclusão removia o registro da tabela MySQL.

## 4. Arquivos trabalhados

Os arquivos da etapa individual foram:

- `list/lista.php`
- `list/excluir.php`

Os caminhos acima correspondem à organização dos arquivos no projeto FitAgenda enviado para integração.

## 5. Git e GitHub

O desenvolvimento foi organizado em uma branch individual, identificada no registro da atividade como `feat/consulta`, para manter as alterações separadas da branch principal.

Após os testes locais, os arquivos foram compartilhados para integração com as funcionalidades de cadastro e edição. Durante a integração, foram verificados os caminhos das páginas e a compatibilidade das consultas com o banco de dados.

A etapa individual foi concluída antes da consolidação definitiva do projeto na branch `main`.

## 6. Resultado final

A etapa correspondente à Pessoa 3 foi concluída. O FitAgenda passou a oferecer uma página de gerenciamento com consulta aos dados reais, pesquisa por nome, filtro por status, identificação visual dos registros e exclusão com confirmação.

A integração do botão Editar também permitiu encaminhar o usuário para a funcionalidade desenvolvida pela Pessoa 2, contribuindo para o funcionamento do CRUD completo.

**Responsável pela atividade:** Thiago Gomes Fernandes de Souza  
**Tempo dedicado:** aproximadamente 3 horas  
**Status da etapa individual:** Concluída.

---

*Relatório organizado com apoio do ChatGPT a partir das atividades informadas pelo responsável e dos arquivos do projeto. A IA foi utilizada para orientação, explicações técnicas, revisão da lógica e auxílio na identificação de problemas. A implementação e os testes foram conduzidos pelo integrante.*
