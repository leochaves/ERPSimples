<?php

namespace ERP\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @var \Console
     *
     * @ORM\ManyToOne(targetEntity="Console")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="console_id", referencedColumnName="id")
     * })
     */
    private $console;

    /**
     * @var \Region
     *
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     * })
     */
    private $region;

    /**
     * @var \Images
     *
     * @ORM\OneToMany(targetEntity="Image",mappedBy="game",cascade={"ALL"}, orphanRemoval=true)
     */
    private $images;
    
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }  
    
    /**
     * 
     * @return String 
     */
    public function __toString() {
        return $this->name;
    }
    
    /**
     * Add image
     *
     * @param Image $image
    
    public function addImage(Image $image)
    {
        $this->images[] = $image;
    }
     */
     /**
     * Get images
     *
     * @return ArrayCollection 
     */
    public function getImages()
    {
        return $this->images;
    }
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
     * @return Game
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
     * Set description
     *
     * @param string $description
     * @return Game
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
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     * @return Game
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    
        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime 
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set console
     *
     * @param \ERP\GameBundle\Entity\Console $console
     * @return Game
     */
    public function setConsole(\ERP\GameBundle\Entity\Console $console = null)
    {
        $this->console = $console;
    
        return $this;
    }

    /**
     * Get console
     *
     * @return \ERP\GameBundle\Entity\Console 
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * Set region
     *
     * @param \ERP\GameBundle\Entity\Region $region
     * @return Game
     */
    public function setRegion(\ERP\GameBundle\Entity\Region $region = null)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return \ERP\GameBundle\Entity\Region 
     */
    public function getRegion()
    {
        return $this->region;
    }
    
//    public function setImages(ArrayCollection $images){
//        $this->images = $images;
//    }
    
    
    /**
 * Add images
 *
 * @param Image $images
 * @return Game
 */
public function addImage(Image $image)
{
  $this->images[] = $image;

  $image->setGame($this);
  $image->upload();

  return $this;
}

/**
 * Remove images
 *
 * @param Image $images
 */
public function removeImage(Image $images)
{
    $this->images->removeElement($images);
}

public function setImages(ArrayCollection $images)
{
    foreach ($images as $image) {
        $image->setProperty($this);
    }

    $this->images = $images;
}
}