<?php

namespace App\Controller;


use Google_Service_Calendar;
use App\Service\GoogleClientService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GoogleCalendarController extends AbstractController
{
    #[Route('/google/connect', name: 'google_connect')]
    public function connect(GoogleClientService $googleClientService): Response
    {
        $client = $googleClientService->getClient();
        $authUrl = $client->createAuthUrl();
        return $this->redirect($authUrl);
    }

    #[Route('/google/callback', name: 'google_callback')]
    public function callback(Request $request, GoogleClientService $googleClientService): Response
    {
        $client = $googleClientService->getClient();
        $code = $request->query->get('code');

        if (!$code) {
            return new Response("Erreur d'authentification", 400);
        }

        $accessToken = $client->fetchAccessTokenWithAuthCode($code);
        $client->setAccessToken($accessToken);

        $calendarService = new Google_Service_Calendar($client);
        $events = $calendarService->events->listEvents('primary');

        $eventList = [];
        foreach ($events->getItems() as $event) {
            $eventList[] = [
                'summary' => $event->getSummary(),
                'start' => $event->getStart()->getDateTime() ?? $event->getStart()->getDate(),
                'end' => $event->getEnd()->getDateTime() ?? $event->getEnd()->getDate(),
            ];
        }

        return $this->render('calendar.html.twig', [
            'events' => $eventList,
        ]);
    }
}
