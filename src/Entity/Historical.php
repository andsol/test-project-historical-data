<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 10:43
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Historical
{
    /**
     * @Assert\NotBlank()
     */
    private $symbol;
    /**
     * @var \DateTime
     * @Assert\NotBlank()
     */
    private $startDate;
    /**
     * @var \DateTime
     * @Assert\NotBlank()
     */
    private $endDate;

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
     */
    public function setSymbol($symbol): void
    {
        $this->symbol = $symbol;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }
}