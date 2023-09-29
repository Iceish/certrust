# Certrust - API

This is the API for Certrust. It is built with laravel. It is a [Docker](https://www.docker.com/) container that is built with [Docker Compose](https://docs.docker.com/compose/), along with the sail tool.

❗ **Note**: Do not launch this container directly. This readme is for development only. See [certrust](../README.md) for more information.

## 🚀 Getting started (development)

### Launch app

0. **Clone the Repository:** Begin by cloning this repository to your local machine:

   ```bash
   https://github.com/EnzoGzz/certrust.git -b dev
   cd certrust/api
   ```

1. **Docker Setup:** Install Docker and Docker Compose if you haven't already. Certrust includes Docker Compose configurations for easy deployment.


2. _(First time)_ Build sail tool:
   ```bash
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
   ```
3. _(First time and Optional)_ **Add sail alias:** to your prompt. Add the following to your ~/.bashrc or ~/.zshrc file:
    ```bash
    alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
    ```
   
4. **Start Certrust:** Start Certrust using Docker Compose:
   ```bash
   sail up -d
   ```
5. **Launch migrations:** Launch the migrations to create the database tables:

   ```bash
   sail artisan migrate
   ```
6. _(Optional)_ **Run dev environment:** Run the following command to run the dev environment:

   ```bash
   sail npm run dev
   ```
7. **Access the API:** Once the containers are up and running, access the Certrust API app through your browser by visiting [http://localhost/api](http://localhost/api).

### Default config

- **Laravel Port**: 80
- **Laravel route**: /api
