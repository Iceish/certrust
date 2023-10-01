# Certrust - Web UI

This is the API for Certrust. It is built with Vue3. It is a [Docker](https://www.docker.com/) container that is built with [Docker Compose](https://docs.docker.com/compose/).

❗ **Note**: Do not launch this container by itself for production. This readme is for development only. See [certrust](../README.md) for more information about production.

## 🚀 Getting started (development)

### Requirements
- [Docker](https://docs.docker.com/engine/install/) & [Docker-compose](https://docs.docker.com/compose/install/).
- [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git).

### Launch app

1. **Clone the Repository:** Begin by cloning this repository to your local machine:

   ```bash
   https://github.com/Iceish/certrust.git -b dev
   cd certrust/web
   ```

2. **Launch:** Start Certrust Web UI using Docker Compose:
   ```bash
   docker compose -f docker-compose.dev.yml up -d
   ```
3. **Access the Web UI:** Once the containers are up and running, access the Certrust Web UI app through your browser by visiting [http://localhost:3000](http://localhost:3000).

### Default config

- **Web UI Port**: 3000
- **HMR Port**: 24012
