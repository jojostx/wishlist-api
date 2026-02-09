<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist API Documentation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1a1a1a;
            --secondary: #404040;
            --tertiary: #494949;
            --border: #e5e5e5;
            --bg-light: #fafafa;
            --bg-code: #f5f5f5;
            --success: #2a2a2a;
            --text: #1a1a1a;
            --text-light: #666666;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: var(--text);
            background: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: var(--primary);
            color: white;
            padding: 60px 0;
            border-bottom: 4px solid var(--secondary);
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
        }

        .header-meta {
            margin-top: 20px;
            display: flex;
            gap: 30px;
            font-size: 0.9rem;
        }

        .header-meta span {
            opacity: 0.8;
        }

        .header-meta strong {
            opacity: 1;
            margin-left: 5px;
        }

        nav {
            background: var(--bg-light);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav .container {
            display: flex;
            gap: 30px;
            padding: 15px 20px;
            overflow-x: auto;
        }

        nav a {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            white-space: nowrap;
            padding: 5px 0;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
        }

        nav a:hover {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        main {
            padding: 60px 0;
        }

        section {
            margin-bottom: 80px;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary);
            font-weight: 700;
            border-bottom: 3px solid var(--primary);
            padding-bottom: 10px;
        }

        h3 {
            font-size: 1.5rem;
            margin-top: 40px;
            margin-bottom: 15px;
            color: var(--secondary);
            font-weight: 600;
        }

        h4 {
            font-size: 1.2rem;
            margin-top: 25px;
            margin-bottom: 10px;
            color: var(--tertiary);
            font-weight: 600;
        }

        p {
            margin-bottom: 15px;
            color: var(--text-light);
            line-height: 1.8;
        }

        code {
            background: var(--bg-code);
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            color: var(--primary);
            border: 1px solid var(--border);
        }

        pre {
            background: var(--bg-code);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 20px;
            overflow-x: auto;
            margin: 20px 0;
            border-left: 4px solid var(--primary);
        }

        pre code {
            background: none;
            padding: 0;
            border: none;
            font-size: 0.85rem;
            line-height: 1.6;
        }

        .endpoint {
            background: var(--bg-light);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 25px;
            margin: 25px 0;
        }

        .endpoint-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .method {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .method.get {
            background: var(--secondary);
            color: white;
        }

        .method.post {
            background: var(--primary);
            color: white;
        }

        .method.delete {
            background: var(--tertiary);
            color: white;
        }

        .endpoint-path {
            font-family: 'Courier New', monospace;
            font-size: 1rem;
            color: var(--primary);
            font-weight: 500;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge.protected {
            background: var(--primary);
            color: white;
        }

        .badge.public {
            background: var(--bg-code);
            color: var(--text);
            border: 1px solid var(--border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border: 1px solid var(--border);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: var(--bg-light);
            font-weight: 600;
            color: var(--primary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        td code {
            font-size: 0.85rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .info-box {
            background: var(--bg-light);
            border-left: 4px solid var(--secondary);
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .info-box strong {
            display: block;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .quick-start {
            background: var(--primary);
            color: white;
            padding: 40px;
            border-radius: 8px;
            margin: 40px 0;
        }

        .quick-start h3 {
            color: white;
            margin-top: 0;
        }

        .quick-start code {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .quick-start pre {
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .card {
            background: var(--bg-light);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 25px;
        }

        .card h4 {
            margin-top: 0;
        }

        footer {
            background: var(--primary);
            color: white;
            padding: 40px 0;
            margin-top: 80px;
            text-align: center;
        }

        footer a {
            color: white;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        footer a:hover {
            border-bottom-color: white;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .endpoint-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Wishlist API</h1>
            <p>RESTful API for e-commerce wishlist functionality built with Laravel</p>
            <div class="header-meta">
                <span>Version: <strong>1.0.0</strong></span>
                <span>Base URL: <strong>{{ config('app.url') }}/api</strong></span>
                <span>Format: <strong>JSON</strong></span>
            </div>
        </div>
    </header>

    <nav>
        <div class="container">
            <a href="#overview">Overview</a>
            <a href="#quick-start">Quick Start</a>
            <a href="#authentication">Authentication</a>
            <a href="#products">Products</a>
            <a href="#wishlist">Wishlist</a>
            <a href="#errors">Error Handling</a>
            <a href="#testing">Testing</a>
        </div>
    </nav>

    <main>
        <div class="container">
            <section id="overview">
                <h2>Overview</h2>
                <p>
                    The Wishlist API provides a complete backend solution for managing user wishlists in an e-commerce environment.
                    Users can register, authenticate, browse products, and manage their personal wishlist through a clean RESTful interface.
                </p>

                <div class="grid">
                    <div class="card">
                        <h4>Token-Based Auth</h4>
                        <p>Secure authentication using Laravel Sanctum with bearer tokens</p>
                    </div>
                    <div class="card">
                        <h4>RESTful Design</h4>
                        <p>Clean, predictable endpoints following REST principles</p>
                    </div>
                    <div class="card">
                        <h4>Input Validation</h4>
                        <p>Comprehensive validation with detailed error responses</p>
                    </div>
                    <div class="card">
                        <h4>Test Coverage</h4>
                        <p>Full test suite ensuring reliability and correctness</p>
                    </div>
                </div>
            </section>

            <section id="quick-start" class="quick-start">
                <h3>Quick Start</h3>
                <p>Get started with the Wishlist API in minutes:</p>

                <h4>1. Installation</h4>
                <pre><code>git clone https://github.com/jojostx/wishlist-api.git
cd wishlist-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=ProductSeeder</code></pre>

                <h4>2. Start the Server</h4>
                <pre><code>php artisan serve</code></pre>

                <h4>3. Make Your First Request</h4>
                <pre><code>curl -X GET http://localhost:8000/api/products</code></pre>
            </section>

            <section id="authentication">
                <h2>Authentication</h2>
                <p>
                    The API uses token-based authentication powered by Laravel Sanctum. After registration or login,
                    you'll receive a bearer token that must be included in the <code>Authorization</code> header for protected endpoints.
                </p>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method post">POST</span>
                        <span class="endpoint-path">/api/register</span>
                        <span class="badge public">Public</span>
                    </div>
                    <p>Register a new user account and receive an authentication token.</p>

                    <h4>Request Body</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Type</th>
                                <th>Required</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>name</code></td>
                                <td>string</td>
                                <td>Yes</td>
                                <td>User's full name</td>
                            </tr>
                            <tr>
                                <td><code>email</code></td>
                                <td>string</td>
                                <td>Yes</td>
                                <td>Valid email address (must be unique)</td>
                            </tr>
                            <tr>
                                <td><code>password</code></td>
                                <td>string</td>
                                <td>Yes</td>
                                <td>Password (min 8 characters)</td>
                            </tr>
                            <tr>
                                <td><code>password_confirmation</code></td>
                                <td>string</td>
                                <td>Yes</td>
                                <td>Must match password field</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>curl -X POST http://localhost:8000/api/register \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Ada Lovelace",
    "email": "ada@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'</code></pre>

                    <h4>Example Response (201 Created)</h4>
                    <pre><code>{
  "status": "Request was successful.",
  "message": null,
  "data": {
    "user": {
      "id": 1,
      "name": "Ada Lovelace",
      "email": "ada@example.com",
      "created_at": "2024-01-15T10:30:00.000000Z"
    },
    "token": "1|xyz123abc456def789..."
  }
}</code></pre>
                </div>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method post">POST</span>
                        <span class="endpoint-path">/api/login</span>
                        <span class="badge public">Public</span>
                    </div>
                    <p>Authenticate an existing user and receive a token.</p>

                    <h4>Request Body</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Type</th>
                                <th>Required</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>email</code></td>
                                <td>string</td>
                                <td>Yes</td>
                                <td>User's email address</td>
                            </tr>
                            <tr>
                                <td><code>password</code></td>
                                <td>string</td>
                                <td>Yes</td>
                                <td>User's password</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>curl -X POST http://localhost:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "ada@example.com",
    "password": "password123"
  }'</code></pre>
                </div>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method post">POST</span>
                        <span class="endpoint-path">/api/logout</span>
                        <span class="badge protected">Protected</span>
                    </div>
                    <p>Revoke the current access token.</p>

                    <h4>Example Request</h4>
                    <pre><code>curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"</code></pre>
                </div>

                <div class="info-box">
                    <strong>Using Bearer Tokens</strong>
                    <p>Include the token in the Authorization header for all protected endpoints:</p>
                    <code>Authorization: Bearer YOUR_TOKEN_HERE</code>
                </div>
            </section>

            <section id="products">
                <h2>Products</h2>
                <p>Browse the product catalog. Product endpoints are publicly accessible.</p>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method get">GET</span>
                        <span class="endpoint-path">/api/products</span>
                        <span class="badge public">Public</span>
                    </div>
                    <p>Retrieve a paginated list of all available products.</p>

                    <h4>Query Parameters</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Type</th>
                                <th>Default</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>page</code></td>
                                <td>integer</td>
                                <td>1</td>
                                <td>Page number</td>
                            </tr>
                            <tr>
                                <td><code>per_page</code></td>
                                <td>integer</td>
                                <td>15</td>
                                <td>Items per page (min 1, max 100)</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>curl -X GET http://localhost:8000/api/products?page=1&per_page=10</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
  "status": "Request was successful.",
  "message": null,
  "data": {
    "data": [
      {
        "id": "1",
        "name": "Laptop Pro 15",
        "description": "High-performance laptop...",
        "price": 1299.99
      }
    ],
    "links": {
      "first": "http://localhost:8000/api/products?page=1",
      "last": "http://localhost:8000/api/products?page=4",
      "prev": null,
      "next": "http://localhost:8000/api/products?page=2"
    },
    "meta": {
      "current_page": 1,
      "from": 1,
      "last_page": 4,
      "path": "http://localhost:8000/api/products",
      "per_page": 10,
      "to": 10,
      "total": 40
    }
  }
}</code></pre>
                </div>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method get">GET</span>
                        <span class="endpoint-path">/api/products/{id}</span>
                        <span class="badge public">Public</span>
                    </div>
                    <p>Retrieve details of a specific product by ID.</p>

                    <h4>Example Request</h4>
                    <pre><code>curl -X GET http://localhost:8000/api/products/1</code></pre>
                </div>
            </section>

            <section id="wishlist">
                <h2>Wishlist Management</h2>
                <p>Manage authenticated user's wishlist. All wishlist endpoints require authentication.</p>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method get">GET</span>
                        <span class="endpoint-path">/api/wishlist</span>
                        <span class="badge protected">Protected</span>
                    </div>
                    <p>Retrieve the current user's complete wishlist with product details.</p>

                    <h4>Example Request</h4>
                    <pre><code>curl -X GET http://localhost:8000/api/wishlist \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
  "status": "Request was successful.",
  "message": null,
  "data": [
    {
      "id": 1,
      "product": {
        "id": 5,
        "name": "Wireless Mouse",
        "price": "29.99",
        "stock": 150
      },
      "added_at": "2024-01-15T11:00:00.000000Z"
    }
  ]
}</code></pre>
                </div>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method post">POST</span>
                        <span class="endpoint-path">/api/wishlist</span>
                        <span class="badge protected">Protected</span>
                    </div>
                    <p>Add a product to the authenticated user's wishlist.</p>

                    <h4>Request Body</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Type</th>
                                <th>Required</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>product_id</code></td>
                                <td>integer</td>
                                <td>Yes</td>
                                <td>ID of the product to add</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>curl -X POST http://localhost:8000/api/wishlist \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"product_id": 1}'</code></pre>

                    <h4>Example Response (201 Created)</h4>
                    <pre><code>{
  "status": "Request was successful.",
  "message": "Product added to wishlist successfully",
  "data": {
    "id": 1,
    "product_id": 1,
    "product": {
      "id": 1,
      "name": "Laptop Pro 15",
      "price": "1299.99"
    },
    "created_at": "2024-01-15T11:00:00.000000Z"
  }
}</code></pre>

                    <div class="info-box">
                        <strong>Note</strong>
                        <p>Attempting to add a product that's already in the wishlist will return a 409 Conflict error.</p>
                    </div>
                </div>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method delete">DELETE</span>
                        <span class="endpoint-path">/api/wishlist/{product_id}</span>
                        <span class="badge protected">Protected</span>
                    </div>
                    <p>Remove a product from the authenticated user's wishlist.</p>

                    <h4>Example Request</h4>
                    <pre><code>curl -X DELETE http://localhost:8000/api/wishlist/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
  "status": "Request was successful.",
  "message": "Product removed from wishlist successfully",
  "data": null
}</code></pre>
                </div>
            </section>

            <section id="errors">
                <h2>Error Handling</h2>
                <p>The API uses standard HTTP status codes and returns consistent error responses.</p>

                <h3>Response Structure</h3>
                <p>All API responses follow this structure:</p>
                <pre><code>{
  "status": "Request status message",
  "message": "Specific message or null",
  "data": {} // Response data or error details
}</code></pre>

                <h3>HTTP Status Codes</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>200</td>
                            <td>OK</td>
                            <td>Request successful</td>
                        </tr>
                        <tr>
                            <td>201</td>
                            <td>Created</td>
                            <td>Resource created successfully</td>
                        </tr>
                        <tr>
                            <td>401</td>
                            <td>Unauthorized</td>
                            <td>Authentication required or token invalid</td>
                        </tr>
                        <tr>
                            <td>404</td>
                            <td>Not Found</td>
                            <td>Resource not found</td>
                        </tr>
                        <tr>
                            <td>409</td>
                            <td>Conflict</td>
                            <td>Resource already exists (duplicate)</td>
                        </tr>
                        <tr>
                            <td>422</td>
                            <td>Unprocessable Entity</td>
                            <td>Validation failed</td>
                        </tr>
                        <tr>
                            <td>500</td>
                            <td>Server Error</td>
                            <td>Internal server error</td>
                        </tr>
                    </tbody>
                </table>

                <h3>Validation Errors</h3>
                <p>When validation fails, the API returns a 422 status with detailed field errors:</p>
                <pre><code>{
  "status": "Request failed.",
  "message": "The given data was invalid.",
  "data": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 8 characters."]
  }
}</code></pre>

                <h3>Authentication Errors</h3>
                <pre><code>{
  "status": "Request failed.",
  "message": "Unauthenticated.",
  "data": null
}</code></pre>
            </section>

            <section id="testing">
                <h2>Testing</h2>
                <p>The API includes comprehensive test coverage for all endpoints and business logic.</p>

                <h3>Running Tests</h3>
                <pre><code>php artisan test</code></pre>

                <h3>Test Coverage</h3>
                <div class="grid">
                    <div class="card">
                        <h4>Feature Tests</h4>
                        <p>End-to-end testing of API endpoints, authentication flows, and user interactions</p>
                    </div>
                    <div class="card">
                        <h4>Unit Tests</h4>
                        <p>Model relationships, business logic, and data validation</p>
                    </div>
                    <div class="card">
                        <h4>Integration Tests</h4>
                        <p>Database interactions, query optimization, and data integrity</p>
                    </div>
                </div>

                <h3>Test Suites</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Suite</th>
                            <th>File</th>
                            <th>Coverage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Authentication</td>
                            <td><code>tests/Feature/AuthTest.php</code></td>
                            <td>Registration, login, logout flows</td>
                        </tr>
                        <tr>
                            <td>Products</td>
                            <td><code>tests/Feature/ProductTest.php</code></td>
                            <td>Product listing and retrieval</td>
                        </tr>
                        <tr>
                            <td>Wishlist</td>
                            <td><code>tests/Feature/WishlistTest.php</code></td>
                            <td>Wishlist CRUD operations</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>Wishlist API - Built with Laravel</p>
            <p style="margin-top: 10px; opacity: 0.8;">
                <a href="https://github.com/jojostx/wishlist-api" target="_blank">View on GitHub</a> |
                <a href="{{ config('app.url') }}/api/products" target="_blank">Try the API</a>
            </p>
        </div>
    </footer>
</body>

</html>
