<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch {

    /**
     * Undocumented variable
     *
     * @var int|null
     */
    private $maxPrice;

    /**
     * Undocumented variable
     *
     * @Assert\Range(min=10, max=400)
     * @var int|null
     */
    private $minSurface;

    /**
     * Undocumented variable
     *
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * Undocumented function
     *
     * @return int|null
     */
    public function getMaxPrice() {
        return $this->maxPrice;
    }

    /**
     * Undocumented function
     *
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice) {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return int|null
     */
    public function getMinSurface() {
        return $this->minSurface;
    }

    /**
     * Undocumented function
     *
     * @param int|null $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface) {
        $this->minSurface = $minSurface;
        return $this;
    }

    public function getOptions() {
        return $this->options;
    }

    public function setOptions(ArrayCollection $options): void {
        $this->options = $options;
    }

}