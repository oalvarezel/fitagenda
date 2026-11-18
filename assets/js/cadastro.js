
// Localiza o formulário pelo ID no documento HTML (DOM).
const formulario = document.getElementById("form-cadastro");

// Localiza o campo do nome para ler e validar seu conteúdo.
const campoNome = document.getElementById("nome_aluno");

// Executa a função quando o usuário tenta enviar o formulário.
formulario.addEventListener("submit", function(evento) {

    // Lê o valor digitado e remove espaços no início e no fim.
    const nome = campoNome.value.trim();

    // Se o nome estiver vazio, preventDefault cancela o envio, alert avisa, focus seleciona o campo e return encerra a função.
    if (nome.length === 0) {
        evento.preventDefault();
        alert("Digite um nome válido.");
        campoNome.focus();
        return;
    }

    console.log("Nome validado:", nome);

    // Lê a data escolhida e obtém a data atual do navegador.
    const campoData = document.getElementById("data_aula");

    const dataSelecionada = campoData.value;
    const hoje = new Date();
    const ano = hoje.getFullYear();
    // getMonth começa em zero, por isso somamos 1; padStart completa com zero à esquerda.
    const mes = String(hoje.getMonth() + 1).padStart(2, "0");
    const dia = String(hoje.getDate()).padStart(2, "0");

    // Monta a data no formato AAAA-MM-DD para comparar os textos cronologicamente.
    const dataAtual = `${ano}-${mes}-${dia}`;

    // Bloqueia datas anteriores à atual.
    if (dataSelecionada < dataAtual) {
        evento.preventDefault();
        alert("Não é possível agendar uma aula em uma data passada.");
        campoData.focus();
        return;
    }

    console.log("Data selecionada:", dataSelecionada);

    // Obtém o horário informado pelo usuário.
    const campoHorario = document.getElementById("horario");
    const horarioSelecionado = campoHorario.value;

    // Extrai horas e minutos atuais e formata ambos com dois dígitos.
    const hora = String(hoje.getHours()).padStart(2, "0");
    const minuto = String(hoje.getMinutes()).padStart(2, "0");

    const horarioAtual = `${hora}:${minuto}`;

    // Se a aula for hoje e o horário já tiver passado ou for igual ao atual, impede o envio.
    if (dataSelecionada === dataAtual && horarioSelecionado <= horarioAtual) {
        evento.preventDefault();
        alert("Não é possível agendar uma aula em um horário que já passou.");
        campoHorario.focus();
        return;
    }

    console.log("Horário selecionado:", horarioSelecionado);

    // Registra a validação no console. Sem preventDefault, o navegador envia o formulário normalmente ao PHP.
    console.log("Formulário validado com sucesso!");

});
