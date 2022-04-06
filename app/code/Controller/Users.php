<?php

namespace Controller;

use Core\ControllerAbstract;
use Model\User;

class Users extends ControllerAbstract
{
    public function register()
    {
        echo $this->twig->render('users/register.html');
    }

    public function login()
    {

        echo $this->twig->render('users/login.html');
    }

    public function check()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $user = new \Model\User();
        $user = $user->checkLoginCredentials($email, $password);
        if ($user !== null) {
            $_SESSION['user_id'] = $user;
            echo $this->twig->render('news/all.html');
        } else {
            echo "Blogi duomenys". $this->twig->render('users/login.html');
        }
    }

    public function create()
    {
        $user = new User();
        $user->setName($_POST['name']);
        $user->setLastName($_POST['last_name']);
        $user->setEmail($_POST['email']);
        $user->setPassword(md5($_POST['password']));
        $user->setRoleId(1);
        $user->setNickname($_POST['nickname']);
        $user->setActive(1);
        $user->setCreatedAt(DATE('Y/m/d'));
        $user->create();
        echo $this->twig->render('users/login.html');
    }

    public function edit()
    {
//        $user = new User();
//        $user->setName($_POST['name']);
//        $user->setLastName($_POST['last_name']);
//        $user->setEmail($_POST['email']);
//        $user->setPassword($_POST['password']);
//        $user->setRoleId(1);
//        $user->setNickname($_POST['nickname']);
//        $user->setActive(1);
//        $user->setCreatedAt(DATE('Y/m/d'));
//        $user->create();
        echo $this->twig->render('users/edit.html');

    }

    public function update()
    {

    }
}