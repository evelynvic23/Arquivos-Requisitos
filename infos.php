<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Banco de Dados</title>
    <style>
        body {
            background-color: lightgreen;
        }

        <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }
</style>


        
    </style>
</head>

<body>
    <h1>Bem-vindo ao BD</h1>

    <form onchange="this.form.submit()" name="testes" method="POST" id="formularioTeste">
        <select onchange="visu()" name="opcoes" id="opcoes">
            <option value=""></option>
            <option value="aluno">Aluno</option>
            <option value="curso">Curso</option>
            <option value="disciplina">Disciplina</option>
            <option value="professor">Professor</option>
            <option value="turma">Turma</option>
        </select>
    </form>


    <?php
     //Iniciando a conexão com o banco de dados 
     $cx = mysqli_connect("localhost", "root", "");
    
     //Selecionando o banco de dados 
     $db = mysqli_select_db($cx, "bancoteste");
     
     //Criando a query de consulta à tabela criada 
     $professor = mysqli_query($cx, "SELECT * FROM professor") or die( 
     mysqli_error($cx) //Caso haja um erro na consultal, exibir erro
     );  
    
     $aluno = mysqli_query($cx, "SELECT * FROM aluno"); 
     $curso = mysqli_query($cx, "SELECT * FROM curso"); 
     $disciplina = mysqli_query($cx, "SELECT * FROM disciplina"); 
     $turma = mysqli_query($cx, "SELECT * FROM turma"); 


     ?>
     <table>
    <tr class="th">
        <th>Nome</th>
        <th>Rg</th>
        <th>Email</th>
    </tr>

    <?php
    while ($linha = mysqli_fetch_assoc($professor)) {
        $nome = $linha['nome'];
        $rg = $linha['rg']; // Substitua 'outra_coluna' pelo nome real da coluna
        $email = $linha['email']; // Substitua 'mais_uma_coluna' pelo nome real da coluna

        echo "<tr>";
        echo "<td>$nome</td>";
        echo "<td>$rg</td>";
        echo "<td>$email</td>";
        echo "</tr>";
    }
    ?>

</table>

<?php

    if (isset($_POST['opcoes'])) {
        $valorRecebido = $_POST['opcoes'];
        if ($valorRecebido == "professor") {
            //Percorrendo os registros da consulta através de um array. 
            while($aux = mysqli_fetch_assoc($professor)) { 
              echo "---------------------------------<br />"; 
              echo "Nome:".$aux["nome"]."<br />"; 
              echo "RG:".$aux["rg"]."<br />"; 
              }
          }
          if ($valorRecebido == "aluno") {
            while($aux = mysqli_fetch_assoc($aluno)) { 
              echo "---------------------------------<br />"; 
              echo "Nome:".$aux["nome"]."<br />"; 
              echo "RG:".$aux["rg"]."<br />"; 
              }
          }
          if ($valorRecebido == "curso") {
            while($aux = mysqli_fetch_assoc($curso)) { 
              echo "---------------------------------<br />"; 
              echo "Nome:".$aux["nome"]."<br />"; 
              echo "Carga horária:".$aux["carga_horaria"]."<br />"; 
              }
          }
          if ($valorRecebido == "disciplina") {
            while($aux = mysqli_fetch_assoc($disciplina)) { 
              echo "---------------------------------<br />"; 
              echo "Nome:".$aux["nome"]."<br />"; 
              echo "Semestre:".$aux["semestre"]."<br />"; 
              echo "Curso:".$aux["curso"]."<br />"; 
              }
          }

          if ($valorRecebido == "turma") {
            while($aux = mysqli_fetch_assoc($turma)) { 
              echo "---------------------------------<br />"; 
              echo "Nome:".$aux["nome"]."<br />"; 
              echo "Turno:".$aux["turno"]."<br />"; 
              echo "Curso:".$aux["curso"]."<br />"; 
              }
          }
    }

    
    ?>










    <script type="text/javascript">

        const form = document.getElementById('formularioTeste')
        form.addEventListener('submit', e => {
            e.preventDefault()
            console.log('Deu certo')
        })

        function visu() {
            var bla = document.getElementById("opcoes").value;
            localStorage.setItem("teste", bla);
            document.getElementById("opcoes").value = localStorage.getItem("teste");

            if(localStorage.getItem("teste") === document.getElementById("opcoes").value){
            document.testes.submit();

            }else{
                console.log("Não foi")
            }
        }
    </script>

  
</body>

</html>