async function fetchBuscaMusicas() {
    try {
        const response = await fetch("../api_home.php");
        if (!response.ok) {
            throw new Error("Erro ao obter dados do servidor.");
        }

        const data = await response.json();

        // Chamada para função que renderiza os dados na página
        renderizarConteudo(data);
    } catch (error) {
        console.error("Erro ao obter dados:", error);
        // Adicione lógica para lidar com erros, como exibir uma mensagem para o usuário
    }
}
function renderizarConteudo(conteudo) {
    const container = document.querySelector("#itens");
    console.log(conteudo);
    container.innerHTML = ""; // Limpa o conteúdo existente

    // Itera sobre o conteúdo e adiciona os cards na página
    conteudo.forEach((item) => {
        const card = document.createElement("div");
        card.classList.add("col-md-5", "mb-3");
        card.innerHTML = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${item.title}</h5>
                    <p class="card-text">Autor: ${item.author}</p>
                    <p class="card-text text-muted">Duração: ${item.duration}</p>
                    <button class="btn btn-primary" onclick="baixarMusica('${item.path}')">Download</button>
                </div>
            </div>
        `;

        container.appendChild(card);
    });
}

async function baixarMusica(caminho) {
    // Lógica para download ou redirecionamento
    console.log("Iniciando download da música:", caminho);
    // Adicione lógica para redirecionar ou processar o download conforme necessário
}

fetchBuscaMusicas();

document.getElementById("adicionar").addEventListener("click", async (event) => {
    event.preventDefault();

    // Coletar dados do formulário
    const title = document.getElementById("title").value;
    const author = document.getElementById("author").value;
    const path = document.getElementById("path").value;
    const duration = document.getElementById("duration").value;
    const extension = document.getElementById("extension").value;

    // Montar objeto com os dados
    const formData = {
        title: title,
        author: author,
        path: path,
        duration: duration,
        extension: extension
    };

    try {
        // Enviar solicitação para a API (substitua a URL pela sua API)
        const response = await fetch('sua_api_endpoint_para_insercao', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        // Verificar se a solicitação foi bem-sucedida
        if (response.ok) {
            console.log('Música adicionada com sucesso!');
            // Adicione qualquer lógica adicional conforme necessário
        } else {
            console.error('Erro ao adicionar música à base de dados.');
            // Lidar com erros conforme necessário
        }
    } catch (error) {
        console.error('Erro na solicitação:', error);
        // Lidar com erros de rede ou outros erros
    }
});