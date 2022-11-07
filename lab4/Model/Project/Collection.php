<?php
namespace Model\Project;

use Interface\ProjectInterface;
use Interface\ProjectCollectionInterface;

class Collection implements ProjectCollectionInterface
{
    public function __construct($projectArr = [])
    {
        $this->projectArr = $projectArr;
    }

    public function getProjectArr()
    {
        return $this->projectArr;
    }

    public function setProjectArr($projectArr = []): ProjectCollectionInterface
    {
        $this->projectArr = $projectArr;
        return $this;
    }

    public function addProject(ProjectInterface $project): ProjectCollectionInterface
    {
        $this->projectArr[] = $project;
        return $this;
    }

    public function removeProjectByCode(int $id): ProjectCollectionInterface
    {
        for ($i = 0; $i < count($this->projectArr); $i++) {
            if ($this->projectArr[$i]->id == $id) {
                unset($this->projectArr[$i]);
            }
        }
        return $this;
    }
}
