<?php
namespace Model;

use Interface\ProjectInterface;

class Project implements ProjectInterface
{
    public function __construct(int $id = 0, string $author = "none", int $budget = 0, string $rating = "0,0,0")
    {
        $this->id = $id;
        $this->author = $author;
        $this->budget = $budget;
        $this->rating = $this->ratingCheck(explode(',',$rating));
    }

    function ratingCheck($rat)
    {
        if (count($rat) != 3) {
            return [0, 0, 0];
        } else {
            for ($i = 0; $i < 3; $i++) {
                if ($rat[$i] > 5 || $rat[$i] < 1) {
                    $rat[$i] = 0;
                }
            }
            return $rat;
        }
    }

    public function setId(int $id): ProjectInterface
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setAuthor(string $author): ProjectInterface
    {
        $this->author = $author;
        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setBudget(int $budget): ProjectInterface
    {
        $this->budget = $budget;
        return $this;
    }

    public function getBudget(): int
    {
        return $this->budget;
    }

    public function setRating(string $rating): ProjectInterface
    {
        $this->rating = $this->ratingCheck(explode(',',$rating));
        return $this;
    }

    public function getRating(): string
    {
        $str = $this->rating[0] . ',' . $this->rating[1] . ',' . $this->rating[2];
        return $str;
    }

}