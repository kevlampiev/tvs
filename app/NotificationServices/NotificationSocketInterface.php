<?php


namespace App\NotificationServices;


interface NotificationSocketInterface
{
    public function getChannelList():array;
    public function handle();
}
