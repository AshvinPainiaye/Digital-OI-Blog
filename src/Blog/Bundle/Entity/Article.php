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
  * @var string
  * @ORM\Column(name="Disponibilite", type="string", length=255)
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
    * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="article", cascade={"persist", "remove"}))
    * @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id"))
    */
    private $commentaire;


    /**
     * @var
     * @ORM\ManyToMany(targetEntity="User", mappedBy="articlelike")
     */
    public $like;

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
     * Constructor
     */
    public function __construct()
    {
        $this->commentaire = new \Doctrine\Common\Collections\ArrayCollection();
        $this->like = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $disponibilite
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
     * @return string
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
     * Add commentaire
     *
     * @param \Blog\Bundle\Entity\Commentaire $commentaire
     *
     * @return Article
     */
    public function addCommentaire(\Blog\Bundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Blog\Bundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\Blog\Bundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Get commentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Add like
     *
     * @param \Blog\Bundle\Entity\User $like
     *
     * @return Article
     */
    public function addLike(\Blog\Bundle\Entity\User $like)
    {
        $this->like[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \Blog\Bundle\Entity\User $like
     */
    public function removeLike(\Blog\Bundle\Entity\User $like)
    {
        $this->like->removeElement($like);
    }

    /**
     * Get like
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLike()
    {
        return $this->like;
    }
}
