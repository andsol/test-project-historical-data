<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:09
 */

namespace App\Entity;


class Symbol implements HydrationInterface
{
    private $Symbol;
    private $Name;
    private $LastSale;
    private $MarketCap;
    private $IPOyear;
    private $Sector;
    private $industry;
    private $SummaryQuote;

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->Symbol;
    }

    /**
     * @param mixed $Symbol
     */
    public function setSymbol($Symbol): void
    {
        $this->Symbol = $Symbol;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getLastSale()
    {
        return $this->LastSale;
    }

    /**
     * @param mixed $LastSale
     */
    public function setLastSale($LastSale): void
    {
        $this->LastSale = $LastSale;
    }

    /**
     * @return mixed
     */
    public function getMarketCap()
    {
        return $this->MarketCap;
    }

    /**
     * @param mixed $MarketCap
     */
    public function setMarketCap($MarketCap): void
    {
        $this->MarketCap = $MarketCap;
    }

    /**
     * @return mixed
     */
    public function getIPOyear()
    {
        return $this->IPOyear;
    }

    /**
     * @param mixed $IPOyear
     */
    public function setIPOyear($IPOyear): void
    {
        $this->IPOyear = $IPOyear;
    }

    /**
     * @return mixed
     */
    public function getSector()
    {
        return $this->Sector;
    }

    /**
     * @param mixed $Sector
     */
    public function setSector($Sector): void
    {
        $this->Sector = $Sector;
    }

    /**
     * @return mixed
     */
    public function getIndustry()
    {
        return $this->industry;
    }

    /**
     * @param mixed $industry
     */
    public function setIndustry($industry): void
    {
        $this->industry = $industry;
    }

    /**
     * @return mixed
     */
    public function getSummaryQuote()
    {
        return $this->SummaryQuote;
    }

    /**
     * @param mixed $Summary
     */
    public function setSummaryQuote($Summary): void
    {
        $this->SummaryQuote = $Summary;
    }

    public static function fromArray(array $rawData)
    {
        $object = new self();

        $object->setName($rawData['Name']);
        $object->setSymbol($rawData['Symbol']);
        $object->setLastSale($rawData['LastSale']);
        $object->setMarketCap($rawData['MarketCap']);
        $object->setIPOyear($rawData['IPOyear']);
        $object->setSector($rawData['Sector']);
        $object->setIndustry($rawData['industry']);
        $object->setSummaryQuote($rawData['Summary Quote']);

        return $object;
    }

    public function toArray()
    {

    }
}