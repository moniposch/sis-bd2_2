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

        <h2>Amizade</h2>
        <?php
        require_once 'mysql_server.php';

        $conexao = RetornaConexao();

        $leitorum_id = 'leitorum_id';
        $leitordois_id = 'leitordois_id';
        $solicitacao = 'solicitacao';

          /* TODO-1: Adicione uma variavel para cada coluna */


        $sql =         
            ' select l1.nome_leitor leitor1, l2.nome_leitor leitor2, solicitacao' .
            ' FROM amizade ' .
            'inner join leitor l1 on l1.leitor_id = amizade.leitorum_id
            inner join leitor l2 on l2.leitor_id = amizade.leitordois_id' ;
                         

        $resultado = mysqli_query($conexao, $sql);
        if (!$resultado) {
            echo mysqli_error($conexao);
        }



        $cabecalho =
            '<table>' .
            '    <tr>' .
            '        <th>' . 'Leitor 1' . '</th>' .
            '        <th>' . 'Leitor 2' . '</th>' .
            /* TODO-3: Adicione as variaveis ao cabeçalho da tabela */
            '        <th>' . 'Solicitação' . '</th>' .
            '    </tr>';

        echo $cabecalho;

        if (mysqli_num_rows($resultado) > 0) {

            while ($registro = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';

                echo '<td>' . $registro['leitor1'] . '</td>' .
                    '<td>' . $registro['leitor2'] . '</td>' .
                    /* TODO-4: Adicione a tabela os novos registros. */
                    '<td>' . $registro['solicitacao'] . '</td>'; 
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