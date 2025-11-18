document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById("graficoAvaliacoes");

    const labels = [
        "Clareza", "Didática", "Interação",
        "Motivação", "Domínio do Conteúdo",
        "Organização", "Recursos"
    ];

    const valores = [
        parseFloat(dados.mediaClareza) || 0,
        parseFloat(dados.mediaDidatica) || 0,
        parseFloat(dados.mediaInteracao) || 0,
        parseFloat(dados.mediaMotivacao) || 0,
        parseFloat(dados.mediaDominioConteudo) || 0,
        parseFloat(dados.mediaOrganizacao) || 0,
        parseFloat(dados.mediaRecursos) || 0,
    ];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Média das Avaliações (1 a 5 estrelas)",
                data: valores,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5
                }
            }
        }
    });

});
