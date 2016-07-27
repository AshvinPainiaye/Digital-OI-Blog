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
    * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="user")
    * @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id")
    */
    private $commentaire;


    /**
     * @ORM\ManyToMany(targetEntity="Commentaire", inversedBy="like")
     * @ORM\JoinTable(name="commentaire_like")
     */
    public $commentairelike;


    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="like")
     * @ORM\JoinTable(name="article_like")
     */
    public $articlelike;

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
     * Add commentaire
     *
     * @param \Blog\Bundle\Entity\Commentaire $commentaire
     *
     * @return User
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
     * Add commentairelike
     *
     * @param \Blog\Bundle\Entity\Commentaire $commentairelike
     *
     * @return User
     */
    public function addCommentairelike(\Blog\Bundle\Entity\Commentaire $commentairelike)
    {
        $this->commentairelike[] = $commentairelike;

        return $this;
    }

    /**
     * Remove commentairelike
     *
     * @param \Blog\Bundle\Entity\Commentaire $commentairelike
     */
    public function removeCommentairelike(\Blog\Bundle\Entity\Commentaire $commentairelike)
    {
        $this->commentairelike->removeElement($commentairelike);
    }

    /**
     * Get commentairelike
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentairelike()
    {
        return $this->commentairelike;
    }

    /**
     * Add articlelike
     *
     * @param \Blog\Bundle\Entity\Article $articlelike
     *
     * @return User
     */
    public function addArticlelike(\Blog\Bundle\Entity\Article $articlelike)
    {
        $this->articlelike[] = $articlelike;

        return $this;
    }

    /**
     * Remove articlelike
     *
     * @param \Blog\Bundle\Entity\Article $articlelike
     */
    public function removeArticlelike(\Blog\Bundle\Entity\Article $articlelike)
    {
        $this->articlelike->removeElement($articlelike);
    }

    /**
     * Get articlelike
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticlelike()
    {
        return $this->articlelike;
    }
}
