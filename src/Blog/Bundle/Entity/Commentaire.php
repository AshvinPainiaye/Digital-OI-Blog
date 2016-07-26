<?php

namespace Blog\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Commentaire
*
* @ORM\Table(name="commentaire")
* @ORM\Entity(repositoryClass="Blog\Bundle\Repository\CommentaireRepository")
*/
class Commentaire
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
  * @ORM\Column(name="commentaire", type="string", length=255)
  */
  private $commentaire;


  /**
  * @var \DateTime
  *
  * @ORM\Column(name="date", type="datetime")
  */
  private $date;


  /**
  * @ORM\ManyToOne(targetEntity="User", inversedBy="Commentaire")
  */
  private $auteur;

  /**
  * @ORM\ManyToOne(targetEntity="Article", inversedBy="Commentaire")
  */
  private $article;


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
  * Set commentaire
  *
  * @param string $commentaire
  *
  * @return Commentaire
  */
  public function setCommentaire($commentaire)
  {
    $this->commentaire = $commentaire;

    return $this;
  }

  /**
  * Get commentaire
  *
  * @return string
  */
  public function getCommentaire()
  {
    return $this->commentaire;
  }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commentaire
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
     * Set auteur
     *
     * @param \Blog\Bundle\Entity\User $auteur
     *
     * @return Commentaire
     */
    public function setAuteur(\Blog\Bundle\Entity\User $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \Blog\Bundle\Entity\User
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set article
     *
     * @param \Blog\Bundle\Entity\Article $article
     *
     * @return Commentaire
     */
    public function setArticle(\Blog\Bundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Blog\Bundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
