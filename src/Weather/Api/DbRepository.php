<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\Weather;
use Weather\Model\WeatherJason;

class DbRepository implements DataProvider
{
    /**
     * @param \DateTime $date, string $api
     */
    public function selectByDate(\DateTime $date)
    {

        $items = $this->selectAll();

        $result = new NullWeather();

        foreach ($items as $item) {
            var_dump($item->getDate());
            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;

            }
        }

        return $result;
    }    /**
     * @param \DateTime $date, string $api
     */
    public function selectByDateWeatherJason(\DateTime $date)
    {

        $items = $this->selectAll();

        $result = new NullWeather();

        foreach ($items as $item) {
            var_dump($item->getDate());
            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;

            }
        }

        return $result;
    }

    public function selectByRange(\DateTime $from, \DateTime $to, $api): array
    {
        switch ($api)
        {
            case 'weather':
                $items = $this->selectWeatherAll();
                break;
            default:
                $items = $this->selectAll();
        }
        $result = [];

        foreach ($items as $item) {
            if ($item->getDate() >= $from && $item->getDate() <= $to) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @return Weather[]
     */
    private function selectAll(): array
    {
        $result = [];
        $data = json_decode(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Data.json'),
            true
        );
        foreach ($data as $item) {
            $record = new Weather();
            $record->setDate(new \DateTime($item['date']));
            $record->setDayTemp($item['dayTemp']);
            $record->setNightTemp($item['nightTemp']);
            $record->setSky($item['sky']);
            $result[] = $record;
        }

        return $result;
    }   /**
     * @return WeatherJason[]
     */
    private function selectWeatherAll(): array
    {
        $result = [];
        $data = json_decode(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Weather.json'),
            true
        );

        var_dump($data);

        foreach ($data as $item) {
            $record = new WeatherJason();
            $record->setDate(new \DateTime($item['date']));
            $record->setDayTemp($item['high']);
            $record->setNightTemp($item['low']);
            $record->setSky($item['text']);
            $result[] = $record;
        }

        return $result;
    }
}
