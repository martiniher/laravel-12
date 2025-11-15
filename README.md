# Desarrollo Web con Frameworks

## ¿Qué es un Framework?

Un **framework** (marco de trabajo) es una estructura de código predefinida y un conjunto de herramientas que proporcionan la estructura fundamental y las reglas para construir una aplicación.

---

## ¿Para qué sirve?

Su propósito principal es aumentar la **productividad** y la **estandarización** del desarrollo:

* **Velocidad**: Evita que tengas que escribir código repetitivo (como la gestión de sesiones, rutas o la conexión a bases de datos) desde cero.
* **Organización**: Impone un patrón de diseño (como **MVC - Modelo, Vista, Controlador**) que ayuda a mantener el código limpio y escalable.
* **Seguridad**: Incluye mecanismos de seguridad ya probados contra ataques comunes (como **SQL Injection** o **XSS**).
* **Comunidad**: Permite que varios desarrolladores trabajen en el mismo proyecto con una convención y un conjunto de herramientas compartidas.

---

## ¿Qué diferencias tiene con una Librería?

La principal diferencia radica en quién tiene el **control del flujo** del programa:

| Característica | Framework | Librería |
| :------------- | :--------------: | :------------- |
| **Control del Flujo**| **Inversión de Control (IoC)**: El framework define la estructura y el ciclo de vida de la aplicación. | **Control del Desarrollador**: El código del desarrollador dirige el flujo de la aplicación. |
| **Arquitectura** | Proporciona la **estructura completa** del proyecto (el esqueleto). | Proporciona **funcionalidades específicas** y auxiliares. |
| **Alcance** | Se utiliza para construir **toda** la aplicación (ej. backend o frontend). | Se utiliza para una **tarea específica** (ej. manipular fechas, hacer peticiones HTTP).|
| **Ejemplos** | Laravel, Symfony, Django, Angular. | jQuery, Lodash, Moment.js, Guzzle (en PHP). |

---

## ¿Cuáles son los principales Frameworks de Desarrollo Web?

Los frameworks de desarrollo web se dividen principalmente en **Backend** (lógica del servidor) y **Frontend** (interfaz de usuario).

### Frameworks de Backend (Servidor)

Estos manejan la lógica, bases de datos y seguridad:

| Lenguaje | Framework Principal | Énfasis / Característica Destacada |
| :------- | :------------------ | :--------------------------------- |
| PHP      | **Laravel** | Sintaxis elegante, excelente comunidad, desarrollo rápido (el más popular en PHP). |
| PHP      | **Symfony** | Componentes reutilizables, robusto, alta calidad de código (base de muchos otros frameworks). |
| Python   | **Django** | Enfocado en el desarrollo rápido y seguro. |

### Frameworks/Librerías de Frontend (Cliente)

Estos se centran en la interfaz de usuario, interactividad y la experiencia del usuario:

| Lenguaje | Framework | Énfasis / Característica Destacada |
| :------- | :----------------- | :--------------------------------- |
| TypeScript| **Angular** | Mantenido por Google. Framework completo y robusto para grandes aplicaciones empresariales. |
| JavaScript| **Vue.js** | Progresivo y fácil de aprender. Combina lo mejor de React y Angular, muy flexible. |
| JavaScript| **Next.js** | Framework Full-Stack (Frontend y Backend) construido sobre React. Excelente para **SEO** (Server-Side Rendering). |

---

## ¿Qué es Laravel?

**Laravel** es un framework de desarrollo web de código abierto escrito en **PHP**. Fue creado por Taylor Otwell y lanzado por primera vez en 2011. Su objetivo principal es hacer que el desarrollo de aplicaciones web complejas sea más **rápido, fácil y agradable** para el desarrollador.

Laravel sigue el patrón de diseño **Modelo-Vista-Controlador (MVC)**, lo que ayuda a organizar la aplicación de manera lógica y modular.

### ¿Por qué usar Laravel?

Laravel se ha convertido en el framework de PHP más utilizado debido a la forma en que simplifica tareas comunes y promueve la calidad del código:

1. Sintaxis Elegante y Legible: Su código está diseñado para ser expresivo y fácil de entender. Esto reduce la curva de aprendizaje y acelera el desarrollo.
2. Productividad Rápida ("Time-to-Market"): Incluye herramientas integradas para tareas comunes, lo que elimina la necesidad de escribir código repetitivo:
    - Eloquent ORM: Una capa de abstracción de bases de datos que permite interactuar con la base de datos usando sintaxis de PHP (Modelos), en lugar de SQL puro.
    - Sistema de Rutas y Resource Controllers: Facilita la implementación de la arquitectura RESTful (como vimos con store, update, destroy).
    - Artisan: Una potente interfaz de línea de comandos (CLI) que permite generar código, manejar migraciones de bases de datos, y ejecutar tareas.
3. Seguridad Integrada: Laravel maneja automáticamente muchas amenazas comunes, proporcionando protección contra ataques como:
    -  Falsificación de Solicitudes entre Sitios (CSRF).
    - Inyección SQL.
    - Scripts entre Sitios (XSS).
4. Ecosistema y Comunidad: Cuenta con un ecosistema robusto (Laravel Forge, Vapor, Nova) y una comunidad muy activa que proporciona documentación, tutoriales y librerías adicionales (gestionadas a través de Composer).

En resumen, si quieres construir una aplicación web moderna, escalable y segura utilizando PHP, Laravel proporciona el equilibrio perfecto entre simplicidad, funcionalidad y estándares.

---

## ¿Qué es Composer?

Composer no es un gestor de paquetes en el sentido tradicional (como apt o yum) sino un **gestor de dependencias**. Esto significa que:

1. **Define Dependencias**: Lee el archivo composer.json de tu proyecto (donde listas qué librerías necesitas).
2. **Resuelve Dependencias**: Averigua qué otras librerías requiere cada una de las que pediste (dependencias transitivas).
3. **Descarga Librerías**: Descarga estas librerías (paquetes) del repositorio Packagist.org y las coloca en una carpeta llamada vendor/.
4. **Autocarga (Autoloading)**: Genera el archivo vendor/autoload.php que cumple con el estándar PSR-4, permitiendo que las clases de todas las librerías descargadas estén disponibles automáticamente en tu código sin usar sentencias require o include.

### ¿Por qué es esencial en Laravel?

Laravel es un framework moderno que está construido sobre la filosofía de reutilizar componentes y seguir los estándares de PHP. Composer es fundamental para esta arquitectura por varias razones:

- **Instalación del Framework**: Laravel en sí mismo es un conjunto de paquetes de Composer. Sin Composer, no podrías instalar ni inicializar un proyecto de Laravel.
- **Gestión de Dependencias**: Laravel depende de docenas de componentes de terceros (muchos de Symfony) para funcionalidades esenciales, como el enrutamiento, las peticiones HTTP, la consola Artisan, y la capa de base de datos (Eloquent). Composer gestiona estas dependencias por ti.
- **Facilita el Desarrollo**: Te permite añadir rápidamente funcionalidad a tu proyecto, como un sistema de autenticación (ej. Laravel Breeze o Sanctum), una herramienta de depuración, o integraciones con servicios externos, simplemente listándolas en composer.json.
- **Estándares PSR**: Composer es el motor que implementa los estándares de autocarga PSR-4 para todos los archivos de tu proyecto y los de las librerías, lo que mantiene el código organizado y estandarizado.

---

## ¿Qué son los estándares PSR?

Los estándares PSR (PHP Standards Recommendation) son un conjunto de estándares y directrices propuestos por el grupo PHP Framework Interop Group (PHP-FIG). Su objetivo es asegurar la interoperabilidad entre diferentes frameworks y librerías de PHP, facilitando que el código sea consistente y reutilizable.

Laravel sigue un conjunto estricto de convenciones de nomenclatura basadas en los estándares de PHP (PSR) y el patrón MVC (Modelo-Vista-Controlador) para garantizar la coherencia y la legibilidad.

Estas convenciones no son obligatorias, pero seguirlas facilita enormemente el uso de las características mágicas de Laravel (como Eloquent) y hace que tu código sea instantáneamente legible por cualquier desarrollador de Laravel.

### Convenciones de Nomenclatura en Laravel

#### 1. Clases (Modelos, Controladores, Servicios)

Las clases siguen la convención PascalCase (o UpperCamelCase) y generalmente deben ser singulares para los Modelos y plurales o descriptivas para otros:

- Modelos: Singular y PascalCase.
    - Ejemplo: User, Product, PostTag.
- Controladores: PascalCase, generalmente terminan en Controller.
    - Ejemplo: UserController, OrderController, Api\ProductController.
- Interfaces/Traits/Abstracts: PascalCase, con prefijos o sufijos descriptivos.
    - Ejemplo: Authenticatable, CanBeVoted.


#### 2. Funciones y Métodos

Los métodos y funciones dentro de las clases siguen la convención camelCase:

- Métodos del Controlador: Tienen nombres que describen la acción (especialmente en los Resource Controllers).
    - Ejemplo: index(), store(), update(), show().
- Métodos de Clases:
    - Ejemplo: getProductName(), calculateTotal(), isPublished().
- Métodos de Relación en Modelos: Generalmente en camelCase singular para relaciones uno a uno o uno a muchos, y plural para relaciones muchos a muchos.
    - Ejemplo (Usuario): hasOne('Post') se llama post().
    - Ejemplo (Post): belongsToMany('Tag') se llama tags().

#### 3. Archivos y Directorios

Laravel organiza los archivos para reflejar el espacio de nombres de la clase y sigue el estándar PSR-4:

- Archivos de Clases: El nombre del archivo debe coincidir exactamente con el nombre de la clase, incluyendo mayúsculas.
    - Ejemplo: La clase ProductController se guarda en el archivo ProductController.php.
- Vistas (Views): Utilizan snake_case y generalmente terminan en .blade.php.
    - Ejemplo: user_profile.blade.php, products.index.blade.php.
- Directorios: Generalmente en PascalCase para directorios que contienen clases (como app/Http/Controllers) o minúsculas para directorios de configuración o vistas.

#### 4. Base de Datos (Tablas y Columnas)

Aunque puedes anularlas, Laravel tiene fuertes convenciones predeterminadas para las bases de datos:

- Nombres de Tablas: snake_case (separado por guiones bajos) y plural.
    - Ejemplo: users, products, post_tags.
- Nombres de Modelos: El modelo asociado es la forma singular y PascalCase del nombre de la tabla (ej: la tabla users usa el modelo User).
- Nombres de Columnas: snake_case singular.
    - Ejemplo: first_name, is_active, created_at.
- Claves Foráneas (Foreign Keys): Usan el nombre del modelo singular en snake_case seguido de _id.
    - Ejemplo: Una clave foránea a la tabla users se llama user_id.
- Tablas Pivot (Many-to-Many): Combinan los nombres singulares de las dos tablas en orden alfabético y separadas por guion bajo.
    - Ejemplo: Una tabla pivot entre posts y tags se llama post_tag.

---

## Laravel, ¿Por dónde empezar?

Ya sabemos qué es el patrón de diseño MVC (Modelo-Vista-Controlador). Ahora vamos a ver cómo los desarrolladores de Laravel lo han implementado y cómo vamos a tener que **adaptar nuestra aplicación al framework**.

### Entorno de desarrollo local

Para poner en marcha la aplicación y simplificar la explicación, vamos utilizar un entorno de desarrollo integrado [Laragon](https://laragon.org/), que incluye los componentes necesarios:

- PHP (con las extensiones requeridas).
- Servidor Web (Apache/Nginx).
- Base de Datos (MySQL/MariaDB).
- Composer (Gestor de dependencias de PHP).

### Instalación de Laravel

Aunque podríamos instalarlo directamente desde Composer, vamos a usar el instalador de Laravel. Para ello, utilizaremos Composer para instalarlo de forma global, lo cual solo es necesario realizar una única vez en el sistema:

```
composer global require laravel/installer
```

Una vez instalado, tendremos la posibilidad de crear nuevos proyectos ejecutando el siguiente comando:
```
laravel new laravel-app
```

[![Instalación Laravel 12](https://img.youtube.com/vi/O6LVDweUMGM/maxresdefault.jpg)](https://www.youtube.com/watch?v=O6LVDweUMGM)

Durante el proceso de instalación tendremos que responder a las siguientes preguntas:

- `Which starter kit would you like to install? [None]`: Pulsamos enter o escribimos `None`. 
- `Which testing framework do you prefer? [Pest]`: Pulsamos enter o escribimos `Pest`. 
- `Which database will your application use? [SQLite]:` Escribimos `mysql`. 
- `Default database updated. Would you like to run the default database migrations? (yes/no) [yes]:` Pulsamos enter o escribimos `yes`.
- `Would you like to run npm install and npm run build? (yes/no) [yes]:` Pulsamos enter o escribimos `yes`.

Cabe destacar el último paso, en el que se ejecuta `npm install`. Este comando no instala NPM, sino que usa NPM (Node Package Manager), que es el administrador de paquetes estándar para JavaScript y descargara las dependencias de frontend del proyecto. Aunque Laravel es un framework de backend PHP, estas dependencias son necesarias para herramientas como Vite que se encargan de compilar y optimizar los recursos de frontend (como el JavaScript y CSS).

### Conceptos básicos necesarios

* **Routing**: El sistema de routing se encarga de mapear la URL solicitada por el usuario con la lógica interna de la aplicación. Su función básica/principal es dirigir cada petición a un controlador y un método específicos.
* **Controllers**: Una vez que un controlador recibe la petición, ejecuta la lógica de negocio necesaria para responder. Para interactuar con la base de datos, utiliza los modelos, y para presentar la respuesta final al usuario, usa las vistas. El controlador actúa como el mediador central del patrón MVC.
* **Views**: Las vistas contienen la capa de presentación de la aplicación (generalmente código HTML con datos dinámicos) que se mostrará al usuario. Por defecto, Laravel utiliza el motor de plantillas Blade.

### Utilidades de Laravel

Para facilitar el desarrollo, Laravel dispone de diferentes comandos que son accesibles mediante la consola. Para ello, es necesario acceder desde la terminal a la carpeta raíz del proyecto y utilizar el script `artisan`, el cual debe ser precedido por php (ejemplo: `php artisan [comando]`) para que el intérprete sepa que debe ejecutarlo un archivo PHP.

### La carpeta `public`
La carpeta `public` es el único directorio de tu aplicación Laravel al que se le debe permitir el acceso directo desde la web y esta debería ser la carpeta raiz del servidor web. Para poder acceder sin modificar la configuración basta con añadir la carpeta `public` a la url. Ej: `http://localhost/laravel-12/public/empleado`

---

### Practica

Como punto de partida vamos a adaptar un ejemplo visto con anterioridad ([mvc-php-ejemplo](https://github.com/jvadillo/mvc-php-ejemplo)). La estructura de archivos es muy similar aunque con algunas diferencias:

```
laravel-app/
├── app/                               # Lógica central (Modelos, Controladores, etc.)
│   ├── Http/                          # Controladores, Middleware, Peticiones (Requests)
│   │   ├── Controllers/               # Controladores de la aplicación
│   │   │   └── EmpleadoController.php # Ejemplo de controlador
│   ├── Models/                        # Modelos de Eloquent (interacción con la BD)
│   │   └── Empleado.php               # Ejemplo de modelo
├── resources/                         # Recursos sin compilar (vistas, assets)
│   └── views/                         # Plantillas Blade (Vistas)
│   │   └──  welcome.blade.php         # Ejemplo de plantilla
├── routes/                            # Definición de ruta
│   ├── web.php                        # Rutas para la web (HTML)
├── .env                               # Variables de entorno
```

- [Ejemplo 01](https://github.com/martiniher/laravel-12/tree/ejemplo-laravel12-01)
- [Ejemplo 02](https://github.com/martiniher/laravel-12/tree/ejemplo-laravel12-02)

---

### Puesta en Marcha del Proyecto usando Git
Como gestor de versiones estamos usando Git. Para poder comenzar a trabajar con el proyecto, necesitamos tenerlo instalado en nuestro ordenador local.

#### 1. Clonar el Repositorio
Usando el comando `git clone [URL-del-repositorio]` descargamos una copia completa del proyecto, incluyendo todo su historial, a nuestro equipo.

```bash
git clone https://github.com/martiniher/laravel-12.git
```
Este comando crea una nueva carpeta con el nombre del repositorio y descarga todos los archivos en ella.

#### 2. Entender y Utilizar el Archivo `.gitignore`
En la carpeta raíz del proyecto encontrarás un archivo llamado `.gitignore`. Este archivo es crucial, ya que contiene una lista de archivos y carpetas que Git debe ignorar y que no se incluirán en el repositorio.

##### Lista de Archivos Ignorados:
```
*.log
.DS_Store
.env
.env.backup
.env.production
... (y otros archivos y carpetas)
/vendor
/node_modules
...
```

##### Propósito del `.gitignore`:
Ocultar datos sensibles: Archivos como `.env` (Environment file) contienen datos confidenciales y de configuración específica del entorno de desarrollo o producción (como contraseñas y tokens de bases de datos o servicios externos). Es fundamental que no se suban al repositorio público.

Excluir dependencias: Carpetas como `/vendor` (para dependencias de PHP gestionadas por Composer) y `/node_modules` (para dependencias de JavaScript/NPM) suelen ser muy grandes. Se ignoran porque pueden reconstruirse automáticamente en cualquier máquina.

Excluir archivos generados: Archivos de cache, logs (`*.log`), archivos temporales (`.DS_Store`, `Thumbs.db`), y los assets compilados (`/public/build`, `/public/hot`) se generan automáticamente.

#### 3. Instalación de Dependencias y Configuración Inicial
Dado que el archivo .gitignore excluye las carpetas de dependencias (/vendor y /node_modules) y los archivos de configuración sensible (.env), el siguiente paso esencial es reconstruir estos elementos para que la aplicación funcione:

Moverse a la carpeta del proyecto:

```bash
cd laravel-12
```

Instalar dependencias de PHP (Composer): Este paso lee el archivo composer.json e instala todos los paquetes necesarios en la carpeta /vendor.
```bash
composer install
```
Configurar el archivo `.env`:

Copia el archivo de configuración de ejemplo (a menudo llamado `.env.example`) y nómbralo como `.env`.
Este archivo debe ser editado con tus credenciales de base de datos locales y otras configuraciones específicas de tu entorno.
```bash
cp .env.example .env
```

Cabe destacar del archivo .env los datos de conexión a la base de datos, que son esenciales para que la aplicación sepa dónde y cómo almacenar y recuperar información.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_12
DB_USERNAME=root
DB_PASSWORD=
```

Generar la Application Key (clave de cifrado): En proyectos Laravel, necesitas generar una clave única para fines de seguridad.
```bash
php artisan key:generate
```
#### 4. Compilación de Archivos Estáticos (Assets)
Los archivos de código fuente de CSS y JavaScript (como los que se encuentran en la carpeta resources) no se utilizan directamente en producción, sino que deben ser compilados, transpuestos y minimizados para un rendimiento óptimo en el navegador.

Este proceso generalmente se realiza con Node.js y npm (o yarn / pnpm).

Instalar dependencias de Node.js (NPM):

Primero, debes instalar las dependencias de frontend definidas en el archivo package.json (que incluye el compilador, PostCSS, Babel, etc.).
```bash
npm install
```

Compilar los Assets:

Una vez instaladas las dependencias, ejecutas el comando de compilación. Este comando procesa los archivos fuente y genera los archivos estáticos finales (como `app.css` o `app.js`) dentro de carpetas públicas, a menudo `/public/build` o `/public/js`, que se ignoraron inicialmente en el archivo `.gitignore`.

Para una compilación optimizada para producción, usa:
```bash
npm run build
```

#### 5. Ejecución de las Migraciones de la BBDD
Una vez que has clonado el repositorio, instalado las dependencias y configurado el archivo `.env` con las credenciales de tu base de datos local, el paso final y crucial es crear la estructura de la base de datos definida en el código.

Esto se realiza mediante el comando migrate de Artisan:

Ejecutar las migraciones: Este comando lee los archivos de migración ubicados en la carpeta `database/migrations` y crea las tablas correspondientes en tu base de datos. Con el parámetro `--seed` insertaremos los datos iniciales en esas tabla.

```bash
php artisan migrate --seed
```

Un seeder es un archivo (o clase) que se utiliza para insertar datos iniciales en las tablas de la base de datos.
Se ejecutan después de las migraciones para:
- Crear usuarios por defecto (por ejemplo, un administrador).
- Añadir configuraciones iniciales.
- Poblar la base de datos con datos de prueba para el desarrollo.

En resumen, un seeder es la herramienta que llena las tablas vacías con información esencial para que la aplicación comience a funcionar.

#### Resumen

- Clonar: `git clone https://github.com/martiniher/laravel-12.git`
- Moverse: `cd laravel-12`
- Dependencias PHP: `composer install`
- Configuración: `cp .env.example .env`
- Clave: `php artisan key:generate`
- Dependencias NPM: `npm install`
- Compilar los Assets `npm run build`
- Migraciones: `php artisan migrate --seed`
  
[Puesta en marcha del proyecto usando git](https://youtu.be/YNecIEK3utM)







