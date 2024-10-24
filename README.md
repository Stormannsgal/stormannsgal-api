# Stormannsgal - Das Projekt vom Größenwahn getrieben

## Installation

1. auschecken: `git clone git@github.com:Stormannsgal/stormannsgal-api.git`
2. Docker Container hochfahren: `docker-compose up -d`
3. Abhängigkeiten installieren: `docker-compose exec php composer install`
4. Datenbank vorbereiten:
   - `docker-compose exec php composer run doctrine migrations:sync-metadata-storage`
   - `docker-compose exec php composer run doctrine migrations:migrate`
5. Informationen für SwaggerUI erstellen: `docker-compose exec php composer run openapi`

Und das war es auch schon. SwaggerUI ist über http://localhost/api/docs/ erreichbar.
Sonstige Services siehe composer.json -> scripts


---

# Stormannsgal - The project driven by megalomania

## Installation

1. check out: `git clone git@github.com:Stormannsgal/stormannsgal-api.git`
2. boot up Docker container: `docker-compose up -d`.
3. install dependencies: `docker-compose exec php composer install`.
4. prepare database:
    - `docker-compose exec php composer run doctrine migrations:sync-metadata-storage`.
    - `docker-compose exec php composer run doctrine migrations:migrate`.
5. create information for SwaggerUI: `docker-compose exec php composer run openapi`.

And that's it. SwaggerUI is accessible via http://localhost/api/docs/.
Other services see composer.json -> scripts
