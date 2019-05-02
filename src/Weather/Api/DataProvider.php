<?php

namespace Weather\Api;

use Weather\Model\Weather;

interface DataProvider
{
    /**
     * @param \DateTime $date
     */
    public function selectByDate(\DateTime $date);

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function selectByRange(\DateTime $from, \DateTime $to): array;
}
