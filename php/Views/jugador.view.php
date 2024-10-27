
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/jugadorStyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Creacion de Usuario</h1>
    </header>
    <body>
        <form method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" required>
            </div>
            <div>
                <label for="color">Selecciona un color</label>
                <select id="color">
                    <option>Rojo</option>
                    <option>Verde</option>
                    <option>Morado</option>
                    <option>Azil</option>
                </select>
            </div>
            <div>
                <button type="submit">Crear usuario</button>
            </div>
        </form>
    </body>
</body>
</html>