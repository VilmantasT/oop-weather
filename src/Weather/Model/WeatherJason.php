<?php


namespace Weather\Model;


class WeatherJason
{
    private $map = [
        'Cloudy' => 'cloud-sun',
        'Scattered Showers' => 'cloud-showers-heavy',
        'Breezy' => 'wind',
        'Partly Cloudy' => 'cloud-sun',
        'Mostly Cloudy' => 'cloud',
        'Sunny' => 'sun'
    ];

    /**
     * @var string
     */
    protected $dayTemp;

    /**
     * @var string
     */
    protected $nightTemp;

    /**
     * @var string
     */
    protected $sky;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @return string
     */
    public function getDayTemp(): string
    {
        return $this->dayTemp;
    }

    /**
     * @param string $dayTemp
     */
    public function setDayTemp(string $dayTemp): void
    {
        $this->dayTemp = $dayTemp;
    }

    /**
     * @return string
     */
    public function getNightTemp(): string
    {
        return $this->nightTemp;
    }

    /**
     * @param string $nightTemp
     */
    public function setNightTemp(string $nightTemp): void
    {
        $this->nightTemp = $nightTemp;
    }

    /**
     * @return string
     */
    public function getSky(): string
    {
        return $this->sky;
    }

    /**
     * @param string $sky
     */
    public function setSky(string $sky): void
    {
        $this->sky = $sky;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getSkySymbol()
    {
        return $this->map[$this->sky];
    }
}