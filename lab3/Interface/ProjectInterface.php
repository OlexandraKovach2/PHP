<?php
namespace Interface;

interface ProjectInterface
{
    public function setId(int $id): ProjectInterface;

    public function getId(): int;

    public function setAuthor(string $author): ProjectInterface;

    public function getAuthor(): string;

    public function setBudget(int $budget): ProjectInterface;

    public function getBudget(): int;

    public function setRating(string $rating): ProjectInterface;

    public function getRating(): string;
}
