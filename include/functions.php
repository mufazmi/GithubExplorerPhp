<?php
    function getUser($username)
    {
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
            $response = file_get_contents('http://api.github.com/users/'.$username,true,$context);
            $response = json_decode($response,true);
                     return $response;
    }


    function searchUser($username)
    {
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $response = file_get_contents('http://api.github.com/search/users?q='.$username,true,$context);
        $response = json_decode($response,true);
        return $response;
    }

    function getFollowers($username)
    {
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $response = file_get_contents('http://api.github.com/users/'.$username.'/followers',true,$context);
        $response = json_decode($response,true);
        return $response;
    }

    function getFollowing($username)
    {
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $response = file_get_contents('http://api.github.com/users/'.$username.'/following',true,$context);
        $response = json_decode($response,true);
        return $response;
    }

    function getRepository($username)
    {
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $response = file_get_contents('http://api.github.com/users/'.$username.'/repos',true,$context);
        $response = json_decode($response,true);
        return $response;
    }
    
?>