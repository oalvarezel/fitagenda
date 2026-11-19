<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Define a codificação de caracteres e a largura da tela para responsividade. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Agendamento | FitAgenda</title>
    <!-- Importa os arquivos de estilo da interface. -->
    <link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/forms.css">
</head>

<body>
    <main class="pagina-formulario">
        <h1>Novo Agendamento</h1>
        <p>Preencha os dados para agendar uma aula esportiva.</p>
        <!-- O id permite localizar o formulário no JavaScript; action define o PHP de destino e POST envia os dados no corpo da requisição. -->
        <form id="form-cadastro" action="../actions/salvar.php" method="POST" class="formulario-agendamento">
            <div>
                <!-- O label identifica o campo. name é a chave recebida em PHP, id permite localizá-lo no DOM, required exige preenchimento e maxlength limita o tamanho. -->
                <label for="nome_aluno">Nome do aluno</label>
                <input type="text" id="nome_aluno" name="nome_aluno" maxlength="100"
                    placeholder="Digite o nome completo" required>
            </div>
            <div>
                <!-- Lista de atividades permitidas pelo sistema; value é o dado enviado ao PHP. -->
                <label for="atividade">Atividade esportiva</label>
                <select id="atividade" name="atividade" required>
                    <option value="">Selecione uma atividade</option>
                    <option value="Musculação">Musculação</option>
                    <option value="Pilates">Pilates</option>
                    <option value="Funcional">Funcional</option>
                </select>
            </div>

            <div>
                <!-- Campo de data com formato padronizado para envio. -->
                <label for="data_aula">Data da aula</label>
                <input type="date" id="data_aula" name="data_aula" required>
            </div>
            <div>
                <!-- Campo de horário para selecionar horas e minutos. -->
                <label for="horario">Horário da aula</label>
                <input type="time" id="horario" name="horario" required>
            </div>
            <div>
                <!-- O usuário escolhe o estado do agendamento; os valores correspondem ao banco. -->
                <label for="status">Status do agendamento</label>
                <select id="status" name="status" required>
                    <option value="">Selecione o status</option>
                    <option value="agendado">Agendado</option>
                    <option value="concluido">Concluído</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            <div>
                <!-- Envia o formulário e aciona as validações do evento submit. -->
                <button type="submit">
                    Cadastrar Agendamento
                </button>
            </div>
        </form>
    </main>
    <!-- Carrega o JavaScript após os elementos HTML já terem sido criados. -->
    <script src="../assets/js/cadastro.js"></script>
</body>

</html>