# FitAgenda - instalação do banco de dados

## 1. requisitos
- windows
- xampp instalado
- apache e mysql habilitados
- navegador de internet

## 2. iniciar o xampp
1. abra o xampp control panel.
2. inicie o apache.
3. inicie o mysql.
4. confira se os dois serviços estão funcionando.

## 3. criar o banco de dados
1. acesse http://localhost/phpmyadmin
2. entre na opção importar.
3. selecione o arquivo database/fitagenda.sql.
4. execute a importação.

o banco fitagenda e a tabela agendamentos serão criados caso ainda não existam. a estrutura não apaga os registros existentes.

## 4. inserir dados de teste
os dados fictícios são opcionais e podem ser carregados pelo arquivo database/seeds.sql.

1. na opção SQL do phpMyAdmin, selecione o banco fitagenda.
2. abra o arquivo database/seeds.sql.
3. copie seu conteúdo.
4. cole na área SQL do phpMyAdmin.
5. execute.

uma segunda execução sequencial não duplica os exemplos existentes, pois o script compara nome, atividade, data e horário.

os scripts não apagam nem atualizam registros existentes.

observação: duas execuções simultâneas ainda podem inserir duplicatas, pois a verificação não é atômica.

## 5. configurar a conexão php
o arquivo de conexão está em: config/database.php

configuração local padrão do xampp:
- host: localhost
- banco: fitagenda
- usuário: root
- senha: vazia

também é possível configurar a conexão usando as variáveis de ambiente:
- DB_HOST
- DB_NAME
- DB_USER
- DB_PASSWORD

quando essas variáveis não forem configuradas, serão utilizados os padrões do xampp.

## 6. estrutura da tabela
a tabela agendamentos possui os seguintes campos:
- id
- nome_aluno
- atividade
- data_aula
- horario
- status

status permitidos:
- agendado
- concluido
- cancelado

## 7. observação
cada integrante deverá executar o script sql em seu próprio ambiente local.

os dados do mysql não são compartilhados automaticamente pelo github. cada integrante possui seu próprio banco de dados.

para a apresentação, iniciar apache e mysql no xampp, importar a estrutura do banco no computador que será utilizado e carregar os dados fictícios somente se forem úteis para a demonstração.