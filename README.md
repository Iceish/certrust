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

- **Certificate Renewal:** Automate certificate renewal processes to ensure continuous SSL security.

- **Docker Integration:** Certrust is Docker-ready, making it convenient for users to self-host the service without complicated setup procedures.

- **Web Application:** The Certrust web app is built using Laravel, providing a user-friendly interface for managing certificates and authorities.

## 🚀 Getting Started

To start using Certrust, follow these steps:

1. **Clone the Repository:** Begin by cloning this repository to your local machine:

   ```bash
   https://github.com/EnzoGzz/certrust.git
   ```

2. **Docker Setup:** Install Docker and Docker Compose if you haven't already. Certrust includes Docker Compose configurations for easy deployment.

3. **Initialize Certrust:** Navigate to the project directory and start Certrust using Docker Compose:

   ```bash
   cd certrust
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
   ```
4. _(Optional)_ **Add sail alias:** to your prompt. Add the following to your ~/.bashrc or ~/.zshrc file:

    ```bash
    alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
    ```
5. **Start Certrust:** Start Certrust using Docker Compose:

   ```bash
   sail up -d
   ```
6. **Launch migrations:** Launch the migrations to create the database tables:

   ```bash
   sail artisan migrate
   ```
7. _(Optional)_ **Run dev environment:** Run the following command to run the dev environment:

   ```bash
   sail npm run dev
   ```
8. **Access the Web App:** Once the containers are up and running, access the Certrust web app through your browser by visiting `http://localhost`.

## ❤️ Contributing

Certrust is an open-source project, and we welcome contributions from the community. Here's how you can get involved:

- **Open Issues:** If you encounter issues or have ideas for enhancements, please [open an issue](https://github.com/your-username/certrust/issues) to share your feedback.

- **Pull Requests:** Contribute to the project by submitting pull requests. Follow our contribution guidelines and coding standards.

- **Spread the Word:** If you find Certrust useful, help us reach more users by sharing it with your network.

## ⛓ License

Certrust is released under the [MIT License](LICENSE). You are free to use, modify, and distribute the software in accordance with the terms of the license.

## 🌠 What's next ?

Certrust is in its early stages, and there are numerous possibilities for future development and improvement. Your contributions and feedback will help shape the project's evolution. Together, we can create a powerful tool for SSL certificate management in local development environments.
