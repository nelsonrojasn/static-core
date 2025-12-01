<!DOCTYPE html>
<html>
<head>
    <title>static-core – Un framework ultra minimalista</title>
    <link rel="stylesheet" href="https://unpkg.com/simpledotcss/simple.min.css">
</head>
<body>

<header>
    <h1>static-core</h1>
    <nav>
        <a href="/">Inicio</a>
        <a href="/about">About</a>
    </nav>
</header>


<main>
    <?= $content ?>
</main>

<footer>
    <p>&copy; <?= date('Y')?> Static Core. Todos los derechos reservados.</p>
</footer>

</body>
</html>
