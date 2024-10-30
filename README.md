# Human Shop Project

## Project Overview

Human Shop is an innovative platform designed to provide high-quality, second-hand essentials at affordable prices. Our mission is to connect buyers with unique products while ensuring a seamless shopping experience.

## Features

-   User-friendly interface for browsing and purchasing products.
-   Secure user authentication and profile management.
-   Ability to leave reviews and ratings for products.
-   Dynamic product listings with detailed descriptions and images.
-   Shopping cart functionality for easy order management.
-   Promotional offers and discounts for users.

## Technologies Used

-   **Backend**: Laravel (PHP Framework)
-   **Frontend**: Tailwind CSS, Alpine.js
-   **Database**: MySQL
-   **Development Tools**: Vite, Composer, npm

## Installation

To set up the project locally, follow these steps:

1. **Clone the repository**:

    ```bash
    git clone https://github.com/yourusername/human-shop.git
    cd human-shop
    ```

2. **Install dependencies**:

    ```bash
    composer install
    npm install
    ```

3. **Set up the environment**:

    - Copy the `.env.example` file to `.env` and configure your database settings.

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key**:

    ```bash
    php artisan key:generate
    ```

5. **Run migrations**:

    ```bash
    php artisan migrate
    ```

6. **Start the development server**:

    ```bash
    php artisan serve
    ```

7. **Compile assets**:
    ```bash
    npm run dev
    ```

## Usage

-   Navigate to `http://localhost` in your web browser to access the application.
-   Create an account or log in to start shopping.
-   Browse through the product listings, add items to your cart, and proceed to checkout.

## Contributing

We welcome contributions to the Human Shop project! If you have suggestions or improvements, please fork the repository and submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or feedback, please reach out to us at [](mailto:panudetzx2@gmail.com).
