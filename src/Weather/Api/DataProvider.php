<?php

namespace Weather\Api;

use Weather\Model\Weather;
use Weather\Model\WeatherJason;

interface DataProvider
{
    /**
     * @param \DateTime $date
     */
    public function selectByDate(\DateTime $date):Weather;

    /**
     * @param \DateTime $date
     */
    public function selectByDateWeatherJason(\DateTime $date):WeatherJason;

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function selectByRange(\DateTime $from, \DateTime $to): array;

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function selectByRangeWeatherJason(\DateTime $from, \DateTime $to): array;

}
