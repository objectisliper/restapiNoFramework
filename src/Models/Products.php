<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Products
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255, nullable=false)
     */
    private $sku;

    /**
     * @var string|null
     *
     * @ORM\Column(name="asin", type="string", length=255, nullable=true)
     */
    private $asin;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sku.
     *
     * @param string $sku
     *
     * @return Products
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku.
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set asin.
     *
     * @param string|null $asin
     *
     * @return Products
     */
    public function setAsin($asin = null)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get asin.
     *
     * @return string|null
     */
    public function getAsin()
    {
        return $this->asin;
    }
}
