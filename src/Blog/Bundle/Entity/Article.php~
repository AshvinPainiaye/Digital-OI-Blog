<?php

namespace Blog\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
* Article
*
* @ORM\Table(name="article")
* @ORM\Entity(repositoryClass="Blog\Bundle\Repository\ArticleRepository")
* @Vich\Uploadable
*/
class Article
{
  /**
  * @var int
  *
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;

  /**
  * @var string
  *
  * @ORM\Column(name="Titre", type="string", length=255)
  */
  private $titre;

  /**
  * @var text
  *
  * @ORM\Column(name="Description", type="text")
  */
  private $description;


  /**
  * NOTE: This is not a mapped field of entity metadata, just a simple property.
  *
  * @Vich\UploadableField(mapping="articles_image", fileNameProperty="imageName")
  *
  * @var File
  */
  private $imageFile;

  /**
  * @ORM\Column(type="string", length=255)
  *
  * @var string
  */
  private $imageName;



  /**
  * Get id
  *
  * @return int
  */
  public function getId()
  {
    return $this->id;
  }

  /**
  * Set titre
  *
  * @param string $titre
  *
  * @return Article
  */
  public function setTitre($titre)
  {
    $this->titre = $titre;

    return $this;
  }

  /**
  * Get titre
  *
  * @return string
  */
  public function getTitre()
  {
    return $this->titre;
  }

  /**
  * Set description
  *
  * @param string $description
  *
  * @return Article
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
  * Set imageName
  *
  * @param string $imageName
  *
  * @return Article
  */
  public function setImageName($imageName)
  {
    $this->imageName = $imageName;

    return $this;
  }

  /**
  * Get imageName
  *
  * @return string
  */
  public function getImageName()
  {
    return $this->imageName;
  }

  /**
  * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
  * of 'UploadedFile' is injected into this setter to trigger the  update. If this
  * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
  * must be able to accept an instance of 'File' as the bundle will inject one here
  * during Doctrine hydration.
  *
  * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
  *
  * @return Product
  */
  public function setImageFile(File $image = null)
  {
    $this->imageFile = $image;
    if ($image) {
      // It is required that at least one field changes if you are using doctrine
      // otherwise the event listeners won't be called and the file is lost
      $this->date = new \DateTime('now');
    }
    return $this;
  }
  /**
  * @return File
  */
  public function getImageFile()
  {
    return $this->imageFile;
  }


}
