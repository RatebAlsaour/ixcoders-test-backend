set up project 
---


#Environmental requirements

- PHP 8.x
- Laravel 11.x
- Composer
- xampp & wampp


---

##Run steps
run command 
   ```bash
git clone https://github.com/RatebAlsaour/ixcoders-test-backend.git

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan db:seed

npm install

npm run dev
   ```



##login 
#email is *'admin@gmail.com'*
#password is *'admin'*


##Run queue 
run command 
   ```bash
   php artisan queue:work
   ```

##Run schedule 
run command 
   ```bash
   php artisan schedule:run
   ```
Sends a task report every day at 8:00 am by email


#configration smtp

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"



#configration pusher

BROADCAST_CONNECTION=pusher

PUSHER_APP_ID="your-pusher-app-id"
PUSHER_APP_KEY="your-pusher-key"
PUSHER_APP_SECRET="your-pusher-secret"
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME="https"
PUSHER_APP_CLUSTER="mt1"


##Layers used
view -> controller -> servcie -> repo ->dto-> model 

The filtering and searching process is done in BaseRepo

The repo layer is used for research and business logic .

##Notice
#to create repo use command

   ```bash
   php artisan make:repository 

   ```

#to dto repo use command

  ```bash
   php artisan make:dto 

   ```






رهثص 

