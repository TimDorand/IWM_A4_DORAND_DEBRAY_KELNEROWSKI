# EatNearby
Find nearby places and eat what you want !


## Run the project

```
git clone https://github.com/TimDorand/IWM_A4_DORAND_DEBRAY_KELNEROWSKI
cd IWM_A4_DORAND_DEBRAY_KELNEROWSKI
composer install
# Install Curl component
composer update 
cp .env.example .env
```
Edit `.env` to match your environment

```
php artisan migrate
# Seed the tags
php artisan db:seed --class TagsTableSeeder
npm install
npm run dev
# or npm run watch

```

## Experience EatNearby

1. Register yourself (`/register`)
2. Rate a restaurant
3. Filter the restaurants with the tags available. It will return the restaurants if the tag has been commented





