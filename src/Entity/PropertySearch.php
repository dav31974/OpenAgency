<?php
namespace App\Entity;

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

}