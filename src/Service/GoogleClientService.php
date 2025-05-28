<?php


namespace App\Service;


use Google_Client;



class GoogleClientService
{
    public function getClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
        $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        return $client;
    }
}
