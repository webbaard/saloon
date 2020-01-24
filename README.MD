install
change your local DB settings in .env file (see .env.dist)
* docker-compose up
* docker-compose php bin/console doctrine:database:create
* docker-composephp bin/console doctrine:migrations:migrate
* docker-composephp bin/console event-store:event-stream:create

later
docker-compose exec php bin/console event-store:projection:run tab_projection
