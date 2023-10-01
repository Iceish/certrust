<div align="center">
    <img src="./docs/assets/certrust_colored.svg" width="100px">
</div>

# Certrust - Self-Hosted Local SSL Certificate Manager

Certrust is an open-source, self-hosted Local SSL Certificate Manager designed to simplify the management of SSL certificates for local development environments. It empowers developers and system administrators to create and manage certificate authorities, generate SSL certificates, and streamline certificate renewal processes. Certrust is built on top of the OpenSSL library, ensuring robust security practices.

<div align="center">
    <img src="./docs/assets/alert-developpement.png" width="75%">
</div>

## 📋 Features

- **Certificate Authority Management:** Easily create and manage root authorities and sub-authorities to issue SSL certificates for your local domains.

- **Certificate Generation:** Generate SSL certificates for your local domains using the authorities you've created.

- **Certificate Renewal _(Work in progress)_:** Automate certificate renewal processes to ensure continuous SSL security.

- **Docker Integration:** Certrust is Docker-ready, making it convenient for users to self-host the service without complicated setup procedures.

- **Web Application:** The Certrust web app is built using Laravel, providing a user-friendly interface for managing certificates and authorities.

## 🚀 Getting Started

### Requirements
- [Docker](https://docs.docker.com/engine/install/) & [Docker-compose](https://docs.docker.com/compose/install/).
- [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git).

### Production

<details open>
<summary><strong>With official images. <em>(recommended)</em></strong></summary>
Comming soon...
</details>

<details>
<summary><strong>With source code.</strong></summary>

1. **Clone the Repository:** Begin by cloning this repository to your local machine:

   ```bash
   git clone https://github.com/Iceish/certrust.git -b stable
   cd certrust/
   ```
   
2. **Configure your environment:** 
   1. In the Api folder, copy the `.env.example` file to `.env.production` and update the environment variables to match your configuration.

      ```bash
      cd api/
      cp .env.example .env.production
      vim .env.production
      cd ../
      ```
   2. In the docker-compose.prod.yml file _(in the root folder)_, update the environment variables to match your configuration.

      ```bash
      vim docker-compose.prod.yml
      ```

3. **Start Certrust:** Start Certrust using Docker Compose:

   ```bash
   docker-compose -f docker-compose.prod.yml up -d
   ```

4. **Initialize the app:** Certrust needs to initialize the app for the first time. Run the following command:

   ```bash
   docker-compose -f docker-compose.prod.yml exec api ./certrust-cli.sh init
   ```

5. **Access the App:** Once the containers are up and running, access the Certrust app through your browser by visiting [http://localhost/](http://localhost/).

</details>

### Development

See [api/](api/) for more information about Laravel API.

See [web/](web/) for more information about Svelte-kit Web UI.

## 🗺️ Roadmap

To keep a track of our progress, we maintain a [roadmap](ROADMAP.md) for the project. The roadmap contains a list of features that we are currently working on and features that we plan to work on in the future.

- See [ROADMAP.md](ROADMAP.md) for more information about incoming changes.

## ❤️ Contributing

Certrust is an open-source project, and we welcome contributions from the community. Here's how you can get involved:

- **Open Issues:** If you encounter issues or have ideas for enhancements, please [open an issue](https://github.com/your-username/certrust/issues) to share your feedback.

- **Pull Requests:** Contribute to the project by submitting pull requests. Follow our contribution guidelines and coding standards.

- **Spread the Word:** If you find Certrust useful, help us reach more users by sharing it with your network.

Check out our [contributing guidelines](CONTRIBUTING.md) for more information.

## ⛓ License

Certrust is released under the [GPL-3.0 License](LICENSE.md). You are free to use, modify, and distribute the software in accordance with the terms of the GPL-3.0 license.

## 🌠 What's next ?

Certrust is in its early stages, and there are numerous possibilities for future development and improvement. Your contributions and feedback will help shape the project's evolution. Together, we can create a powerful tool for SSL certificate management in local development environments.
