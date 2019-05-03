<?php

namespace Weather\Controller;

use Weather\Api\GoogleApi;
use Weather\Manager;
use Weather\Model\NullWeather;

class StartPage
{
    public function getTodayWeather($api): array
    {
        try {
            $service = new Manager();

            switch ($api)
            {
                case 'weather':
                    $weather = $service->getTodayInfoWeatherJason();
                    break;
                case 'google':

                    $service = new GoogleApi();
                    $weather = $service->getToday();
                    break;
                default:
                    $weather = $service->getTodayInfo();
            }

        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return ['template' => 'today-weather.twig', 'context' => ['weather' => $weather]];
    }

    public function getWeekWeather($api): array
    {
        try {
            $service = new Manager();


            switch ($api)
            {
                case 'weather':
                    $weathers = $service->getWeekInfoWeatherJason();
                    break;
                case 'google':
                
                    $day = new \DateTime();

                    for ($i = 0; $i < 6; $i++)
                    {
                        $service = new GoogleApi();
                        $weather = $service->getToday();
                        $weather->setDate($day);
                        $day = new \DateTime($day->format('Y-m-d') . ' +1 day');

                        $weathers[] = $weather;

                    }
                    break;
                default:
                    $weathers = $service->getWeekInfo();
            }

        } catch (\Exception $exp) {
            $weathers = [];
        }

        return ['template' => 'range-weather.twig', 'context' => ['weathers' => $weathers]];
    }
}
