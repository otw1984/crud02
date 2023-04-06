<?php

require_once 'ModelData.php';

class AlunoDAO
{   
 
    // --- INSERT ---
    public function insertAluno($nome, $idade)
    {
        try {
            $modelData = new ModelData();
            $con = $modelData->getConn();
            
            $queryInsert = 'INSERT INTO alunos (nome, idade) VALUES (:nome, :idade);';
            $stmt = $con->prepare($queryInsert);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':idade', $idade);
            $stmt->execute();
            
            echo "\nAluno incluso com sucesso!";
        } catch (PDOException $error) {
            echo "\nNão foi possível inserir aluno, erro:  {$error->getMessage()}";
        }
    }
    
    // --- UPDATE ---
    public function updateAluno($id, $nome, $idade)
    {        
        try {
            $modelData = new ModelData();
            $con = $modelData->getConn();

            $queryUpdate = 'UPDATE alunos SET nome = :nome, idade = :idade WHERE id = :id;';
            $stmt = $con->prepare($queryUpdate);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':idade', $idade);
            $stmt->execute();
            echo "\nAluno atualizado com sucesso!";
        } catch (PDOException $error) {
            echo "\nNão foi possível alterar aluno, erro: {$error->getMessage()}";
        }
    }

    // --- DELETE ---
    public function deleteAluno($id)
    {        
        try {
            $modelData = new ModelData();
            $con = $modelData->getConn();

            $queryDelete = 'DELETE FROM alunos where id = :id';
            $stmt = $con->prepare($queryDelete);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->rowCount();
            if($result > 0) {
                echo "\nAluno removido com sucesso!";
            } else{
                echo "\nID inesistente, verifique e tente novamente!";
            }
        } catch (PDOException $error) {
            echo "\nNão foi possível excluir o registro, erro: {$error->getMessage()}";
        }
    }

    // --- SELECT ---
    public function selectAluno($id, $nome, $idade)
    {        
        try {
            $modelData = new ModelData();
            $con = $modelData->getConn();

            $querySelect = 'SELECT * FROM alunos';
            $where = "";

            if($nome){$where .=" WHERE nome LIKE '%{$nome}%'";}
            if($id){$where .= ($where?" and ":" where ") . " id = {$id} ";}
            if($idade){$where .= ($where?" and ":" where ") . " idade = {$idade} ";}
            $querySelect .= $where;
            
            $stmt = $con->prepare($querySelect);
            
            $stmt->execute();

            $format = "|%5.5s| %-30.30s | %-10.5s|";
            echo "\n";
            printf($format, 'ID', 'NOME', 'IDADE');

            $i = 0;
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $aluno){
                echo "\n";
                printf($format, $aluno['id'], $aluno['nome'], $aluno['idade']);
                $i++;
            }

            if(!$i > 0){
                echo "\n\n ### Registro não encontrado, favor rever e fazer uma nova pesquisa. ###";
            }
        
            echo "\n";

        } catch (PDOException $error) {
            echo "\nFalha ao listar Alunos, erro: {$error->getMessage()}";
        }
    }

}