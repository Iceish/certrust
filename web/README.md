# Certrust - Web UI

This is the API for Certrust. It is built with Vue3. It is a [Docker](https://www.docker.com/) container that is built with [Docker Compose](https://docs.docker.com/compose/).

❗ **Note**: Do not launch this container directly. This readme is for development only. See [certrust](../README.md) for more information.

## 🚀 Getting started (development)

### Launch app

0. **Clone the Repository:** Begin by cloning this repository to your local machine:

   ```bash
   https://github.com/EnzoGzz/certrust.git -b dev
   cd certrust/web
   ```

1. **Docker Setup:** Install Docker and Docker Compose if you haven't already. Certrust includes Docker Compose configurations for easy deployment.

2. **Launch:** Start Certrust Web UI using Docker Compose:
   ```bash
   docker compose -f docker-compose.dev.yml up -d
   ```
3. **Access the Web UI:** Once the containers are up and running, access the Certrust Web UI app through your browser by visiting [http://localhost:3000](http://localhost:3000).

### Default config

- **Web UI Port**: 3000
- **HMR Port**: 24012
