<?php

namespace App\Commands;

class Users
{
    public function show(\Emeset\Contracts\Cli\Parser $args, \Emeset\Contracts\Cli\Output $output, \Emeset\Contracts\Container $container): void
    {
        $userModel = $container->get("Users");
        $users = $userModel->getUsers();
        $output->table($users);
    }

    public function add(\Emeset\Contracts\Cli\Parser $args, \Emeset\Contracts\Cli\Output $output, \Emeset\Contracts\Container $container): void
    {
        $userModel = $container->get("Users");
        /*$user = $output->input("User: ");
        $name = $output->input("Name: ");
        $password = $output->password("Password: ");*/
        dd($args->getOpt("name"));
    }
}