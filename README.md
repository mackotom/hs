# OverTime

Application simple de gestion des heures supplémentaires.

## Développement Local

Développement Local

### Prérequis

- PHP: 8.1
- Composer: 2
- Git
- Docker
- node: 16.14.2

### Installation

**Cloner le dépôt**

```bash
git clone git@github.com:mackotom/hs.git
```

**Initialisation**

```bash
cp .env.local .env
composer install
sail build
sail up -d
sail artisan key:generate
sail artisan migrate
sail artisan db:seed
```

**Créer le premier utilisateur**

```bash
sail artisan tinker
```

```php
User::create([
    'name' => "admin",
    "email" => "admin@admin.admin",
    "password" => Hash::make('admin'),
    'email_verified_at' => now(),
    'remember_token' => Str::random(10)
    ]);
```


**Launch**

Backend

```bash
sail up -d
```

Frontend

```bash
npm run dev
```

Disponible sur [localhost](http://localhost). 

Compte par défaut: `admin@admin.admin` / `admin`

## Test

**Créer la base de données**

```bash
touch ./database/database.testing.sqlite
```

**Exécuter les tests**

```bash
sail artisan test
```