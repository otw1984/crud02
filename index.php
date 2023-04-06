<?php

require_once 'Terminal.php';

function menu(){
    echo "\n\n\n**** Bem vindo ao sistema CRUD de Alunos ****";
    echo "\nDigite 1 para Incluir alunos";
    echo "\nDigite 2 para Atualizar alunos";
    echo "\nDigite 3 para Excluir alunos";
    echo "\nDigite 4 para Listar alunos";
    echo "\nDigite 5 para Sair\n";

    echo "Opção: ";
    $handle = fopen("php://stdin", "r");
    $line = trim(fgets($handle));

    $terminal = new Terminal();

    switch ($line){
        case '1':
            $terminal->terminaAddAluno();
            fclose($handle);
            menu();
            break;

        case '2':
            $terminal->terminalUpaluno();
            fclose($handle);
            menu();
            break;

        case '3':
            $terminal->terminalDelAluno();
            fclose($handle);
            menu();
            break;

        case '4':
            $terminal->terminalSelectAluno();
            menu();
            break;

        case '5':
            echo "\nObrigado por usar o sistema de alunos, volte sempre.";
            fclose($handle);
            break;

        default:
            echo "\nOpção Invalida, selecione uma opção valida:";
            fclose($handle);
            menu();
            break;
    }
}

menu();