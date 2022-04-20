## Microservice's command helpers 
- Запуск Composer update в 'auth-service' - `cd auth-service; composer update --ignore-platform-reqs; cd ..`
- Запуск Composer update в 'core-service' - `cd core-service; composer update --ignore-platform-reqs; cd ..`

## Docker's command helpers 
- Запуск контейнеров ` docker-compose -f ./deploy/docker-compose.yml -f docker-compose.override.yml up -d --build`
- Остановка контейнеров `docker-compose down`
- Просмотреть логи `docker-compose logs --tal 25`
