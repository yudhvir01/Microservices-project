# 🚀 Microservices-Based Backend Architecture (Built with Laravel, Lumen & Love)

> *Designed, developed, and debugged by **Yudhvir Singh** — your friendly neighborhood backend wizard.*

Welcome to the ultimate backend blueprint where **Laravel meets Lumen**, and together they power a modern **microservices ecosystem**! This project is a full-fledged example of how to build scalable, secure, and modular APIs with proper authentication, seamless routing, and blazing-fast response times.

---

## 🧠 TL;DR

* 🏁 **API Gateway**: Handles routing & OAuth2 authentication with Laravel + Passport
* 🟡 **Post Microservice**: Built using Lumen for speed, handles all post-related logic
* 💬 **Comment Microservice**: Also built in Lumen, processes all things comments
* 🛡️ **Security**: Only the Gateway can talk to the services, like a bouncer at an elite club
* 🗘️ **Stateless Microservices**: Each service minds its own business and doesn't know the others exist

### 🛠️ Architecture Diagram

```mermaid
graph TD
    FE[Front End<br/>Web / Mobile / 3rd Part Apps] --> AG[API Gateway]
    
    AG --> API1[API 1: Posts Microservices]
    AG --> API2[API 2: Comments Microservices]
    AG --> AUTH[Autherization & Authentication Server]
    
    API1 --> DB1[Posts Database]
    API2 --> DB2[Comments Database]
    AUTH --> DB3[User & OAuth Database]
    
    subgraph "Presentation Layer"
        FE
    end
    
    subgraph "Business Logic Layer"
        AG
        API1
        API2
        AUTH
    end
    
    subgraph "Data Layer"
        DB1
        DB2
        DB3
    end
    
    classDef frontend fill:#3b82f6,stroke:#1e40af,color:#fff
    classDef api fill:#06b6d4,stroke:#0891b2,color:#fff
    classDef gateway fill:#6366f1,stroke:#4338ca,color:#fff
    classDef database fill:#dc2626,stroke:#b91c1c,color:#fff
    
    class FE frontend
    class AG gateway
    class API1,API2,AUTH api
    class DB1,DB2,DB3 database
```
## 🎯 Why Microservices?

Because scaling a monolith is like putting a jet engine on a bicycle. 🚲💥
Microservices are the **backbone of scale**, **independence**, and **deploy-ability** in modern applications — and this repo is your jumpstart to mastering them.

Yudhvir Singh built this as a no-fluff, developer-first learning guide — so you won't just *read*, you'll actually *build*.

---

## 🛠️ Getting Started

### 📅 Clone This Repository

```bash
git clone https://github.com/yudhvir01/Microservices-project.git
cd Microservices-project
```

---

## 🚪 API Gateway Setup (Laravel + Passport)

```bash
cd Gateway
composer install
cp .env.example .env
```

### 🔧 Update `.env` database config:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOURDATABASE
DB_USERNAME=YOURUSERNAME
DB_PASSWORD=YOURPASSWORD
```

### 🔑 Generate app key

```bash
php artisan key:generate
```

### 🧦 Run migrations & seeders

```bash
php artisan migrate --seed
```

### 🔐 Install Passport (and note the client secret/token!)

```bash
php artisan passport:install
```

### 🔌 Add Microservice Routes & Secrets in `.env`

```env
POST_SERVICE_BASE_URL=http://post.microservice.local
POST_SERVICE_SECRET=base64:YOUR_SECRET_1

COMMENT_SERVICE_BASE_URL=http://comment.microservice.local
COMMENT_SERVICE_SECRET=base64:YOUR_SECRET_2
```

---

## 📝 Post Microservice Setup

```bash
cd PostMicroservice
composer install
cp .env.example .env
```

Update `.env` with your DB credentials, then run:

```bash
php artisan migrate --seed
```

Then add:

```env
ACCEPTED_SECRETS=base64:YOUR_SECRET_1
```

---

## 💬 Comment Microservice Setup

```bash
cd CommentMicroservice
composer install
cp .env.example .env
```

Update `.env` with your DB credentials, then run:

```bash
php artisan migrate --seed
```

Then add:

```env
ACCEPTED_SECRETS=base64:YOUR_SECRET_2
```

---

## 🧪 Testing & API Calls

Everything is secured via Passport. You’ll need an **access token** to hit the endpoints.
Use Postman or any REST client you like — we even included a sample Postman collection for you:
📁 `Microservices Github Repo.postman_collection.json`

---

## 🧙‍♂️ Made with Craft by

**Yudhvir Singh**

> *“Eat. Sleep. Laravel. Repeat.”*
> I'm a backend developer passionate about clean architecture, microservices, and building stuff that scales.

Feel free to ✨ star the repo, 🐛 open issues, or 💬 connect with me on [GitHub](https://github.com/yudhvir01)!

---

## ⚙️ Tech Stack

* 🛡️ Laravel (Gateway)
* ⚡ Lumen (Microservices)
* 🔐 Laravel Passport (Auth)
* 🗄️ MySQL
* 🧪 PHPUnit
* 🐐 Composer

---

### 💡 Pro Tip:

Don’t just clone and stare. Run it, break it, fix it, and understand the magic.
