document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById("graficoAvaliacoes").getContext("2d");

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

    // 7 cores diferentes — garantidas para barras individuais
    const colors = [
        "#6ce5e8",
        "#41b8d5",
        "#2d8bba",
        "#2f5f98",
        "#205295",
        "#3960b9",
        "#19367aff"
    ];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                data: valores,
                backgroundColor: colors, // <- 7 cores diferentes
                borderColor: "#fff",
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    ticks: {
                        color: "#ffffff"
                    }
                },
                x: {
                    ticks: {
                        color: "#ffffff"
                    }
                }
            }
        }
    });

});
