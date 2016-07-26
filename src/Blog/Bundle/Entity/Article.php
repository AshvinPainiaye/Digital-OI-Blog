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
  * @var \DateTime
  *
  * @ORM\Column(name="date", type="datetime")
  */
  private $date;

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
  * @var int
  * @ORM\Column(name="Disponibilite", type="integer")
  */
  private $disponibilite;


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
  * @ORM\Column(type="datetime")
  *
  * @var \DateTime
  */
  private $updatedAt;



    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="article")
    * @ORM\JoinColumn(name="users_id", referencedColumnName="id")
    */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="Commentaire", inversedBy="Article")
     */
    private $commentaire;

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
      $this->updatedAt = new \DateTime('now');
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



  /**
  * Set date
  *
  * @param \DateTime $date
  *
  * @return Article
  */
  public function setDate($date)
  {
    $this->date = $date;

    return $this;
  }

  /**
  * Get date
  *
  * @return \DateTime
  */
  public function getDate()
  {
    return $this->date;
  }

  /**
  * Set disponibilite
  *
  * @param integer $disponibilite
  *
  * @return Article
  */
  public function setDisponibilite($disponibilite)
  {
    $this->disponibilite = $disponibilite;

    return $this;
  }

  /**
  * Get disponibilite
  *
  * @return integer
  */
  public function getDisponibilite()
  {
    return $this->disponibilite;
  }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set user
     *
     * @param \Blog\Bundle\Entity\User $user
     *
     * @return Article
     */
    public function setUser(\Blog\Bundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Blog\Bundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set commentaire
     *
     * @param \Blog\Bundle\Entity\Commentaire $commentaire
     *
     * @return Article
     */
    public function setCommentaire(\Blog\Bundle\Entity\Commentaire $commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return \Blog\Bundle\Entity\Commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}
