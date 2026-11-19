ERP Suite - Dynamic Enterprise Resource Planning System
An industry-grade, Single Page Application (SPA) ERP system built on a custom, high-performance PHP routing engine, AJAX-driven UI, and a Schema-Driven Dynamic Form architecture.

📖 Overview
This project is a modern, lightweight, and highly scalable ERP framework. Unlike traditional monolithic PHP applications, this system leverages AJAX to load page fragments seamlessly, delivering a snappy, SPA-like experience without the overhead of React or Vue.

At its core is a Dynamic Form Engine that allows administrators to define complex forms, layouts, and validation rules entirely through JSON configuration, entirely eliminating the need to write repetitive HTML or PHP for new modules.

✨ Key Features
🎨 Ultra-Modern UI/UX
Glassmorphism & 3D Depth: A beautiful, custom-built CSS design system featuring soft shadows, mesh gradients, and a premium aesthetic.

Dark/Light Mode: Seamless theme switching powered by CSS variables and localStorage.

Responsive Sidebar: Features a minimized icon-only state, hover-to-expand overlays, and an accordion submenu system.

Live Clock & Progress Bar: Real-time topbar updates and a YouTube-style top loading bar for AJAX requests.

SweetAlert2 Integration: Beautiful, animated modals for confirmations and notifications.

⚡ High-Performance Routing
Custom PHP Router: Forces all requests through a centralized routes.php engine.

Route Caching: Automatically caches database-driven routes into a PHP array file, delivering near-zero latency for page lookups.

AJAX SPA Navigation: Pages load dynamically into the #content-area without a full browser refresh.

🛡️ Enterprise-Grade Security
Hardened Sessions: Database-backed sessions with periodic ID rotation, idle timeouts, and httponly/samesite cookie policies.

Timing Attack Prevention: Constant-time password verification to prevent user enumeration.

Rate Limiting: Built-in login attempt tracking and account lockout mechanisms.

CSRF Protection: Secure token verification for all state-changing requests.

Server-Side Validation: Backend strictly validates JSON schemas without trusting frontend payloads.

🧠 Dynamic Form Engine (Schema-Driven)
JSON Configuration: Define forms (inputs, layout, validation rules) using a standardized JSON schema.

PHP Renderer: Automatically converts JSON into styled HTML inputs, complete with data-val attributes for the frontend validator.

Frontend Validator: A custom, zero-dependency Vanilla JS validation engine that parses data-val rules (e.g., required|email|maxlen:100) and provides real-time error feedback.

Backend Validator: Reads the exact same JSON schema from the server cache to secure the data before database insertion.

Form Builder UI: A built-in interface with a live-preview to create, edit, and manage dynamic forms.

🏗️ Architectural Flow
The Shell: home.php acts as the persistent application shell. It loads the Topbar, Sidebar, and the global app.js.

Navigation: Clicking a sidebar link triggers an AJAX request to routes.php.

Routing: routes.php checks the routes.cache.php file. If the route is valid, it includes the specific page fragment (e.g., pages/settings.php).

Rendering: The page fragment loads into #content-area. If the page uses a dynamic form, FormRenderer::render('form_name') generates the inputs from the JSON cache.

Saving: Forms are submitted via genericSave(), which validates on the frontend, prompts a SweetAlert, and sends a JSON payload to the backend.

Backend Processing: The backend (e.g., SysSettingBk.php) reads the JSON schema from the server cache, re-validates the data, and uses generic DB functions (insertRecordNoLog) to save the record.

🛠️ Tech Stack
Backend: PHP 8.x (Strict Types), MySQL (PDO)

Frontend: Vanilla JavaScript (ES6), jQuery, HTML5, Custom CSS3

Libraries: FontAwesome 6, SweetAlert2, Chart.js

Architecture: AJAX SPA, Custom Router, Schema-Driven Forms

🗄️ Database Requirements
The system relies on a few critical tables:

users (Authentication & Profiles)

user_sessions (Secure DB-backed sessions)

login_attempts (Rate limiting)

routedefinition (Dynamic system routes)

dynamic_forms (JSON form schemas)

ModuleDefinition (Example of a dynamic CRUD table)

🚀 Installation & Setup
Clone the repository to your web server (htdocs or www).

Create a MySQL database and import the provided SQL schema.

Update common/config.php with your database credentials.

Ensure the /cache directory is writable by the server (chmod 0755 or 0777).

Navigate to the base URL in your browser and log in.

📂 Project Structure
text
/
├── assets/          # CSS, JS, Images, Fonts
├── cache/           # Auto-generated route and form caches
├── common/          # Core classes, DB connection, Auth, Helpers
│   ├── FormRenderer.php
│   ├── auth.php
│   └── functions.php
├── engine/          # Backend AJAX processors (e.g., SysSettingBk.php)
├── pages/           # HTML view fragments loaded via AJAX
├── partials/        # Reusable HTML (sidebar.php, topbar.php)
├── home.php         # Main SPA shell
├── routes.php       # Central routing engine
└── login.php        # Secure login portal
🤝 Contributing
This project is currently under active development. When adding new modules:

Create the database table.

Use the Dynamic Form Setup to create the form schema.

Add the new backend action to the appropriate Engine file.

Use genericSave() on the frontend to handle the CRUD operations.

Built with a focus on speed, security, and a premium user experience.
