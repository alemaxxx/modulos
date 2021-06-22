<?php


class Login {

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

    public function Logar($vsUsuario, $vsSenha){
        
        $vsSql = 
            "SELECT 
                * 
            FROM 
                usuario
            WHERE 
                USUARIO = '$vsUsuario' 
            AND
                SENHA = MD5('$vsSenha')
            ;
            "
        ;
        
        $voResultado = mysqli_query($this->voConexao, $vsSql) or ( $this->setViErro());
        
        if ($this->getViErro() === 0) {

            if (mysqli_num_rows($voResultado) > 0) {
                
                $this->AtualizaUltimoAcesso($vsUsuario);
                
                $this->vaDados = $this->MysqliToArray($voResultado, true);
                
                $vbRetorno = true;
                
            } else {

                $vbRetorno = false;
            }
        } else {

            $vbRetorno = false;
        }


        return $vbRetorno;
        
    }
    
    public function AtualizaUltimoAcesso($vsUsuario){
        
        date_default_timezone_set('America/Sao_Paulo');
        $DATA_HORA = date('Y-m-d H:i:s');
        
        $vsSqlUpdateUltimoAcesso = " 
            
                UPDATE 
                    usuario
                SET
                    ULTIMO_ACESSO = '$DATA_HORA'
                WHERE
                    USUARIO = '$vsUsuario'

        ";
        
        if (!mysqli_query($this->voConexao, $vsSqlUpdateUltimoAcesso))
            $this->setViErro();

        $vbRetorno = $this->Commit();

        return $vbRetorno;
        
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
