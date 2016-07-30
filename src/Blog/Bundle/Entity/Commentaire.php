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
  * @var text
  *
  * @ORM\Column(name="commentaire", type="text")
  */
  private $commentaire;


  /**
  * @var \DateTime
  *
  * @ORM\Column(name="date", type="datetime")
  */
  private $date;


  /**
  * @ORM\ManyToOne(targetEntity="User", inversedBy="commentaire")
  * @ORM\JoinColumn(name="users_id", referencedColumnName="id")
  */
  private $user;

  /**
  * @ORM\ManyToOne(targetEntity="Article", inversedBy="commentaire")
  * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
  */
  private $article;


  /**
   * @var
   * @ORM\ManyToMany(targetEntity="User", mappedBy="commentairelike")
   */
  public $like;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->like = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set user
     *
     * @param \Blog\Bundle\Entity\User $user
     *
     * @return Commentaire
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

    /**
     * Add like
     *
     * @param \Blog\Bundle\Entity\User $like
     *
     * @return Commentaire
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
