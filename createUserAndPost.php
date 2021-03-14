<?php
include 'classes.php';
if(isset($_POST['submit'])){
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $post_title = $_POST['post_title'];
    $post_body = $_POST['post_body'];
    $user = new User();
    $userId = $user->create($user_name, $user_email);
    
    $post = new Post();
    $post->create($userId, $post_title, $post_body);
    echo 'Successfully added user and post.';
}