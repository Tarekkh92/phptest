
Explanation about files.
Website: https://fullstackwebdev123.000webhostapp.com/

classes.php
This file contains 3 classes.
Database class with connect function.
Post class with create, searchById, searchByUserId, searchByContent methods.
User class with create method.

curl_posts.php
This file contains a curl method to get posts from the link given in the document and then save them to the database.

curl_users.php
This file contains a curl method to get users from the link given in the document and then save them to the database.

index.html
This file contains a form which has the user name, user email, post title and post body fields. It will post to another file createUserAndPost.php.

createUserAndPost.php
This file contains methods to save user and post data into the database.

getPosts.php
This file contains two GET methods to get posts from the database. One method is searchById and the other method is searchByUserId and these methods return data in JSON format in the database.
averagePosts.php
This file contains a query to get monthly and weekly average for posts that users created.

full_stack.sql
This is a database file. Contains database with posts and users tables.


