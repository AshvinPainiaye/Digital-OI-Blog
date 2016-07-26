<?php

namespace Blog\Bundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * NOTE: This is not a mapped field of entity metadata, just a simple property.
    *
    * @Vich\UploadableField(mapping="users_image", fileNameProperty="imageName")
    *
    * @var File
    */
    private $imageFile;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    *
    * @var string
    */
    private $imageName;

    /**
    * @ORM\Column(type="string", length=255)
    *
    * @var string
    */
    private $prenom;

    /**
    * @ORM\Column(type="string", length=255)
    *
    * @var string
    */
    private $nom;

    /**
    * @ORM\OneToMany(targetEntity="Article", mappedBy="user")
    * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
    */
    private $article;


    /**
    * @ORM\ManyToOne(targetEntity="Commentaire", inversedBy="User")
    */
    private $auteur;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return User
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

    /**
     * Add article
     *
     * @param \Blog\Bundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\Blog\Bundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Blog\Bundle\Entity\Article $article
     */
    public function removeArticle(\Blog\Bundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set auteur
     *
     * @param \Blog\Bundle\Entity\Commentaire $auteur
     *
     * @return User
     */
    public function setAuteur(\Blog\Bundle\Entity\Commentaire $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \Blog\Bundle\Entity\Commentaire
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
}
