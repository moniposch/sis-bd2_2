<!DOCTYPE html>

<head>
    <style>
        .content {
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>

<html>

<body>
    <div class="content">
        <h1>Bibliófilo's</h1>

        <h2>Biblioteca</h2>
        <?php
        require_once 'mysql_server.php';

        $conexao = RetornaConexao();

        $livro_id = 'livro_id';
        $leitor_id = 'leitor_id';
       /* TODO-1: Adicione uma variavel para cada coluna */


        $sql =
            ' select l1.nome_leitor leitor, l2.titulo livro' .
            ' from biblioteca ' .
            ' inner join leitor l1 on l1.leitor_id = biblioteca.leitor_id
             inner join livros l2 on l2.livro_id = biblioteca.livro_id'; 

            /*echo $sql;
            die();*/

        $resultado = mysqli_query($conexao, $sql);
        if (!$resultado) {
            echo mysqli_error($conexao);
        }



        $cabecalho =
            '<table>' .
            '    <tr>' .
            '        <th>' . 'Leitor' . '</th>' .
            /* TODO-3: Adicione as variaveis ao cabeçalho da tabela */
            '        <th>' . 'Livro' . '</th>' .
            '    </tr>';

        echo $cabecalho;

        if (mysqli_num_rows($resultado) > 0) {

            while ($registro = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';

                echo '<td>' . $registro['leitor'] . '</td>' .
                    /* TODO-4: Adicione a tabela os novos registros. */
                    '<td>' . $registro['livro'] . '</td>' ;
                  echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '';
        }
        FecharConexao($conexao);
        ?>
    </div>
</body>

</html>