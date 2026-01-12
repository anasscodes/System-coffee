# ☕ Coffee POS System

A modern Point of Sale (POS) system built for coffee shops to manage orders, drinks, and payments efficiently.

## 📌 Project Overview

This project is designed for small to medium coffee shops where most customers are walk-in or takeaway.
Orders are handled quickly without requiring customer accounts, focusing on speed and simplicity.

## 🚀 Features

- Create and manage orders
- Select drinks by category (Coffee, Juice, Soda, etc.)
- Order status management (Pending / Paid / Cancelled)
- Daily revenue dashboard
- Revenue chart (last 7 days)
- Download order receipt (PDF)
- Dark mode UI
- Modern and responsive design

## 🧠 Design Choice

Customers are not included in this system because coffee shop orders are usually anonymous.
This keeps the system simple and fast.
A customer module can be added later for loyalty or delivery features.

## 🛠️ Technologies Used

- Laravel
- Blade + Tailwind CSS
- MySQL
- Chart.js
- JavaScript

## ⚙️ Installation

```bash
git clone https://github.com/your-username/coffee-pos.git
cd coffee-pos
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
# System-coffee
