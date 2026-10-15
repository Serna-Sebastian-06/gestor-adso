# Gestor ADSO

Proyecto integrador desarrollado con **PHP y Laravel** para el programa **ADSO** (SENA Regional Antioquia · CTMA), bajo la metodología de **Aprendizaje Basado en Proyectos (ABP)**.

Este repositorio corresponde a la **Semana 1 — Instalación y primer arranque**: dejar un entorno de desarrollo funcional y reproducible, con un proyecto Laravel conectado a base de datos y bajo control de versiones.

| Dato | Valor |
|---|---|
| Aprendiz | Sebastián Serna Gaviria |
| Ficha | 3412768 |
| Instructor | Gustavo Bolaños |
| Resultado de aprendizaje | RA EL02 · Norma 220501094 — *Elaborar propuesta técnica del software según especificaciones* |
| Fecha de elaboración | 14 - 10 - 2026 |

---

## 1. Propósito del proyecto

Gestor ADSO es el proyecto base que irá creciendo semana a semana durante el curso. **No se crea un proyecto nuevo en cada clase**: la carpeta `gestor-adso` es la base de trabajo permanente.

El objetivo de esta primera semana es:

- Identificar e instalar las herramientas necesarias para desarrollar con PHP y Laravel.
- Configurar PHP (PATH y extensiones) para que CMD, PowerShell y Composer usen la misma instalación.
- Crear el proyecto Laravel `gestor-adso` y levantar el servidor local.
- Configurar `.env`, crear la base de datos y ejecutar las migraciones.
- Inicializar Git y registrar el primer commit.
- Documentar el proceso con evidencias.

---

## 2. Herramientas y versiones reales

> Las versiones se registran **tal como las muestra el equipo**, ejecutando cada comando. No se escriben versiones supuestas.

| Herramienta | Para qué se usa | Sitio oficial | Comando de verificación | Versión real instalada |
|---|---|---|---|---|
| **XAMPP** | Paquete con Apache + MariaDB + PHP + phpMyAdmin | apachefriends.org | — | v3.3.0 |
| **PHP** (incluido en XAMPP) | Intérprete del lenguaje | — | `php -v` | PHP 8.2.12 (cli) (built: Oct 24 2023 21:15:15) (ZTS Visual C++ 2019 x64)|
| **Composer** | Gestor de dependencias de PHP | getcomposer.org | `composer -V` | Composer version 2.10.3 2026-08-27 13:34:23|
| **Laravel** | Framework PHP del proyecto | — | `php artisan --version` | Laravel Framework 12.70.0 |
| **Git** | Control de versiones | git-scm.com | `git --version` | git version 2.55.0.windows.3 |
| **Visual Studio Code** | Editor de código | code.visualstudio.com | `code --version` | 1.142.0|

Información adicional del equipo:

- Sistema operativo: Windows 11 Pro
- Ruta de PHP: `C:\xampp\php\php.exe`
- Archivo `php.ini` en uso (según `php --ini`): Configuration File (php.ini) Path:
Loaded Configuration File:         C:\xampp\php\php.ini
Scan for additional .ini files in: (none)
Additional .ini files parsed:      (none)

### Decisiones técnicas

| Decisión | Justificación |
|---|---|
| Usar el PHP incluido en XAMPP y **no** instalar PHP aparte | Evita tener varias instalaciones de PHP; CMD, PowerShell, Composer y Laravel usan el mismo intérprete y se previenen conflictos de versiones. |
| Instalar XAMPP en `C:\xampp` | Es la ruta estándar y facilita la configuración posterior. |
| Agregar `C:\xampp\php` al PATH | Permite ejecutar `php` desde cualquier carpeta. |
| Instalar Composer con `Composer-Setup.exe` apuntando a `C:\xampp\php\php.exe` | Garantiza que Composer use exactamente el PHP configurado. |
| Descargar todo desde dominios oficiales | Evita instaladores modificados de terceros. |
| Usar `utf8mb4` / `utf8mb4_unicode_ci` en la base de datos | Soporta caracteres especiales (tildes, ñ, emojis) correctamente. |

---

## 3. Instalación del entorno

Orden seguido: **Entorno → Herramientas → Proyecto → Versionar**. No se avanzó de paso si la verificación anterior presentaba errores.

### 3.1 XAMPP

1. Descargar XAMPP para Windows desde **apachefriends.org**.
2. Ejecutar el instalador y marcar los componentes: **Apache, MySQL/MariaDB, PHP y phpMyAdmin**.
3. Instalar en `C:\xampp`.
4. Abrir el **XAMPP Control Panel** e iniciar **Apache** y **MySQL** (*Start*). Solo se usan estos dos servicios.

### 3.2 PATH de PHP

1. `Windows + R` → escribir `SystemPropertiesAdvanced`.
2. **Variables de entorno** → en *Variables del sistema* seleccionar `Path` → **Editar**.
3. **Nuevo** → agregar `C:\xampp\php` → aceptar todos los cuadros.
4. Cerrar todas las terminales y abrir una **nueva**.

Verificación:

```bash
where.exe php
php -v
```

Resultado esperado de `where.exe php`: `C:\xampp\php\php.exe`

### 3.3 Extensiones de PHP (`php.ini`)

Se identifica primero qué archivo lee PHP realmente:

```bash
php --ini
```

Extensiones requeridas por Laravel (una sola línea activa por extensión, sin `;` al inicio y sin duplicados):

```ini
extension_dir="C:\xampp\php\ext"
extension=openssl
extension=pdo_mysql
extension=mbstring
extension=fileinfo
extension=zip
```

Después de editar: guardar, reiniciar Apache si está en uso y abrir una terminal nueva. Verificación:

```bash
php -m
```

Deben aparecer: `openssl`, `PDO`, `pdo_mysql`, `mbstring`, `fileinfo`, `zip`, Entre otros.

### 3.4 Composer

1. Descargar `Composer-Setup.exe` desde **getcomposer.org**.
2. Cuando el asistente pida el ejecutable de PHP, seleccionar `C:\xampp\php\php.exe`.
3. Mantener habilitada la configuración en PATH.
4. Cerrar la terminal y abrir una nueva.

```bash
composer -V
where.exe composer
```

### 3.5 Git

1. Descargar **Git for Windows** desde **git-scm.com** y ejecutar el instalador con las opciones recomendadas.
2. Cerrar las terminales abiertas y abrir una nueva.

```bash
git --version
```

Si Git solicita identidad antes del primer commit:

```bash
git config --global user.name "Tu nombre"
git config --global user.email "tu-correo@ejemplo.com"
```

### 3.6 Visual Studio Code

1. Descargar desde **code.visualstudio.com** (*User Setup* recomendado).
2. Habilitar: **Agregar al PATH**, **Abrir archivos con Code** y **Abrir carpetas con Code**.
3. Cerrar y abrir la terminal.

```bash
code --version
```

---

## 4. Creación del proyecto Laravel

En **CMD**:

```bat
cd %USERPROFILE%\Documents
composer create-project laravel/laravel gestor-adso
cd gestor-adso
php artisan --version
```

En **PowerShell**:

```powershell
Set-Location "$env:USERPROFILE\Documents"
composer create-project laravel/laravel gestor-adso
Set-Location .\gestor-adso
php artisan --version
```

La versión de Laravel se documenta según el resultado real de `php artisan --version` (ver sección 2).

### Configuración de `.env`

Si `.env` no existe:

```bat
:: CMD
copy .env.example .env
```

```powershell
# PowerShell
Copy-Item .env.example .env
```

Generar la clave de la aplicación (`APP_KEY`, usada por Laravel para cifrar sesiones, cookies y datos):

```bash
php artisan key:generate
```

Configurar la base de datos en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestor_adso
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ Las credenciales sin contraseña son **únicamente para el entorno educativo/local**. No usar esta configuración en producción.
> Si XAMPP usa un puerto distinto a `3306`, se ajusta `DB_PORT` al puerto real.

**El archivo `.env` no debe subirse al repositorio** (contiene información sensible del entorno; Laravel ya lo excluye mediante `.gitignore`).

---

## 5. Base de datos y migraciones

Con **MySQL iniciado en XAMPP**, se crea la base de datos `gestor_adso`.

**Opción A — phpMyAdmin:** *Nueva base de datos* → nombre `gestor_adso` → cotejamiento `utf8mb4_unicode_ci` → *Crear*.

**Opción B — consola:**

CMD:

```bat
"C:\xampp\mysql\bin\mysql.exe" -h 127.0.0.1 -P 3306 -u root -e "CREATE DATABASE gestor_adso CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

PowerShell:

```powershell
& "C:\xampp\mysql\bin\mysql.exe" -h 127.0.0.1 -P 3306 -u root -e "CREATE DATABASE gestor_adso CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Luego, dentro de la carpeta `gestor-adso`:

```bash
php artisan config:clear
php artisan migrate
```

- `config:clear` elimina la configuración en caché para que Laravel lea los valores actuales de `.env`.
- `migrate` ejecuta las migraciones pendientes y crea las tablas en `gestor_adso`.

Se comprueba en phpMyAdmin que las tablas fueron creadas.

---

## 6. Ejecutar el servidor

Dentro de la carpeta `gestor-adso`:

```bash
php artisan serve
```

Abrir en el navegador la dirección que muestre la terminal (normalmente `http://127.0.0.1:8000`). Debe verse la pantalla de bienvenida de Laravel.

> La terminal queda ocupada mientras el servidor esté funcionando. Para ejecutar otros comandos, abrir una **segunda terminal** dentro de `gestor-adso`.
> Si el puerto 8000 está ocupado, Laravel mostrará la dirección real en la salida del comando.

---

## 7. Control de versiones (Git)

```bash
git status
git init          # solo si el proyecto aún no es un repositorio
git add .
git commit -m "Semana 1: Entorno listo + Laravel base"
```

| Comando | Qué hace |
|---|---|
| `git init` | Crea el repositorio local |
| `git add .` | Prepara todos los cambios para el commit |
| `git commit` | Registra un punto en la historia del proyecto |

---

## 8. Estructura del proyecto

```text
gestor-adso
├── app          → Lógica principal: modelos, controladores, middleware
├── bootstrap
├── config       → Archivos de configuración de Laravel
├── database     → Migraciones, seeders y factories
├── public       → Punto público de entrada de la aplicación
├── resources    → Vistas Blade, CSS, JavaScript
├── routes       → Rutas web, API y consola
├── storage      → Archivos generados, logs y otros recursos
├── tests
├── .env         → Configuración del entorno (no se sube al repositorio)
├── artisan      → CLI de Laravel
└── composer.json → Dependencias PHP del proyecto
```

---

## 9. Evidencias del proceso

> Información: **qué comando se ejecutó para cada paso del proceso.**

| # | **Paso** | **Comandos** |

| 1 | PHP funcionando y apuntando a XAMPP | `php -v`, `where.exe php` | 

| 2 | Extensiones PHP activas | `php -m` |

| 3 | Composer, Git y Laravel | `composer -V`, `git --version`, `php artisan --version` |

| 4 | Proyecto funcionando en el navegador | `php artisan serve` → `http://127.0.0.1:8000` |

| 5 | Base de datos y migraciones | `php artisan migrate` + tablas en phpMyAdmin |

| 6 | VS Code y primer commit | `code .`, `git commit` |

---

## 10. Solución de problemas

| Problema | Causa / Solución |
|---|---|
| `'php' no se reconoce como un comando` | PHP no está en PATH o la terminal estaba abierta antes del cambio. Verificar `C:\xampp\php` en PATH y abrir una terminal nueva. |
| Composer no encuentra PHP | Ejecutar `where.exe php` y `php -v`; debe usar `C:\xampp\php\php.exe`. |
| `openssl is already loaded` | Extensión duplicada en `php.ini`. Eliminar las líneas repetidas. |
| Error conectando a MySQL/MariaDB | Revisar que MySQL esté iniciado en XAMPP, además de puerto, `DB_HOST`, `DB_PORT`, usuario, contraseña y nombre de la BD en `.env`. |
| Puerto 3306 ocupado | No cambiar números al azar: revisar en XAMPP qué puerto usa MariaDB/MySQL y reflejarlo en `.env`. |
| Puerto 8000 ocupado | Leer la dirección real que muestra `php artisan serve` en la terminal. |
