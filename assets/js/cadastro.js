const formulario = document.getElementById("form-cadastro");

const campoNome = document.getElementById("nome_aluno");

formulario.addEventListener("submit", function(evento) {
    evento.preventDefault();



const nome = campoNome.value.trim();

if (nome.length === 0) {
    alert("Digite um nome válido.");
    campoNome.focus();
    return;
}

console.log("Nome validado:", nome);

const campoData = document.getElementById("data_aula");

const dataSelecionada = campoData.value;

const hoje = new Date();
const ano = hoje.getFullYear();
const mes = String(hoje.getMonth() +1).padStart(2,"0");
const dia = String(hoje.getDate()).padStart(2, "0");

const dataAtual = `${ano}-${mes}-${dia}`;

if (dataSelecionada < dataAtual) {
    alert("Não é possível agendar uma aula em uma data passada.");
    campoData.focus();
    return;
}

console.log("data delecionada:", dataSelecionada);

const campoHorario = document.getElementById("horario");
const horarioSelecionado = campoHorario.value;

const hora = String(hoje.getHours()).padStart(2, "0");
const minuto = String(hoje.getMinutes()).padStart(2, "0");

const horarioAtual = `${hora}:${minuto}`;


if (dataSelecionada === dataAtual && horarioSelecionado <= horarioAtual) {
    alert("Não é possível agendar uma aula em um horário que já passou.");
    campoHorario.focus();
    return;
}


console.log("Horário selecionado:", horarioSelecionado);


console.log("Formulário validado com sucesso!");
});