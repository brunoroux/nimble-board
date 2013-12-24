<?php

namespace Agile\NimbleBoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Story
 *
 * @ORM\Table(name="stories")
 * @ORM\Entity
 */
class Story
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
     * @ORM\Column(name="textAsA", type="string", length=255)
     */
    private $textAsA;

    /**
     * @var string
     *
     * @ORM\Column(name="textIWant", type="string", length=255)
     */
    private $textIWant;

    /**
     * @var string
     *
     * @ORM\Column(name="textFor", type="string", length=255)
     */
    private $textFor;

    /**
     * @var string
     *
     * @ORM\Column(name="acceptance", type="string", length=255)
     */
    private $acceptance;

    /**
     * @var integer
     *
     * @ORM\Column(name="complexity", type="integer", nullable=true)
     */
    private $complexity;

    /**
     * @var integer
     *
     * @ORM\Column(name="importance", type="integer", nullable=true)
     */
    private $importance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime", nullable=true)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="posX", type="integer", nullable=true)
     */
    private $posX;

    /**
     * @var integer
     *
     * @ORM\Column(name="posY", type="integer", nullable=true)
     */
    private $posY;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var Project $project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="stories")
     */
    private $project;

    /**
     * @var Sprint $sprint
     *
     * @ORM\ManyToOne(targetEntity="Sprint", inversedBy="stories")
     */
    private $sprint;

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
     * Set textAsA
     *
     * @param string $textAsA
     * @return Story
     */
    public function setTextAsA($textAsA)
    {
        $this->textAsA = $textAsA;

        return $this;
    }

    /**
     * Get textAsA
     *
     * @return string 
     */
    public function getTextAsA()
    {
        return $this->textAsA;
    }

    /**
     * Set textIWant
     *
     * @param string $textIWant
     * @return Story
     */
    public function setTextIWant($textIWant)
    {
        $this->textIWant = $textIWant;

        return $this;
    }

    /**
     * Get textIWant
     *
     * @return string 
     */
    public function getTextIWant()
    {
        return $this->textIWant;
    }

    /**
     * Set textFor
     *
     * @param string $textFor
     * @return Story
     */
    public function setTextFor($textFor)
    {
        $this->textFor = $textFor;

        return $this;
    }

    /**
     * Get textFor
     *
     * @return string 
     */
    public function getTextFor()
    {
        return $this->textFor;
    }

    /**
     * Set acceptance
     *
     * @param string $acceptance
     * @return Story
     */
    public function setAcceptance($acceptance)
    {
        $this->acceptance = $acceptance;

        return $this;
    }

    /**
     * Get acceptance
     *
     * @return string 
     */
    public function getAcceptance()
    {
        return $this->acceptance;
    }

    /**
     * Set complexity
     *
     * @param integer $complexity
     * @return Story
     */
    public function setComplexity($complexity)
    {
        $this->complexity = $complexity;

        return $this;
    }

    /**
     * Get complexity
     *
     * @return integer 
     */
    public function getComplexity()
    {
        return $this->complexity;
    }

    /**
     * Set importance
     *
     * @param integer $importance
     * @return Story
     */
    public function setImportance($importance)
    {
        $this->importance = $importance;

        return $this;
    }

    /**
     * Get importance
     *
     * @return integer 
     */
    public function getImportance()
    {
        return $this->importance;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Story
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Story
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Story
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Story
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
     * Set posX
     *
     * @param integer $posX
     * @return Story
     */
    public function setPosX($posX)
    {
        $this->posX = $posX;

        return $this;
    }

    /**
     * Get posX
     *
     * @return integer 
     */
    public function getPosX()
    {
        return $this->posX;
    }

    /**
     * Set posY
     *
     * @param integer $posY
     * @return Story
     */
    public function setPosY($posY)
    {
        $this->posY = $posY;

        return $this;
    }

    /**
     * Get posY
     *
     * @return integer 
     */
    public function getPosY()
    {
        return $this->posY;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Story
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
