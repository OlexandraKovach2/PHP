<?php
namespace Interface;

interface ProjectCollectionInterface
{
    public function addProject(ProjectInterface $project): ProjectCollectionInterface;

    public function removeProjectByCode(int $id): ProjectCollectionInterface;
}
