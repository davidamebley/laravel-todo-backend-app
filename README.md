# Todo-Backend Application (with Laravel)

## Description
This is a backend for a personal TODO application that requires users to be logged in before they can call the APIs. One user can create multiple todo items, and one todo item can only belong to a single user. The data models are as follows:

### Todo:
- Id
- name
- Description (Optional)
- User id
- Created timestamp
- Updated timestamp
- Status

### User:
- Id
- Email
- Password
- Created timestamp
- Updated timestamp

## Core features
The application has the following REST API endpoints:
- POST /api/v1/signup: Sign up as an user of the system, using email & password
- POST /api/v1/signin: Sign in using email & password. The system will return the
JWT token that can be used to call the APIs that follow
- PUT /api/v1/changePassword: Change user’s password
- GET /api/v1/todos?status=[status]: Get a list of todo items. Optionally, a status
query param can be included to return only items of specific status. If not
present, return all items
- POST /api/v1/todos: Create a new todo item
- PUT /api/v1/todos/:id : Update a todo item
- DELETE /api/v1/todos/:id : Delete a todo item

## Installation
- To run this backend, first make sure you have [PHP](https://www.php.net/manual/en/install.php), [Laravel](https://laravel.com/docs/9.x/installation), and [Composer](https://getcomposer.org/download/) installed. **Note:** You have to install Composer first, then you can install Laravel.
- The database used was created with Postgresql. Please make sure you have it installed or follow the instructions [here](https://www.postgresql.org/download/) to install it. You can combine [pgAdmin](https://www.pgadmin.org/download/) with your postgresql database to perform interactions with your database easily.
- After installing these, clone this project repo onto your local machine by running the following in your Terminal:
> <code>git clone https://github.com/davidamebley/laravel-todo-backend-app.git</code>
- Move into the project root directory by running the following in your terminal:
> <code>cd laravel-todo-backend-app</code>
- In the project root directory, run the following to install the Composer dependencies for this project:
> <code>composer install</code>
- Create a copy of the <code> .env </code> file by cloning the <code> .env.example </code> file that comes with this project and renaming it. 
Use the following command: 
> <code> cp .env.example .env</code> 
    - This clones and renames it to <code>.env</code>
- Generate an app encryption key in the <code> .env </code> file (which is required by Laravel to encode various elements of the app). Run the following command in the Terminal:
> <code> php artisan key:generate </code>
    - **Note:** make sure Laravel is installed via Composer and the <code> .env</code> file is created before completing this step.
- Create an empty postgresql database for this application. You may use the original name that was used for this project as 
> 'laravel_todo'
- Open the <code> .env </code> file and fill the various database connection fields with credentials from your created database. You may retrieve the necessary information using pgAdmin or the postgresql database tool you used. The fields you need to fill are:
> DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, & DB_PASSWORD.
    - **Note:** Change the default <code> DB_CONNECTION </code> value in the <code> .env </code> file to __*'pgsql'*__
- Migrate the database after completing the credentials above by running the follwoing command:
> <code> php artisan migrate </code>
    - **Note:** You may use your database tool like pgAdmin to check if all your database tables were migrated successfully
- After running your migration successfully, run the following command:
> <code> php artisan serve </code>
    - Running this command starts the application server and runs the app at:
> http://127.0.0.1:8000
- After starting the server successfully, you may proceed with working with the API endpoints together with the default URL provided above. Use [Postman](https://www.postman.com/downloads/) or any tool of your choice to test the endpoints and send http requests.

### Tech stack:
- <strong>Language:</strong> PHP
- <strong>Framework:</strong> Laravel
- <strong>Database:</strong> PostgreSQL
- <strong>Authentication:</strong> Laravel Sanctum

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
