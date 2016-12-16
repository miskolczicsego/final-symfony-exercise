<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 16.
 * Time: 3:06
 */

namespace JobZ\HomeBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="JobZ\HomeBundle\Repository\MenuRepository")
 */
class Menu
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255)
     */
    private $position;
    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="JobZ\HomeBundle\Entity\Information")
     * @ORM\JoinColumn(name="information_id", referencedColumnName="id")
     */
    private $information;
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
     * Set title
     *
     * @param string $title
     *
     * @return Menu
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
     * Set position
     *
     * @param string $position
     *
     * @return Menu
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }
    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
    /**
     * Set information
     *
     * @param \JobZ\HomeBundle\Entity\Information $information
     *
     * @return Menu
     */
    public function setInformation(\JobZ\HomeBundle\Entity\Information $information = null)
    {
        $this->information = $information;
        return $this;
    }
    /**
     * Get information
     *
     * @return \JobZ\HomeBundle\Entity\Information
     */
    public function getInformation()
    {
        return $this->information;
    }
}