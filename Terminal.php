<?php

require_once 'AlunoDAO.php';
require_once 'ModelData.php';

class Terminal
{
    // --- VALIDA TERMINAL ---
    private function validaTemrinal($id)
    {
        $modelData = new ModelData();
        $con = $modelData->getConn();

        $querySelectT = 'SELECT * FROM alunos WHERE id = :id';
        $stmt = $con->prepare($querySelectT);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $i = 0;
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $aluno){
            $i++;
        }

        if($i > 0){
            return true;
        } else{
            return false;
        }
    }

    // --- TERMINAL ADICIONAL ALUNO ---
    public function terminaAddAluno()
    {                
        $nome = "";
        $idade = "";
        
        echo "\nPor favor informe o nome do aluno:";
        $handle = fopen("php://stdin", "r");
        $nome = trim(fgets($handle));

        echo "\nPor favor informe a idade:";
        $handle = fopen("php://stdin", "r");
        $idade = trim(fgets($handle));
        
        $aluno = new AlunoDAO();
        $aluno->insertAluno($nome, $idade);
    }

    // --- TERMINAL ATUALIZAR ALUNO ---
    public function terminalUpaluno()
    {   
        $aluno = new AlunoDAO();
        $aluno->selectAluno(null, null, null);
        $id = "";
        $nome = "";
        $idade = "";

        echo "\nPor favor informe o ID do aluno que deseja Atualizar: ";
        $handle = fopen("php://stdin", "r");
        $id = trim(fgets($handle));

        if($this->validaTemrinal($id) == true){
            echo "\nPor favor informe o NOME do aluno que deseja Atualizar: ";
            $handle = fopen("php://stdin", "r");
            $nome = trim(fgets($handle));

            echo "\nPor favor informe o IDADE do aluno que deseja Atualizar: ";
            $handle = fopen("php://stdin", "r");
            $idade = trim(fgets($handle));

            $aluno->updateAluno($id, $nome, $idade);
        }else{
            echo "\nID inválido, tente novamente!\n";
        }
    }

    // --- TERMINAL EXCLUIR ALUNO ---
    public function terminalDelAluno()
    {
        $aluno = new AlunoDAO();
        $aluno->selectAluno(null, null, null);

        $id = "";
        echo "\nInforme o ID do aluno a ser removido: ";
        $handle = fopen("php://stdin", "r");
        $id = trim(fgets($handle));

        $aluno->deleteAluno($id);
    }

    // --- TERMINAL SELECIONAR ALUNOS ---
    public function terminalSelectAluno()
    {
        $id = null;
        $nome = null;
        $idade = null;

        echo "\n\n\n**** Escolha o tipo de pesquisa ****";
        echo "\nDigite 1 para buscar pelo ID do aluno";
        echo "\nDigite 2 para buscar pelo NOME do aluno";
        echo "\nDigite 3 para buscar pela IDADE do aluno";
        echo "\nDigite 4 para buscar pelo NOME e a IDADE do aluno";
        echo "\nDigite 5 para Listar os alunos\n";
        
        echo "Opção: ";    
        $handle = fopen("php://stdin", "r");
        $line = trim(fgets($handle));

        $aluno = new AlunoDAO();
        

        switch ($line) {
            case '1':
                echo "\nInforme o ID do aluno: ";
                $handle = fopen("php://stdin", "r");
                $id = trim(fgets($handle));
                $aluno->selectAluno($id, $nome, $idade);
                fclose($handle);
                break;

            case '2':
                echo "\nInforme o NOME do aluno: ";
                $handle = fopen("php://stdin", "r");
                $nome = trim(fgets($handle));
                $aluno->selectAluno($id, $nome, $idade);
                fclose($handle);
                break;

            case '3':
                echo "\nInforme o IDADE do aluno: ";
                $handle = fopen("php://stdin", "r");
                $idade = trim(fgets($handle));
                $aluno->selectAluno($id, $nome, $idade);
                fclose($handle);
                break;
            
            case '4':
                echo "\nInforme o NOME do aluno: ";
                $handle = fopen("php://stdin", "r");
                $nome = trim(fgets($handle));
                
                echo "\nInforme o IDADE do aluno: ";
                $handle = fopen("php://stdin", "r");
                $idade = trim(fgets($handle));

                $aluno->selectAluno($id, $nome, $idade);
                fclose($handle);
                break;
            
            case '5':
                $aluno->selectAluno($id, $nome, $idade);
                fclose($handle);
                break;

            default:
                echo 'Opção Inválida';
                break;
        }

        
    }

}