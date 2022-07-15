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
      
        <h2>Leitor</h2>
        <?php
        require_once 'mysql_server.php';

        $conexao = RetornaConexao();

        $nome_leitor = 'nome_leitor';
        $nascimento = 'nascimento';
        $qntd_amigos = 'qntd_amigos';
            /* TODO-1: Adicione uma variavel para cada coluna */


        $sql =
            'SELECT ' . $nome_leitor .
            '     , ' . $nascimento .
            '     , ' . $qntd_amigos .
            /*TODO-2: Adicione cada variavel a consulta abaixo */
            '  FROM leitor';

           /* echo $sql;
            die();*/

        $resultado = mysqli_query($conexao, $sql);
        if (!$resultado) {
            echo mysqli_error($conexao);
        }


        $cabecalho =
            '<table>' .
            '    <tr>' .
            '        <th>' . 'Nome leitor' . '</th>' .
            '        <th>' . 'Data do nascimento' . '</th>' .
            /* TODO-3: Adicione as variaveis ao cabeçalho da tabela */
            '        <th>' . 'Amizades' . '</th>' .
            '    </tr>';

        echo $cabecalho;

        if (mysqli_num_rows($resultado) > 0) {

            while ($registro = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';

                echo '<td>' . $registro[$nome_leitor] . '</td>' .
                    '<td>' . $registro[$nascimento] . '</td>' .
                    /* TODO-4: Adicione a tabela os novos registros. */
                    '<td>' . $registro[$qntd_amigos] . '</td>';
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