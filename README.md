# Docker's command helpers 
#### Перед стартом создайте файл .env из .envexample
- Сборка и запуск всех контейнеров 
```ps
docker-compose up -d --build
```
- Остановка контейнеров 
```ps
docker-compose down`
```
- Просмотреть логи 
```ps
docker-compose logs --tal 25
```

# Microservices command helpers
#### Для включения ивентов раcкомментируйте строку `$app->register(App\Providers\EventServiceProvider::class)` в каждом микросервисе
- Seed в auth-microservice
```ps
docker-compose run --rm auth-service php artisan db:seed --force
```
- Seed в core-microservice
```ps
docker-compose run --rm core-service php artisan db:seed --force
```
