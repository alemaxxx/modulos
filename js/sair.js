function Sair() {

    try {

        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            type: 'POST',
            async: true,
            cache: false,
            data: {
                vsFunction: 'Sair'
            },
            success: function (vsResult) {
                
                if (vsResult.RETORNO == true) {
                    alert('saiu');

                    window.location.href = "index.php";

                } else {
                    alert('erro');
                }


            }
        });



    } catch (err) {

        var text = "Atenção! \n Ocorreu um erro!";

        text += "\n DESCRIÇÃO DO ERRO:"

        if (err == 'ajax') {

            text += "\n Ocorreu um problema na requisição ajax! <br>[" + vsMensagemRetorno + "]";

        } else {

            text += "\n [" + err.message + "]";

        }

        text += "\n Se o problema persistir contate o suporte!";


        alert(text);
    }
}


