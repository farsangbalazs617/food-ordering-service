# Project Setup Guide

Follow the steps below to set up and run the project using Docker and Laravel.

## Prerequisites

Ensure you have the following installed on your system:
- Docker
- Docker Compose

## Setup Steps

### 1. Build and Bring Up the Containers

Run the following command to build and start the Docker containers:

```sh
docker compose -f deploy/docker-compose.yml --env-file ./.env up --build
```

### 2. Run Laravel Migrations

Once the containers are up and running, execute the Laravel migrations to set up the database schema:

```sh
docker exec -t laravelapp php artisan migrate
```

### 3. Run Laravel Seeding

Seed the database with initial data using the following command:

```sh
docker exec -t laravelapp php artisan db:seed
```