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

La principal diferencia radica en quién tiene el **control del flujo del programa**:

| Característica | Framework | Librería |
| :------------- | :--------------: | :------------- |
| **Control del Flujo**| **Inversión de Control (IoC)**: El framework define la estructura y el ciclo de vida de la aplicación. | **Control del Desarrollador**: El código del desarrollador dirige el flujo de la aplicación. |
| **Arquitectura** | Proporciona la estructura completa del proyecto (el esqueleto). | Proporciona funcionalidades específicas y auxiliares. |
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
| Python   | **Django** | "Baterías incluidas" (todo lo que necesitas), enfoque en el desarrollo rápido y seguro. |

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

* **Sintaxis Elegante y Legible**: Su código está diseñado para ser expresivo y fácil de entender.
* **Productividad Rápida ("Time-to-Market")**: Incluye herramientas integradas que eliminan el código repetitivo:
    * **Eloquent ORM**: Abstracción de bases de datos que permite interactuar con la BD usando **Modelos** de PHP.
    * **Artisan**: Una potente interfaz de línea de comandos (**CLI**) para generar código, manejar migraciones y ejecutar tareas.
* **Seguridad Integrada**: Proporciona protección automática contra ataques comunes (CSRF, Inyección SQL, XSS).
* **Ecosistema y Comunidad**: Cuenta con un ecosistema robusto (Forge, Vapor, Nova) y una comunidad muy activa.

En resumen, Laravel proporciona el equilibrio perfecto entre simplicidad, funcionalidad y estándares para construir aplicaciones web modernas, escalables y seguras.

---

## ¿Qué es Composer?

**Composer** no es un gestor de paquetes tradicional, sino un **gestor de dependencias**. Esto significa que:

1.  **Define Dependencias**: Lee el archivo `composer.json` (donde listas qué librerías necesitas).
2.  **Resuelve Dependencias**: Averigua qué otras librerías requiere cada una (**dependencias transitivas**).
3.  **Descarga Librerías**: Descarga los paquetes del repositorio `Packagist.org` y los coloca en la carpeta `vendor/`.
4.  **Autocarga (Autoloading)**: Genera el archivo `vendor/autoload.php` que cumple con el estándar **PSR-4**, haciendo que todas las clases estén disponibles automáticamente en tu código.

### ¿Por qué es esencial en Laravel?

* **Instalación del Framework**: Laravel en sí mismo es un conjunto de paquetes de Composer.
* **Gestión de Dependencias**: Laravel depende de docenas de componentes de terceros (muchos de Symfony) que Composer gestiona.
* **Facilita el Desarrollo**: Permite añadir rápidamente funcionalidades (como autenticación o depuración) listándolas en `composer.json`.
* **Estándares PSR**: Implementa los estándares de autocarga **PSR-4**, manteniendo el código organizado y estandarizado.

---

## ¿Qué son los estándares PSR?

Los estándares **PSR** (**PHP Standards Recommendation**) son un conjunto de directrices propuestas por el grupo PHP-FIG. Su objetivo es asegurar la **interoperabilidad** entre diferentes frameworks y librerías de PHP, facilitando que el código sea consistente y reutilizable.

Laravel sigue un conjunto estricto de convenciones de nomenclatura basadas en PSR y el patrón **MVC** (Modelo-Vista-Controlador).

### Convenciones de Nomenclatura en Laravel

#### 1. Clases (Modelos, Controladores, Servicios)

Las clases siguen la convención **PascalCase** (o UpperCamelCase):

* **Modelos**: Singular y PascalCase (Ejemplo: `User`, `Product`).
* **Controladores**: PascalCase, generalmente terminan en `Controller` (Ejemplo: `UserController`, `OrderController`).

#### 2. Funciones y Métodos

Los métodos y funciones siguen la convención **camelCase**:

* **Métodos del Controlador**: Describen la acción (Ejemplo: `index()`, `store()`, `update()`).
* **Métodos de Relación en Modelos**: `camelCase` singular o plural según la relación (Ejemplo: `post()`, `tags()`).

#### 3. Archivos y Directorios

Laravel organiza los archivos según el estándar **PSR-4**:

* **Archivos de Clases**: El nombre del archivo debe coincidir exactamente con el nombre de la clase (Ejemplo: `ProductController.php`).
* **Vistas (Views)**: Utilizan **snake_case** y terminan en `.blade.php` (Ejemplo: `user_profile.blade.php`).

#### 4. Base de Datos (Tablas y Columnas)

Laravel tiene fuertes convenciones predeterminadas:

* **Nombres de Tablas**: **snake_case** y **plural** (Ejemplo: `users`, `products`).
* **Nombres de Modelos**: La forma **singular** y **PascalCase** del nombre de la tabla (Ejemplo: tabla `users` usa el modelo `User`).
* **Claves Foráneas (Foreign Keys)**: Nombre del modelo singular en `snake_case` seguido de `_id` (Ejemplo: `user_id`).

---

## Laravel, ¿Por dónde empezar?

El framework implementa el patrón de diseño **MVC (Modelo-Vista-Controlador)** de la siguiente manera:

### Estructura de Archivos (Ejemplo Simplificado)

Ya sabemos qué es el patrón de diseño MVC (Modelo-Vista-Controlador). Ahora vamos a ver cómo los desarrolladores de Laravel lo han implementado y cómo vamos a tener que adaptar nuestra aplicación al framework.
Como punto de partida vamos a adaptar un ejemplo visto con anterioridad (mvc-php-ejemplo). La estructura de archivos es muy similar aunque con algunas diferencias:

```
laravel-app/
├── app/                           # Lógica central (Modelos, Controladores, etc.)
│   ├── Http/                      # Controladores, Middleware, Peticiones (Requests)
│   │   ├── Controllers/           # Controladores de la aplicación
│   │   │   └── EmpleadoController.php # Ejemplo de controlador
│   ├── Models/                    # Modelos de Eloquent (interacción con la BD)
│   │   └── Empleado.php           # Ejemplo de modelo
├── resources/                     # Recursos sin compilar (vistas, assets)
│   └── views/                     # Plantillas Blade (Vistas)
│   │   └──  welcome.blade.php    # Ejemplo de plantilla
├── routes/                        # Definición de ruta
│   ├── web.php                    # Rutas para la web (HTML)
├── .env                           # Variables de entorno
```


### Conceptos Básicos

* **Routing Básico**: Mapea la **URL solicitada** por el usuario a un **controlador** y un **método** específicos.
* **Controllers Básico**: Recibe la petición, ejecuta la lógica de negocio (usando Modelos) y selecciona la Vista para la respuesta. Actúa como el mediador central del MVC.
* **Views Básico**: Contiene la capa de presentación (código HTML con datos dinámicos). Laravel usa el motor de plantillas **Blade**.

### Utilidades de Laravel

**Artisan Console**
Para facilitar el desarrollo, Laravel dispone de diferentes comandos accesibles mediante la línea de comandos. Se accede a ellos desde la carpeta raíz del proyecto usando:

```bash
php artisan [comando]
```
