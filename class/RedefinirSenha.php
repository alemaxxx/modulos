<?php



class RedefinirSenha {

    //int
    private
            $viErro;
    //obj
    private
            $voTools,
            $voConexao;
    //string
    //array
    private
            $vaDados;

    public function __construct() {

        $this->viErro = 0;
        $this->voConexao = conecta_db();
    }

    public function RedefinirSenha($vsEmail) {

        
        
        $vsSql = "SELECT 
                U.ID_USUARIO,
                U.ID_PESSOA,
                U.USUARIO,
                P.NOME,
                P.SOBRENOME,
                P.EMAIL
            FROM 
                rs_geral_usuario U
            LEFT JOIN
                rs_geral_pessoa P
            ON
                P.ID_PESSOA = U.ID_PESSOA
            WHERE 
                P.EMAIL = '$vsEmail'
            ;
            "
        ;

        $voResultado = mysqli_query($this->voConexao, $vsSql) or ( $this->setViErro());
        
        if ($this->getViErro() === 0) {

            if (mysqli_num_rows($voResultado) > 0) {

                $this->vaDados = $this->MysqliToArray($voResultado, true);
                
                $this->EnviarEmail($vsEmail);
                
                //$vbRetorno = true;
            } else {

                $vbRetorno = false;
            }
        } else {

            $vbRetorno = false;
        }


        return $vbRetorno;
    }

    public function EnviarEmail($vsEmail) {
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'davigruberjunior@gmail.com';
        $mail->Password = 'Fopdcpvad#23';
        $mail->Port = 587;

        $mail->setFrom('davigruberjunior@gmail.com');
        $mail->addReplyTo('no-reply@email.com.br');
        $mail->addAddress($vsEmail, 'Nome');
        $mail->addAddress($vsEmail, 'Contato');
        $mail->addCC('email@email.com.br', 'Cópia');
        $mail->addBCC('email@email.com.br', 'Cópia Oculta');

        $mail->isHTML(true);
        $mail->Subject = 'Assunto do email';
        $mail->Body = 'Este é o conteúdo da mensagem em <b>HTML!</b>';
        $mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';
        $mail->addAttachment('/tmp/image.jpg', 'nome.jpg');

        if (!$mail->send()) {
            $vbRetorno = false;
            echo 'Não foi possível enviar a mensagem.<br>';
            echo 'Erro: ' . $mail->ErrorInfo;
        } else {
            $vbRetorno = true;
            echo 'Mensagem enviada.';
        }
        
        
    }

    private function MysqliToArray($vsResMysql, $vbConvertUtf8 = false) {

        $this->varrMysql = array();

        if (mysqli_num_rows($vsResMysql) == 0) {

            return false;
        } else {

            $tipo = mysqli_fetch_fields($vsResMysql);

            $i = 0;  //linhas do resultado
            $j = 0;  //colunas do resultado

            while ($dados = mysqli_fetch_object($vsResMysql)) {

                foreach ($tipo as $val) {

                    $vsNome = $val->name;

                    //VERIFICA SE ARRAY PRECISA 
                    //SER CONVERTIDO PARA UTF8
                    //NORMALMENTE SE UTILIZADO
                    //COM AJAX AS STRINGS TEM QUE
                    //POSSUIR ESTE TRATAMENTO
                    //PARA VC RETORNAR UM JSON_ENCODE
                    //OU DARA ERRO
                    $this->varrMysql[$vsNome][$i] = ($vbConvertUtf8 == true) ? utf8_encode($dados->$vsNome) : $dados->$vsNome;

                    $j++;
                }

                $i++;
            }
        }

        if (sizeof($this->varrMysql) > 0) {

            return $this->varrMysql;
        } else {

            return false;
        }
    }

    /**
     * Commit()
     * 
     * 
     */
    private function Commit() {

        if ($this->getViErro() === 0) {

            $vbRetorno = mysqli_commit($this->voConexao);
        } else {

            mysqli_rollback($this->voConexao);
            $vbRetorno = false;
        }

        return $vbRetorno;
    }

    function getViErro() {
        return $this->viErro;
    }

    function getVoTools() {
        return $this->voTools;
    }

    function getVoConexao() {
        return $this->voConexao;
    }

    function getVaDados() {
        return $this->vaDados;
    }

    function setViErro() {
        $this->viErro++;
    }

    function setVoTools($voTools) {
        $this->voTools = $voTools;
    }

    function setVoConexao($voConexao) {
        $this->voConexao = $voConexao;
    }

    function setVaDados($vaDados) {
        $this->vaDados = $vaDados;
    }

}
