<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

Suppose we have a document management system. Our application has two types of users:
authors and clients. Authors create documents and frequently update those documents.
Document has two sections content body and tags. The body section consists of three parts
namely introduction, facts, summary. A lot of clients look at different documents every day.
But clients don't understand what has changed since their previous visit.
The client requests us to create a diff view of the documents (Ex: GitHub/Bitbucket commit
diff). so that they can see changes to the document.
Now, we create document versions when the author makes any changes to the document. Also,
clients previously viewed document content. So that we can differentiate the documents as
per the client's request.



## Database Tables (column):
- Users: id, username, email, status (active or inactive) (only clients).
- Documents: id, title, current_version, status (active or inactive)
- Document Versions: id, document_id, version, body_content, tags_content

#### Sample Data (column)
    - body_content: {“introduction”: “<ul><li>Federal Government's superannuation
        reforms in the 2020.\t</li></ul>”, “facts”: “<ul><li>Federal Government's
        superannuation reforms in the 2020.\t</li></ul>”, “summary”: “<ul><li>Federal
        Government's superannuation reforms in the 2020.\t</li></ul>” }
    - tags_content: <ul><li>Federal Government's superannuation reforms in the
        2020.\t</li></ul>   
- Document Users: id, document_id, user_id, last_viewed_version

## TASK:
    - Create database with above tables and populate fake data
        - 300 active/inactive users, 1200 active/inactive documents, 2500 document version
          (using 500 documents), 8400 document users

    - Write a solution, which creates document diff and store it in database for clients, every
      day at 12:05 am. Make sure below things:
         1. You can add columns or tables in adatabase and also can use any package.
         2. Your server has 128mb memory limit and 200 seconds of max execution time.
         3. Do not create diff for inactive users and documents.
         4. Do not create diff for documents which latest diff already exists.
         5. Do not create document diff for those clients who already viewed the latest diff.

## Install App:
    - composer install / update
    - rename .env.example like .env
    - put necessary information into .env file
    - php artisan serve

## API URL:
    1. Register
    http://127.0.0.1:8000/api/register
    method:POST
    payload Example
        {
        "name" : "ripon",
        "email" : "ripon1@gmail.com",
        "password" : "Rip123456@",
        "password_confirmation": "Rip123456@"
        }

    2. Login
    http://127.0.0.1:8000/api/login
    method:POST
    payload Example
        {
        "email" : "ripon1@gmail.com",
        "password" : "Rip123456@"
        }

    3. Store / Create Document
    http://127.0.0.1:8000/api/document
    method:POST
    payload Example
        {
        "title" : "title Sample Data",
        "body_content" : "body_content Sample Data"
        "tags_content" : "tags_content Sample Data"
        } 

    4. Edit / Update Document
    http://127.0.0.1:8000/api/document/1
    method:POST
    payload Example
        {
        "title" : "title Sample Data",
        "body_content" : "body_content Sample Data"
        "tags_content" : "tags_content Sample Data"
        } 

    5. All Document
    http://127.0.0.1:8000/api/document
    method:GET

    6. Single Document
    http://127.0.0.1:8000/api/document/1
    method:GET


## Schedule Task Run:
    php artisan create:document-diffs
    

       