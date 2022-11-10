<?php

namespace Model\Project;


class Repository
{
    public $dbh;
    public function __construct($dbh){
        $this->dbh = $dbh;
    }
    public function addProject(string $userAuthor, int $userBudget, string $userRating){
        $this->dbh->query('INSERT INTO projects(author, budget,  rating) VALUES (' .
            "'" . $userAuthor . "', " .
            "'" . $userBudget . "', " .
            "'" . $userRating . "')"
        );
    }
    public function readProjects()
    {
        return $this->dbh->query('SELECT * FROM projects')->fetchAll();
    }
    public function updateProject(int $userId, string $userAuthor, int $userBudget, string $userRating)
    {
        $this->dbh->query('UPDATE projects SET ' .
            'author ="' . $userAuthor . '", ' .
            'budget =' . $userBudget . ', ' .
            'rating ="' . $userRating . '"' .
            'WHERE id = ' . $userId);
    }

    public function deleteProject($id){
        return $this->dbh->query("DELETE FROM projects WHERE id = " . $id);
    }
}