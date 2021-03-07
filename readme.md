@webiste: http://foostart.com

@package-name: sample
@author: Kang
@date: 27/12/2017
@version: 2.0

@features

1. CRUD
2. Add category to form
3. Language standard
4. Add filters on table data
5. Add token for prevent XSRF


## Step 1: Add service providers to **config/app.php**

1. Foostart\Contact\ContactServiceProvider::class,

## Step 2: Install publish

1. php artisan vendor:publish --provider="Foostart\Contact\ContactServiceProvider" --force
1. php artisan migrate
1. php artisan db:seed --class=ContactsSeeder

