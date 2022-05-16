## Hosted Link
https://taskmanagement.tooeasy.in/

## Tech Stack

Backend
- Laravel 8
- Laravel UI Starter Pack (converted to tailwind)
- Intervention Image Library

Front end
- Vue 3
- Tailwind 3
- Headless Ui (Tailwind)
- Tailwind UI Components Library
- Axios

Database 
- MySQL

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
Points Completed
- All users will only be able to see their own projects and tasks
- Task statuses will already be created since it is user independent
- You will have to create new Projects at-least one to be able to add a new task
- Once a task has been added, clicking it on dashboard will navigate to the show task page
- Show task page will allow you to 
  - Attach images and documents
  - Add comments
  - Add replies to comments

Points not completed
- Automated testing (lack of time and practice)

## Permissions (On Linux Or Mac Environment)
Make sure to run the following command if installing on linux or mac environment
- `sudo chmod -R 777 public/images/`
- `sudo chmod -R 0755 public/images/attachment/`
- `sudo chmod -R 777 storage`

## Approach 
The project was pretty simple to design and develop. I started with setting up the database and eloquent relations first (this is my standard approach for most new projects).

I used the pre-existing Laravel UI package which is generally available in Laravel 7, but I changed the FrontEnd framework from Bootstrap 5 to Tailwind 3. This was initially time comsuming, but later rewarding as i could use Tailwind UI Component Library for all the frontend components.

Thereafter, the approach was simple, I read the requirement and tried to complete them one by one.

## Dislikes
The time frame of 2 days was pretty less for the amount of work required to delivery this project. I have worked 6-8 hours for 3 days to complete this work.

## Requirement Status
1. [x] User should be able to sign up and login
2. [x] User should be able to Create, Update and Delete projects
3. [x] Users should be able to tasks under specific project
4. [x] Tasks should be editable and also can be deleted.
5. [ ] Tasks should be prioritized within a project - (**DB structure ready, UI not done**)
6. [x] Tasks should have deadlines.
7. [x] Apply proper status(to-do, in-progress,done) of tasks
8. [x] Under the task, the user can add comments and make sure the nested comment is applicable so that if we want to respond to the specific comment then we should be able to do that.
10. [x] Comment should be deletable
11. [x] Users can also attach files in task description.
11. [ ] Users can also attach files in comment.
13. [ ] It should have automated tests for all functionality.
