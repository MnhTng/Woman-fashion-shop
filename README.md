# <p align="center" style="font-size: 50px;">DMT Shop</p>

Welcome to the DMT Shop project documentation. This guide will help you set up, configure, and use the DMT Shop application.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Configuration](#configuration)
- [Usage](#usage)
- [Deployment](#deployment)
- [Troubleshooting](#troubleshooting)

## 📖 Introduction

This DMT_Shop project is designed to provide a convenient and instant environment for online shopping need. It includes a variety of features to streamline the development process and ensure a smooth user experience.

## 🌟 Features

- **User Authentication**:
    - Safe password hashing and login process.
    - Password reset functionality via email.
    - Profile management for updating user details.
- **Cart Management**: Users can add products to their cart, update quantities, and remove items before proceeding to checkout.
- **Checkout Functionality**: Checkout allows customers to finalize their purchase by reviewing items in their cart, entering delivery details, and selecting a payment method. This component streamlines the transaction, enhancing order accuracy and user confidence.
- **Order Processing**: Follow and manage order processing.

## ⚙️ Configuration

### Prerequisites

- PHP >= 7.4
- MySQL

### Steps

1. **Clone the Repository**:
    ```sh
    git clone https://github.com/MnhTng/Woman-fashion-shop.git
    cd Woman-fashion-shop
    ```

2. **Import Database**:
    1. Create a MySQL database.  
    2. Use your preferred method to import the SQL file, for example:
    ```sh
    mysql -u your_username -p your_database < path/to/your_file.sql
    ```

3. **Configuration**:
    - Settings in the `/src/config/` folder:
        ```
        $config['base_url'] = 'http://localhost/' . path
        ```
        ```
        $db = [
            'hostname' => 'localhost',
            'username' => your_username,
            'password' => your_password,
            'database' => your_database
        ]
        ```

## 🚀 Usage

### User Account 
- 1. mnhtngdev - tung123
- 2. mnhtng - tunghpvn2
