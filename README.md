# API de gestion de inventario simple con roles

API RESTful para gestión de productos y categorías, desarrollada en Laravel 10 con autenticación por Sanctum, autorización por roles, buenas prácticas de diseño y arquitectura desacoplada usando Service Layer y Repository Pattern.

## 🧰 Tecnologías utilizadas

- PHP 8.1.10
- Laravel 10.48.29
- MySQL
- Sanctum (auth)
- Postman (pruebas)
- Repositorios y servicios (Service & Repository pattern)

## 📦 Requisitos

- PHP 8.1+
- Laravel 10+
- Composer
- MySQL o MariaDB
- Laravel CLI (`composer global require laravel/installer`)

## ⚙️ Configuración local

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/davidguerrero1011/inventario-api.git
   cd inventario-api

2. Instalar dependencias:
   ```bash
   composer install

3. Copiar el archivo `.env` y configurarlo: (Esto en la raiz del proyecto)
   ```si es Linux o Mac:
   cp .env.example .env

   ```si es Windows:
   copy .env.example .env

4. Generar la clave de la aplicación:
   ```bash
   php artisan key:generate

5. Crear una base de datos y configurar los datos en `.env`:
   ```env
   DB_DATABASE=inventario_api
   DB_USERNAME=root
   DB_PASSWORD=tu_password

6. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ``` Si no se ha ejecutado el seeder GeneralAdminUserSeeder que inserta un usuario admin, debera correr el seeder
       php artisan db:seed --class=GeneralAdminUserSeeder

7. Iniciar el servidor:
   ```bash
   php artisan serve


## 🔐 Variables de entorno importantes

Asegúrate de definir estas variables en `.env`:

```env
APP_NAME=inventario-api
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario-api
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost:8000
```

### 📌 Importar colección de Postman:

a. Abre Postman
b. En las opciones, sea del menu superior o en la imagen de hamburguesa, opción File.
c. Seleccionamos `Import`.
d. Buscamos el json en la opcion de seleccionar archivos.
e. Buscamos el archivo en la ubicacion donde este ubicado.

3. Establece el token de autenticación como tipo *Bearer Token* al probar endpoints protegidos, el bearer toker lo obtiene con el 
   archivo User Login de la coleccion, solamente debe pasarle en el cuerpo el correo y la contraseña.


## 🌍 Despliegue público

Puedes acceder al backend desplegado en:  
🔗 **[http://44.206.233.215]**


## 🧠 Decisiones de diseño
### ✅ Enum vs Tabla de roles

- Se usó un **enum directamente en el modelo** mediante un campo `role` (`admin`, `user`) en la tabla `users`, sin una tabla `roles`,
  porque solo hay 2 tipos y no se requiere una gestión dinámica compleja, mas sin embargo si los roles llegan a crecer se aconseja eliminar el campo roles de la tabla users y crear la tabla para los roles, con esto tendremos totalmente normalizada la base de datos.

### ✅ Middleware de autorización personalizado

```php
'role' => \App\Http\Middleware\CheckRole::class,

Se implementó un **middleware `CheckRole`** para restringir rutas por rol (ej. `'role:admin'`), evitando depender de paquetes externos y manteniendo control completo sobre la lógica.

### ✅ Cambios realizados sobre el esquema de Base de Datos original:

- Se añadió campo `role` al modelo `User`.
- Se crearon migraciones personalizadas para:
  - Tabla `categories` con `name`, `description`.
  - Tabla `products` con `category_id`, `name`, `description`, `price`, `stock`.
- Se creo seeder GeneralAdminUserSeeder para registrar el primer usuario tipo admin, ya que la ruta de registrar usuarios esta protegida
  en el middleware de sanctum

### ✅ Arquitectura

- Separación en capas:
  - **Controladores**
  - **Requests personalizados (FormRequest)**
  - **Recursos (`JsonResource`)**
  - **Servicios (`Services`)**
  - **Repositorios (`Repositories`)**
- Uso de validaciones personalizadas, control de errores con `try/catch`, respuestas uniformes.
- Solamente se dejo validacion de form request en controlador en el metodo login que valida credenciales.

## 🔗 Repositorio público

Todo el código fuente está disponible en GitHub:  
👉 **[https://github.com/davidguerrero1011/inventario-api]**

---

## ✉️ Contacto

Wilmar David Macias Guerrero  
📧 davidguerrero0709@gmail.com  
🔗 [GitHub: davidguerrero1011](https://github.com/davidguerrero1011)

---

## 📝 Licencia

MIT License. Libre para usar, estudiar y modificar.