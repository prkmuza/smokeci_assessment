Installation
=================================

## Installation is in 2 Parts:
-Part 1 Front End
-Part 2 Back End

-PhpUnit test screenshots are in Git project root pdf (Pana_smokeci_PhpUnit_Tests.pdf)
-Images of a basic user Journey are on Git project root pdf(Basic_User_Story_Images.pdf)


Part 1
=================================
## Here's a step-by-step guide to running a front end with PHP 8.0 on Docker container  port 8080.


## Step 1: Install Docker
Open the folder "front_end" in Git Project root.
If you haven't already, download and install Docker from the official website.

## Step 2: Create a Dockerfile
Skip this step if you download repo from git, The Dockerfile will already be in the git repository you pulled, but if you are starting from scratch, create a new file named Dockerfile in the front_end  directory. This file will contain the instructions for building your Docker image. 

## Step 3: Add PHP and Apache to the Dockerfile
Skip this step if you download repo from git . This projects runs on a php:8.0-apache server

## Step 4: Expose Port 8080
Skip this step if you download repo from git . Add the following line to your Dockerfile:

EXPOSE 8080

This will expose port 8080 from the container to the host machine.

## Step 5: Build the Docker Image
Run the following command(Git Bash) in the project(front_end) root to create the image :

docker-compose build

This will build a Docker image

## Step 6: Run the Docker Container
Run the following command(Git Bash) in the project(front_end)  root to start a new container from your image:

docker-compose up -d

This will start a new container, mapping port 8080 on the host machine 

## Step 7: Verify
Open a web browser and navigate to http://localhost:8080. You should see the assessment home page, indicating that your PHP server is up and running!

That's it! You now have a PHP Docker server running on port 8080. You can modify your Dockerfile to add additional dependencies or configurations as needed.


Part 2
=================================
## Part 2: Here's a step-by-step guide to creating a microservice using Laravel 9, PHP 8.0.2 apache on Docker container port 9000:

## Step 1: Create a new Laravel project using Composer
Open the folder "back_end_microservice" in Git Project root
If you have already downloaded the repository from git you can skip this step. Run the following command to create a new Laravel project:

composer.phar create-project --prefer-dist laravel/laravel:^9.0 back_end_microservice

All other necessary extensions and dependencies for this specific project have been installed on the project for example, had to install MongoDB PHP extension on my local machine, and in the steps below this is done in the Dockerfile as well so changes take place in container

## Step 2: Install the required PHP library for phone number validation
Again you can skip this step if you download repo from git, Run the following command to install the giggsey/libphonenumber-for-php library:

composer.phar require giggsey/libphonenumber-for-php

We use this library to validate the phone numbers.

## Step 3: Create a new API endpoint for phone number validation and storage
Skip this step if you download repo from git , In the Laravel root directory, create a new file app/Http/Controllers/PhoneNumberController.php

## Step 4: Define the API endpoint route
Skip this step if you download repo from git , In the Laravel root  directory, open the routes/web.php file and add the following route:

Route::get('/api/validate-phone-numbers/{country_code_number}/{country_code_string}/{quantity}', [App\Http\Controllers\PhoneNumberController::class, 'validateAndStore']);

In the actual controller PhoneNumberController.php is where the magic happens for giggsey/libphonenumber-for-php to validate phone numbers, if you downloaded repo, you can take a look

## Step 5: Create a Dockerfile for the PHP application
Skip this step if you download repo from git , Create a new file Dockerfile in the Laravel root  directory and add necessary dependencies to make project work.

## Step 6: Create a docker-compose.yml file
Skip this step if you download repo from git , Create a new file docker-compose.yml in the Laravel root  directory . This file specifies the ports for the laravel app , mongoDB and volumes as well, this will run Lumen app on port 9000 and mongo db 27017

## Step 7: Create Apache Virtual Host Configuration (apache-config.conf)
Skip this step if you download repo from git, Place apache-config.conf in project Laravel root  this will have some basic Apache setting to make project run on server
Another configuration was the CORS policy to actually alloq port 8080 to send data to port 9000.

## Step 8: Build and run the Docker image
Run the following command(in Git Bash or terminal) in the project(back_end) Laravel root  to create the image :

docker-compose build

## Step 9: Build and run the Docker containers
Run the following command(in Git Bash or terminal) in the project(back_end )  Laravel root  to start a new container from your image:

docker-compose up -d

## Step 10: Create the database and collection you are going to use in MongoDB
For this I downloaded MongoDB Compass GUI, an awesome tool to visually see what's going on. Connected to mongodb://localhost:27017 in mongo DB UI after the docker container for mongo started and then created a database(phone_numbers) and a collection(numbers). All done, now the laravel app will be able to send and retrieve data from the DB.

If you want to import a test collection I have placed a json file in git root directory database name "phone_numbers" and collection name "numbers"





