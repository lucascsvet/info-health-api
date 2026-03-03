# Info Health

Sistema de informações de saúde para trabalhadores, permitindo cadastro de dados clínicos, acesso via login e compartilhamento seguro em situações de emergência através de QR Code.

## Tecnologias

| Componente | Stack |
|------------|-------|
| **Frontend** | Vue 3, Vite 7, Vue Router 5, Bootstrap 5, Bootstrap Icons, QRCode.js, vue-3-mask |
| **Backend** | PHP 8.2, Laravel 12, Laravel Sanctum |
| **Banco de dados** | PostgreSQL 16 |
| **Deploy** | Docker, Render.com |

## Estrutura do projeto

```
├── info-health-api/      # API REST (Laravel)
├── info-health-webapp/   # Frontend SPA (Vue 3 + Vite)
```

## Pré-requisitos

- **Node.js** 18+ e npm (para o frontend)
- **PHP** 8.2+ e **Composer** (para a API)
- **PostgreSQL** 16 (ou Docker para rodar tudo)

## Como rodar

### Opção 1: Desenvolvimento local (API + Frontend separados)

#### 1. API (Laravel)

```bash
cd info-health-api
composer install
cp .env.example .env
php artisan key:generate
```

Configure o banco no `.env` (PostgreSQL):

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=info_health_api
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

Depois rode as migrações e inicie o servidor:

```bash
php artisan migrate
php artisan serve
```

API em `http://localhost:8000` (ou porta padrão do Laravel).

#### 2. Frontend (Vue)

```bash
cd info-health-webapp
npm install
cp .env.example .env
```

Configure `.env`:

```
VITE_API_URL=http://localhost:8000
```

Inicie o frontend:

```bash
npm run dev
```

Frontend em `http://localhost:5173`.

---

### Opção 2: Docker (frontend + API)

1. **Build do frontend** (uma vez, ou quando alterar o webapp):

```bash
cd info-health-webapp
docker compose build
```

2. **Subir a stack completa**:

```bash
cd info-health-api
docker compose up
```

- API: `http://localhost:8000`
- Frontend: `http://localhost:3000` (se usar o proxy do frontend para a API)

---

## Variáveis de ambiente

### API (`.env`)

| Variável | Descrição |
|----------|-----------|
| `APP_KEY` | Chave da aplicação (gerar com `php artisan key:generate --show`) |
| `APP_URL` | URL da API (ex: `https://info-health-api.onrender.com`) |
| `FRONTEND_URL` | URL do frontend para CORS (ex: `https://info-health-webapp.onrender.com`) |
| `DB_*` | Configurações do PostgreSQL |

### Frontend (`.env`)

| Variável | Descrição |
|----------|-----------|
| `VITE_API_URL` | URL da API (ex: `http://localhost:8000` ou URL do Render) |

## Deploy no Render.com

1. **API**: crie um Web Service com Docker, conecte o repositório e configure as variáveis (`APP_KEY`, `APP_URL`, `FRONTEND_URL`, `DATABASE_URL` se usar PostgreSQL gerenciado).
2. **Frontend**: crie um Static Site, conecte o repositório e defina `VITE_API_URL` com a URL da API no Render.
3. Deploy a API primeiro; depois copie a URL e use em `VITE_API_URL` do frontend.
4. Configure `FRONTEND_URL` na API com a URL do frontend para CORS.

Veja `render.yaml` em cada pasta para mais detalhes.
