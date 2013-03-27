<?php

namespace JGI\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="JGI\Bundle\AppBundle\Entity\PostRepository")
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="facebook_likes", type="integer")
     */
    private $facebookLikes;

    /**
     * @var integer
     *
     * @ORM\Column(name="twitter_shares", type="integer")
     */
    private $twitterShares;

    /**
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="posts")
     */
    private $media;

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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Post
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Post
     */
    public function setDate(\DateTime $date)
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt(\DateTime $updatedAt)
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
     * Set facebookLikes
     *
     * @param integer $facebookLikes
     * @return Post
     */
    public function setFacebookLikes($facebookLikes)
    {
        $this->facebookLikes = $facebookLikes;
        $this->setUpdatedAt(new \DateTime());
    
        return $this;
    }

    /**
     * Get facebookLikes
     *
     * @return integer 
     */
    public function getFacebookLikes()
    {
        return $this->facebookLikes;
    }

    /**
     * Set twitterShares
     *
     * @param integer $twitterShares
     * @return Post
     */
    public function setTwitterShares($twitterShares)
    {
        $this->twitterShares = $twitterShares;
        $this->setUpdatedAt(new \DateTime());
    
        return $this;
    }

    /**
     * Get twitterShares
     *
     * @return integer 
     */
    public function getTwitterShares()
    {
        return $this->twitterShares;
    }

    public function setMedia(Media $media)
    {
        $this->media = $media;

        return $this;
    }

    public function getMedia()
    {
        return $this->media;
    }
}
