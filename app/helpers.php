<?php


function gravatar_url($email)
{
    $email = md5(strtolower($email));

    return "https://gravatar.com/avatar/{$email}";
}
