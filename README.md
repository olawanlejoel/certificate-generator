# Certificate Generator

A simple, modern PHP web application to generate personalized certificates. Users can enter their name and organization, and download a custom certificate image.

## Features
- Generate certificates with custom name and organization
- Uses custom fonts and a template image
- Downloadable PNG output
- Modern PHP code structure (OOP)
- Easy to extend with new templates or fields

## Requirements
- [Docker](https://www.docker.com/) (recommended)
- Or PHP 7.4+ (with GD extension enabled) for manual setup

## Running with Docker (Recommended)

1. **Build the Docker image:**
   ```bash
   docker build -t certificate-generator .
   ```
2. **Run the Docker container:**
   ```bash
   docker run -p 8000:80 certificate-generator
   ```
3. **Open your browser and visit:**
   ```
   http://localhost:8000
   ```

This will run the app in an isolated environment with all dependencies included.

---

## Alternative: Run with PHP (No Docker)

1. Ensure PHP GD extension is enabled:
   ```bash
   php -m | grep gd
   ```
2. Start the PHP built-in server:
   ```bash
   php -S localhost:8000 -t public
   ```
3. Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## Project Structure
```
assets/
  images/         # Certificate templates
  fonts/          # Font files
public/
  index.php       # Entry point
  generated/      # Generated certificates
src/
  CertificateGenerator.php  # Main logic
```

## Contributing
Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

## License
This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.
