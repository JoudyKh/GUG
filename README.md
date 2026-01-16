GUG - Software Agency Management System 💻🚀

GUG is a robust internal management platform specifically designed for Software Development Companies. It streamlines the entire lifecycle of software projects, from initial client requests to deployment, while managing the internal workforce and team assignments.

🏗️ System Architecture & Core Modules

The project is built using Laravel with a focus on high-performance agency operations:

1. Project & Task Management

Workflow Tracking: Managing different stages of software development (Analysis, Development, Testing, Deployment).

Task Allocation: Assigning technical tasks to developers based on their stack and availability.

Milestone Monitoring: Tracking project deadlines and delivery phases.

2. Workforce & Human Resources

Developer Profiles: Detailed tracking of employee skills, roles (Frontend, Backend, UI/UX), and seniority levels.

Attendance & Performance: Monitoring team contributions and project hours.

Department Structure: Organizing the company into functional units (Mobile Dept, Web Dept, QA, etc.).

3. Client & Requirement Management

Client Portfolios: Managing business relationships and contact history.

Requirement Analysis: Centralizing project specifications and documentation within the system.

4. Admin & Reporting

Insights Dashboard: Real-time metrics on project progress and team productivity.

Role-Based Access Control (RBAC): Distinct permissions for Project Managers, Team Leaders, and Developers.

🛠️ Technical Stack

Framework: Laravel (PHP 8.x)

Database: MySQL (Highly normalized schema for managing relational project data).

Frontend: Blade templates integrated with modern CSS frameworks for a clean, professional administrative UI.

Architecture: Standard MVC with Service Layer patterns to handle complex business logic.

🚀 Key Features

Automated Notifications: Keeps the team updated on task changes and deadline approaches.

Resource Management: Prevents developer burnout by visualizing workload distribution.

Centralized Documentation: A single source of truth for all technical requirements and client feedback.

📂 Installation

Clone & Install:

git clone -b develop [https://github.com/JoudyKh/GUG.git](https://github.com/JoudyKh/GUG.git)
composer install
npm install


Environment Setup:

cp .env.example .env
php artisan key:generate


Migrations:

php artisan migrate


👩‍💻 Developed By

Joudy Alkhatib Building scalable solutions for modern software agencies.
