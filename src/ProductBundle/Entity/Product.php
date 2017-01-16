<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 22.12.16
 * Time: 17:36
 */
namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @Vich\Uploadable
 * @UniqueEntity(
 *     "name",
 *     message="This product already exists"
 * )
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var string
     */
    private $uploadPath = 'products';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="45")
     * @ORM\Column(type="string", length=45)
     */
    protected $name;

    /**
     * @var double
     * 
     * @Assert\NotBlank()
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @Assert\Length(max="2000")
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var File
     *
     * @Assert\Image(
     *     mimeTypes="image/jpeg",
     *     maxSize="300000",
     * )
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     */
    protected $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $imageName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="CategoryBundle\Entity\Category", inversedBy="product", cascade={"persist"})
     * @ORM\JoinTable(name="product_category")
     */
    protected $category;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \CategoryBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\CategoryBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \CategoryBundle\Entity\Category $category
     */
    public function removeCategory(\CategoryBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Get path to uploaded images
     * 
     * @return string
     */
    public function getWebPath()
    {
        $webPath = 'uploads/images/' . $this->uploadPath . '/' . $this->imageName;

        return $webPath;
    }
}
