# Certrust - Web UI

This is the web UI for Certrust. It is built with [SvelteKit](https://kit.svelte.dev/). It is a [Docker](https://www.docker.com/) container that is built with [Docker Compose](https://docs.docker.com/compose/).

❗ **Note**: Do not launch this container directly. This readme is for development only. See [certrust](../README.md) for more information.

## 🚀 Getting started (development)

### Launch app

0. _(First time) Build image with ```--build```._
```bash
docker-compose -f docker-compose.dev.yml up --build
```

1. Launch docker compose.
```bash
docker-compose -f docker-compose.dev.yml up -d
```

2. Open [http://localhost:3000](http://localhost:3000) in your browser.

### Default config

- **SvelteKit Port**: 3000
- **Vite HMR**: 24012
