#Fifagenda - instalação do banco de dados
## 1. requisistos
-windows
-xampp instalado
-apache e mysql habilitados
-navegador de internet

## 2. iniciar o xampp
1. abra o xampp control painel.
2. inicie o apache.
3. inicie o mysql.
4. confira se os dois serviços estão funcionando

## 3. criar o banco de dados
1. acesse http:localhost/phpmyadmin
2. entre na opção importar.
3. selecione o arquivo database/fitagenda.sql.
4. execute a importação.

o banco fitagenda e a tabela agendamentos serão criados.

## 4. inserir dados de teste
1. na opção sql do phpmyadmin, selecione o banco fitagenda
2. abra o arquivo database/seeds.sql.
3. copie seu conteudo.
4. cole na área sql do phpmyadmin.
5. execute.

## 5. configurar a conexão php
o arquivo de conexão está em: config/database.php
configuração local padrão do xampp
-host: localhost
-banco: fitagenda
-usuario: root
-senha: vazia

## 6. estrutura da tabela
a tabela agendamentos possui os seguintes campos:
-id
-nome_aluno
-atividade
-data_aula
-horario
-status

status permitidos:
-agendado
-concluido
-cancelado

## 7. observação
cada integrante deverá executar o script sql em seu proprio ambiente local.

os dados do mysql não são compartilhados automaticamente pelo github.
