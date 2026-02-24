# Info Health – API

API Laravel do projeto Info Health.

## Desenvolvimento local

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Com Docker: `docker compose up` (sobe apenas a API; para API + frontend, construa antes a imagem do **info-health-webapp**).

## Deploy no Render.com

1. Crie um **Web Service** e conecte o repositório. Escolha **Docker** como runtime (o Render usa o `Dockerfile` da raiz).
2. **Variáveis de ambiente** (no dashboard):
   - `APP_KEY` — gere com `php artisan key:generate --show`
   - `APP_URL` — URL do serviço no Render (ex: `https://info-health-api.onrender.com`)
   - `FRONTEND_URL` — URL do frontend no Render (ex: `https://info-health-webapp.onrender.com`) para CORS em produção
   - `APP_ENV=production`, `APP_DEBUG=false`
3. O container escuta na porta que o Render define (`PORT`, padrão 10000); o Dockerfile já está configurado.
4. **Banco:** o projeto usa SQLite por padrão. No Render o disco é efêmero (dados se perdem no redeploy). Para produção com dados persistentes, crie um **PostgreSQL** no Render e configure `DATABASE_URL` e `DB_CONNECTION=pgsql`.

Veja também `render.yaml` na raiz.
