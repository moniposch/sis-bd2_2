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

        <h2>Leitura</h2>
        <?php
        require_once 'mysql_server.php';

        $conexao = RetornaConexao();

        $livro_id = 'livro_id';
        $leitor_id = 'leitor_id';
        $inicio = 'inicio';
        $fim = 'fim';
       /* TODO-1: Adicione uma variavel para cada coluna */


        $sql =
            'select distinct l1.nome_leitor leitor, l2.titulo livro, inicio, fim' .
            ' FROM leitura ' .
            'inner join leitor l1 on l1.leitor_id = leitura.leitor_id
             inner join livros l2 on l2.livro_id = leitura.livro_id' ;

            /*echo $sql;
            die();*/

        $resultado = mysqli_query($conexao, $sql);
        if (!$resultado) {
            echo mysqli_error($conexao);
        }



        $cabecalho =
            '<table>' .
            '    <tr>' .
            '        <th>' . 'Livro' . '</th>' .
            '        <th>' . 'Leitor' . '</th>' .
            /* TODO-3: Adicione as variaveis ao cabeçalho da tabela */
            '        <th>' . 'Data início' . '</th>' .
            '        <th>' . 'Data fim' . '</th>' .
            '    </tr>';

        echo $cabecalho;

        if (mysqli_num_rows($resultado) > 0) {

            while ($registro = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';

                echo '<td>' . $registro['leitor'] . '</td>' .
                    '<td>' . $registro['livro'] . '</td>' .
                    /* TODO-4: Adicione a tabela os novos registros. */
                    '<td>' . $registro[$inicio] . '</td>' .
                    '<td>' . $registro[$fim] . '</td>';
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