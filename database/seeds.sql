USE fitagenda;

-- Dados opcionais de demonstracao. Cada exemplo e inserido apenas quando
-- nao existe agendamento com a mesma combinacao dos quatro campos abaixo.
-- Esta verificacao evita repeticoes em execucoes sequenciais, mas duas
-- execucoes concorrentes ainda podem inserir a mesma combinacao.
INSERT INTO agendamentos
    (nome_aluno, atividade, data_aula, horario, status)
SELECT demo.nome_aluno, demo.atividade, demo.data_aula, demo.horario, demo.status
FROM (
    SELECT 'Lucas Martins' AS nome_aluno, 'Musculação' AS atividade,
           '2026-11-13' AS data_aula, '08:00:00' AS horario, 'agendado' AS status
    UNION ALL
    SELECT 'Mariana Costa', 'Natação', '2026-11-13', '09:30:00', 'agendado'
    UNION ALL
    SELECT 'Pedro Oliveira', 'Futebol', '2026-11-14', '14:00:00', 'concluido'
    UNION ALL
    SELECT 'Ana Souza', 'Vôlei', '2026-11-14', '16:00:00', 'cancelado'
    UNION ALL
    SELECT 'Gabriel Santos', 'Basquete', '2026-11-15', '10:00:00', 'agendado'
) AS demo
WHERE NOT EXISTS (
    SELECT 1
    FROM agendamentos AS existente
    WHERE existente.nome_aluno = demo.nome_aluno
      AND existente.atividade = demo.atividade
      AND existente.data_aula = demo.data_aula
      AND existente.horario = demo.horario
);
