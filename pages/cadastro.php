<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Agendamento | FitAgenda</title>
</head>

<body>
    <main>
        <h1>Novo Agendamento</h1>
        <p>Preencha os dados para agendar uma aula esportiva.</p>
        <form id="form-cadastro" action="../actions/salvar.php" method="POST">
            <div>
                <label for="nome_aluno">Nome do aluno</label>
                <input type="text" id="nome_aluno" name="nome_aluno" maxlength="100"
                    placeholder="Digite o nome completo" required>
            </div>
            <div>
                <label for="atividade">Atividade esportiva</label>
                <select id="atividade" name="atividade" required>
                    <option value="">Selecione uma atividade</option>
                    <option value="Musculação">Musculação</option>
                    <option value="Pilates">Pilates</option>
                    <option value="Funcional">Funcional</option>
                </select>
            </div>

            <div>
                <label for="data_aula">Data da aula</label>
                <input type="date" id="data_aula" name="data_aula" required>
            </div>
            <div>
                <label for="horario">Horário da aula</label>
                <input type="time" id="horario" name="horario" required>
            </div>
            <div>
                <label for="status">Status do agendamento</label>
                <select id="status" name="status" required>
                    <option value="">Selecione o status</option>
                    <option value="agendado">Agendado</option>
                    <option value="concluido">Concluído</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            <div>
                <button type="submit">
                    Cadastrar Agendamento
                </button>
            </div>
        </form>
    </main>
    <script src="../assets/js/cadastro.js"></script>
</body>

</html>