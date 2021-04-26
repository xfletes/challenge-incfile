# Challenge IncFile

### To install this application:

    git clone https://github.com/xfletes/chanllenge-incfile.git

    cd chanllenge-incfile

    cp .env.example .env

    php artisan key:generate

    composer install

# Configurations

## Mailtrap 

1.- Create an account on [https://mailtrap.io/](https://mailtrap.io/) 

2.- Go to "Inboxes" on the left nav-bar, then select the default inbox (My inbox)

3.- On the integration dropdown, select Laravel 7+

4.- Copy those configurations and past them into the .env file (You just need username and password)

## .env File

In this File we need to verify the next configurations:

    QUEUE_CONNECTION=database
    BASE_URL_FAKE='https://atomic.incfile.com'
    BASE_URL_ENDPOINT='/fakepost'
    MAX_FAILS=100

## Migrations and Seeders

    php artisan migrate
    php artisan db:seed


# How to use it

We need to use this command to add a job to a queue:

    php artisan post:fake

This command will call a function called `InformationSender`, this function is "pusher", it will push a new job into a database and then into a queue for the `POST` request.

I have set the `retry count` to `3` (that's the default) and interval of `2 seconds` in case the service is down. You can change these variables into:

    Jobs/InformationSender.php

Then we have to run the "Daemon" or `queue` using the next command:

    php artisan queue:work


# Failed jobs

When a "batch" of jobs fails, we will send an email to our admin of this system, using the function `JobFailedEmail`, this will send a basic email displaying the number of jobs fails.

To handle the currency of the emails, you could configure this number into `.env` file, in the global var called `MAX_FAILS`, by default I put it on `10`.

Note: We can use others notification method like Slack, SMS or Database (in this case I use Email).

To see all failed jobs, we can use the Laravel’s default command:

    php artisan queue:failed

We can retry failed jobs using one of these next commands:
    
    ## Retry a single job:
    php artisan queue:retry {job_id}

    ## Retry all jobs:
    php artisan queue:retry all


