<?php

namespace App\Entity;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassroomRepository")
 */
class Classroom
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\School", inversedBy="classrooms")
     */
    private $school;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="classroom")
     */
    private $students;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actuality", mappedBy="classroom")
     */
    private $actualities;

    public function __toString()
    {
        return $this->name;      
    }
    
    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
        $this->actualities = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function setSchool(?School $school): self
    {
        $this->school = $school;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudents(Student $students): self
    {
        if (!$this->students->contains($students)) {
            $this->students[] = $students;
            $students->setClassroom($this);
        }

        return $this;
    }

    public function removeStudentss(Student $students): self
    {
        if ($this->students->contains($students)) {
            $this->students->removeElement($students);
            // set the owning side to null (unless already changed)
            if ($students->getClassroom() === $this) {
                $students->setClassroom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Actuality[]
     */
    public function getActualities(): Collection
    {
        return $this->actualities;
    }

    public function addActuality(Actuality $actuality): self
    {
        if (!$this->actualities->contains($actuality)) {
            $this->actualities[] = $actuality;
            $actuality->addClassroom($this);
        }

        return $this;
    }

    public function removeActuality(Actuality $actuality): self
    {
        if ($this->actualities->contains($actuality)) {
            $this->actualities->removeElement($actuality);
            $actuality->removeClassroom($this);
        }

        return $this;
    }


}
