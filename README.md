# Tier and Jig site

Documentation for the two of them. Yes in a single repository for now.


# Running the documentation locally

git clone https://github.com/danack/TierJigDocs
cd TierJigDocs/
composer install
mkdir -p var/cache
php -S localhost:8000 -t public


And then click on http://127.0.0.1:8000/