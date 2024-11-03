<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="board">
        <table>
            <tr>
                <?php if (!$winner):
                    for ($j = 1; $j <= $board::COLUMNS; $j++): ?>
                        <td><input type='submit' name='columna' class='move' value='<?= $j ?>' /></td>
                    <?php endfor;
                else: ?>
                    <h1>El guanyador es el jugador <?= $winner->getName() ?></h1>
                <?php endif ?>
            </tr>
            <?php foreach ($board->getSlots() as $i => $fila): ?>
                <tr>
                    <?php foreach ($fila as $j => $slot): ?>
                        <?= match ($slot) {
                            0 => '<td class="buid"><a></a></td>',
                            1 => '<td class="player1"></td>',
                            2 => '<td class="player2"></td>',
                            default => '<td class="error"></td>',
                        } ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</body>

</html>

<style>
    table {
        border-collapse: collapse;
        margin: 20px auto;
    }

    td {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 5px dotted #fff;
        background-color: #000;
        display: inline-block;
        margin: 10px;
        color: white;
        font-size: 2rem;
        text-align: center;
        vertical-align: middle;
    }

    .player1 {
        background-color: rgb(26, 196, 77);
    }

    .player2 {
        background-color: yellow;
    }

    .buid {
        background-color: white;
        border-color: #000;
    }
</style>