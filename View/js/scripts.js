function cadastrarContato() {
    dados = {
    // 'email' : document.getElementById('email'), JavaScript
        'email': $('#email').val(),
        'senha': $('#senha').val(),
        'nome': $('#nome').val(),
        'sobrenome': $('#sobrenome').val(),
        'cadastrar': $('#cadastrar').val()
    }
 
    carregarModalLoading()    // Mostra o Loading

    // Envia e recebe os dados do backend (PHP)
    $.ajax({
        url: '../Controller/contatoController.php', 
        type: 'POST', 
        data: dados,
        success: function(data) {
            setTimeout(function() {
                esconderModalLoading()
                $('#status').text(data.mensagem) //Mostra mensagem vinda do backend

                //Verificar o codigo retornado
                if(data.codigo == 1) {
                    $('#status').css({
                        "color": "#f1c40f"   
                    })

                    // Redireciona para o index, depois do Delay
                    setTimeout(function() {
                        window.location.href = "home.php"
                    }, 300)


                }else {
                    $(data.campo).focus()
                    $('#status').css({
                        "color": "#ff6f65"
                    })

                }


            }, 300);
        }
    })
}

function carregarModalLoading() {
    $('#modalLoading').css({
        "display": "block"
    });
}
function esconderModalLoading() {
    $('#modalLoading').css({
        "display":"none"
    });
}