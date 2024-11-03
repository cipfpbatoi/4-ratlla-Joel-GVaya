<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/jugadorStyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de Usuario</title>
</head>
<body>
    <header>
        <h1>Creación de Usuario</h1>
    </header>
    <main>
        <form method="POST" action="">
            <div>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="color">Selecciona un color:</label>
                <select id="color" name="color" required>
                    <option value="black">Negro</option>
                    <option value="green">Verde</option>
                    <option value="purple">Morado</option>
                    <option value="blue">Azul</option>
                </select>
            </div>
            <div>
                <button type="submit">Empezar partida</button>
            </div>
        </form>
    </main>
</body>
</html>
