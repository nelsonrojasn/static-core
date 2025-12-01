# static-core
### *Menos es más. El web framework minimalista para pensar claro.*

static-core es un micro–framework para aplicaciones web escrito en PHP.
No intenta hacerlo todo. No trae magia. No oculta decisiones.

Su objetivo es simple:

> **Dar solo las piezas esenciales para que cada desarrollador construya el resto con claridad.**

## 🌄 Filosofía

static-core propone lo contrario al exceso:

- **Una entrada única (Front Controller)**
- **Un router explícito**
- **Un kernel simple que despacha**
- **Handlers como unidades mínimas de acción**
- **Vistas livianas**
- **Responses claras**
- **Infraestructura opcional**

Cuando hay menos, **se ve mejor**.

## 🧱 Arquitectura

static-core se compone de 6 elementos:

```
HandlerInterface  → contrato único
Router            → mapa URL → handler
Kernel            → ejecuta el flujo
Response          → representación de la salida
View              → helper para plantillas PHP
Session           → control explícito de sesión
```

Infraestructura adicional (como acceso a base de datos) vive fuera del core.

## 🚀 Ejemplo mínimo

```php
// public/index.php
use Static\Core\Router;
use Static\Core\Kernel;

require 'vendor/autoload.php';

$router = new Router();

// Rutas públicas
$router->add('GET', '/', Static\Public\HomeHandler::class);

$kernel = new Kernel($router);
$kernel->run();
```

## 🏠 Handler

```php
namespace Static\Public;

use Static\Core\View;
use Static\Core\HandlerInterface;

class HomeHandler implements HandlerInterface
{
    public function handle(...$params): mixed
    {
        View::render("public/home", ['title' => 'Hola mundo']);
        return null;
    }
}
```

## 🖼 Vista

```php
<!-- views/public/home.php -->
<h1><?= $title ?></h1>
<p>Bienvenido a static-core.</p>
```

## 🧪 Tests incluidos

static-core está desarrollado con PHPUnit y pensado para coverage completo.

```
tests/
 ├── KernelTest.php
 ├── RouterTest.php
 ├── HandlerTest.php
 └── Handlers/FakeHandler.php
```

## 🔒 Seguridad

Incluye protección opcional mediante:

- CSRF tokens
- Same-Origin defense
- Middlewares aplicables al kernel

## 🗄 Infraestructura (opcional)

En `Infrastructure/DB.php` se ofrece una capa simple para:

- conectar
- preparar queries
- ejecutar comandos

Sin ORMs, sin modelos mágicos.

## 🧘 Por qué static-core

Porque programar no es juntar librerías.  
Programar es **pensar claro**.

static-core existe para recordarnos que:

> **Una aplicación web no necesita complicarse para ser potente.**

## 🏃 Ejecutar el servidor

static-core funciona con el servidor embebido de PHP.  
Para ponerlo a correr, solo ejecuta:

```bash
php -S localhost:8000 -t public
```

## 📦 Instalación

Pronto en Packagist.

## 🪶 Licencia

MIT.
