# Laravel Docker Environment

Полноценное Docker-окружение для локальной разработки Laravel 13.

Проект подготовлен для запуска одной командой через Docker Compose.

---

# Технологии

| Технология | Версия |
|---|---|
| PHP | 8.4 FPM |
| Laravel | 13 |
| Nginx | Alpine |
| PostgreSQL | 17 |
| Redis | Alpine |
| Node.js | 22 |
| Vite | Latest |
| Docker Compose | Latest |

Поддерживается:

- Windows + WSL2
- Linux
- Docker Desktop

---

# Требования

Перед началом необходимо установить:

- Docker
- Docker Compose
- Git
- WSL2 (Windows)

Проверка:

```bash
docker --version
docker compose version
git --version
```

---

# Установка проекта

## Клонирование

HTTPS:

```bash
git clone https://github.com/DmitryBDA/laravel-project.git
```

SSH:

```bash
git clone git@github.com:DmitryBDA/laravel-project.git
```

Переход в папку:

```bash
cd laravel-project
```

---

# Быстрый запуск

Выполнить:

```bash
./install.sh
```

Скрипт автоматически:

1. Создаст Laravel `.env`
2. Соберёт Docker контейнеры
3. Запустит сервисы
4. Дождётся PostgreSQL
5. Установит Composer зависимости
6. Создаст APP_KEY
7. Настроит права Laravel
8. Установит Node зависимости
9. Запустит миграции

После завершения:

```
======================================
 Installation completed successfully!
======================================

Laravel:
http://localhost:8080

Vite:
http://localhost:5173
```

---

# Docker контейнеры

После установки должны работать:

```
laravel_nginx
laravel_php
laravel_postgres
laravel_redis
laravel_node
```

Проверка:

```bash
docker compose ps
```

Пример:

```
NAME                  STATUS

laravel_nginx         running
laravel_php           running
laravel_postgres      running
laravel_redis         running
laravel_node          running
```

---

# Доступ к проекту

Laravel:

```
http://localhost:8080
```

Vite:

```
http://localhost:5173
```

PostgreSQL:

```
localhost:5432
```

Redis:

```
localhost:6379
```

---

# Переменные Laravel

Файл:

```
src/.env
```

Создаётся автоматически из:

```
src/.env.example
```

Основные настройки:

```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8080


DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret


CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis


REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PORT=6379
REDIS_PASSWORD=null


VITE_APP_URL=http://localhost:8080
```

---

# Docker команды

## Запуск

```bash
docker compose up -d
```

---

## Остановка

```bash
docker compose down
```

---

## Перезапуск

```bash
docker compose restart
```

---

## Пересборка

```bash
docker compose up -d --build
```

---

## Статус

```bash
docker compose ps
```

---

## Все логи

```bash
docker compose logs -f
```

---

# Логи сервисов

Nginx:

```bash
docker compose logs -f nginx
```

PHP:

```bash
docker compose logs -f php
```

Node/Vite:

```bash
docker compose logs -f node
```

PostgreSQL:

```bash
docker compose logs -f postgres
```

Redis:

```bash
docker compose logs -f redis
```

---

# Работа внутри контейнеров

## PHP

```bash
docker compose exec php bash
```

---

## Node

```bash
docker compose exec node sh
```

---

## PostgreSQL

```bash
docker compose exec postgres bash
```

---

# Laravel команды

## Очистка кеша

```bash
docker compose exec php php artisan optimize:clear
```

---

## Миграции

```bash
docker compose exec php php artisan migrate
```

---

## Статус миграций

```bash
docker compose exec php php artisan migrate:status
```

---

## Откат миграций

```bash
docker compose exec php php artisan migrate:rollback
```

---

## Создать контроллер

```bash
docker compose exec php php artisan make:controller ExampleController
```

---

## Создать модель

```bash
docker compose exec php php artisan make:model Example
```

---

## Tinker

```bash
docker compose exec php php artisan tinker
```

---

# Redis проверка

Запустить:

```bash
docker compose exec php php artisan tinker
```

Выполнить:

```php
Cache::put('test','redis works',60);

Cache::get('test');
```

Ответ:

```
redis works
```

---

# Проверка PHP

Версия:

```bash
docker compose exec php php -v
```

Расширения:

```bash
docker compose exec php php -m
```

Redis:

```bash
docker compose exec php php -m | grep redis
```

---

# Проверка Node

Версия:

```bash
docker compose exec node node -v
```

npm:

```bash
docker compose exec node npm -v
```

---

# Vite

Проверить:

```bash
docker compose logs node
```

Ожидаемый результат:

```
VITE ready

Local:
http://localhost:5173
```

---

# Production сборка

Проверка frontend сборки:

```bash
docker compose exec node npm run build
```

---

# Структура проекта

```
laravel-project
│
├── install.sh
├── docker-compose.yml
├── README.md
├── .gitignore
│
├── docker
│   │
│   ├── nginx
│   │   └── default.conf
│   │
│   └── php
│       ├── Dockerfile
│       └── php.ini
│
└── src
    │
    ├── app
    ├── artisan
    ├── bootstrap
    ├── config
    ├── database
    ├── public
    ├── resources
    ├── routes
    └── storage
```

---

# Git Workflow

Получить изменения:

```bash
git pull
```

Создать ветку:

```bash
git checkout -b feature/example
```

Добавить изменения:

```bash
git add .
```

Commit:

```bash
git commit -m "Описание изменений"
```

Push:

```bash
git push origin feature/example
```

---

# Troubleshooting

## Ошибка прав

Выполнить:

```bash
docker compose exec php chmod -R ug+rwX storage bootstrap/cache
```

---

## Node не запускается

Проверить:

```bash
docker compose ps -a
```

Логи:

```bash
docker compose logs node
```

---

## Laravel не открывается

Проверить контейнеры:

```bash
docker compose ps
```

Проверить Nginx:

```bash
docker compose logs nginx
```

---

## Redis не работает

Проверка:

```bash
docker compose exec redis redis-cli ping
```

Ответ:

```
PONG
```

---

# Лицензия

Проект используется для разработки и обучения.
