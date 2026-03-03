# Info Health – API

API Laravel do projeto Info Health.

## Tecnologias

| Tecnologia | Versão | Uso |
|------------|--------|-----|
| PHP | 8.2+ | Runtime |
| Laravel | 12 | Framework backend |
| Laravel Sanctum | 4.3 | Autenticação API |
| PostgreSQL | 16 | Banco de dados |

## Desenvolvimento local

**Pré-requisitos:** PHP 8.2+, Composer, PostgreSQL 16.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

API em `http://localhost:8000`.

**Com Docker:** `docker compose up` (sobe API + PostgreSQL; para incluir o frontend, construa antes a imagem do **info-health-webapp**).

## Deploy no Render.com

1. Crie um **Web Service** e conecte o repositório. Escolha **Docker** como runtime (o Render usa o `Dockerfile` da raiz).
2. **Crie um PostgreSQL** no Render (Dashboard → New → PostgreSQL) e copie a **Internal Database URL**.
3. **Variáveis de ambiente** (obrigatórias):
   - `APP_KEY` — gere com `php artisan key:generate --show`
   - `APP_URL` — URL do serviço no Render (ex: `https://info-health-api.onrender.com`)
   - `FRONTEND_URL` — URL do frontend no Render (ex: `https://info-health-webapp.onrender.com`) para CORS
   - `DATABASE_URL` — Internal Database URL do PostgreSQL criado no passo 2
   - `DB_CONNECTION=pgsql`
   - `APP_ENV=production`, `APP_DEBUG=false`
4. O container roda `php artisan migrate --force` na inicialização e sobe o servidor na porta `PORT` do Render.
5. **Usuário de teste:** após o deploy, existe o usuário `admin@infohealth.com` / senha `123456` (criado pela migration de seed).

Veja também `render.yaml` na raiz.
