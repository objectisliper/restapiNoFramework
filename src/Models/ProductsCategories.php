<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsCategories
 *
 * @ORM\Table(name="products_categories", indexes={@ORM\Index(name="fk_pc_2_idx", columns={"category_id"}), @ORM\Index(name="fk_pc_1_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductsCategories
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
     * @var Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var Products
     *
     * @ORM\ManyToOne(targetEntity="Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;


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
     * Set category.
     *
     * @param Categories|null $category
     *
     * @return ProductsCategories
     */
    public function setCategory(Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return Categories|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set product.
     *
     * @param Products|null $product
     *
     * @return ProductsCategories
     */
    public function setProduct(Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return Products|null
     */
    public function getProduct()
    {
        return $this->product;
    }
}
