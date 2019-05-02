<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbRepository;
use Weather\Model\Weather;
use Weather\Model\WeatherJason;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;

    public function getTodayInfo():Weather
    {
        return $this->getTransporter()->selectByDate(new \DateTime());
    }

    public function getTodayInfoWeatherJason():WeatherJason
    {
        return $this->getTransporter()->selectByDateWeatherJason(new \DateTime());
    }

    public function getWeekInfo(): array
    {
        return $this->getTransporter()->selectByRange(new \DateTime('midnight'), new \DateTime('+6 days midnight'));
    }

    private function getTransporter()
    {
        if (null === $this->transporter) {
            $this->transporter = new DbRepository();
        }

        return $this->transporter;
    }
}


