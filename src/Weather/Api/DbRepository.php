<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\Weather;
use Weather\Model\WeatherJason;

class DbRepository implements DataProvider
{
    /**
     * @param \DateTime $date
     * @return Weather
     * @throws \Exception
     */
    public function selectByDate(\DateTime $date): Weather
    {

        $items = $this->selectAll();

        $result = new NullWeather();

        foreach ($items as $item) {

            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;

            }
        }

        return $result;
    }

    /**
     * @param \DateTime $date
     * @return WeatherJason
     * @throws \Exception
     */
    public function selectByDateWeatherJason(\DateTime $date): WeatherJason
    {

        $items = $this->selectWeatherAll();

        $result = new NullWeather();

        foreach ($items as $item) {

            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;

            }
        }

        return $result;
    }

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function selectByRange(\DateTime $from, \DateTime $to): array
    {


        $items = $this->selectAll();

        $result = [];

        foreach ($items as $item) {
            if ($item->getDate() >= $from && $item->getDate() <= $to) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     * @throws \Exception
     */
    public function selectByRangeWeatherJason(\DateTime $from, \DateTime $to): array
    {

        $items = $this->selectWeatherAll();

        $result = [];

        foreach ($items as $item) {
            if ($item->getDate() >= $from && $item->getDate() <= $to) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @return array
     * @throws \Exception
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
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function selectWeatherAll(): array
    {
        $result = [];
        $data = json_decode(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Weather.json'),
            true
        );


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
