
## Installation

- Clone provided repo
- run `compose install`
- create database
- duplicate `.env_bak` file to `.env`
- link database in .env file
- make sure to update the username and password in the `.env` file

## Migrating & Seeding Database

- run `php artisan migrate --seed` for a fresh database
- run `php artisan migrate:fresh --seed` to reset and refresh database
- lookup for any user email in the created users table db
- all emails will have password `task@123`

## About the Project
- All users will only be able to see their own projects and tasks
- Task statuses will already be created since it is user independent
- You will have to create new Projects at-least one to be able to add a new task
- Once a task has been added, clicking it on dashboard will navigate to the show task page
- Show task page will allow you to 
  - Attach images and documents
  - Add comments
  - Add replies to comments
