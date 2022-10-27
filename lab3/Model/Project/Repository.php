<?php
namespace Model\Project;

use Interface\ProjectCollectionInterface;
use Model\Project;

class Repository
{
    public function createNewFile(string $fileName){
        $file = fopen("./$fileName.txt",'w+');
        fclose($file);
    }
    public function loadDataFromFile(string $fileName): ProjectCollectionInterface
    {
        $lines = file("./$fileName.txt", FILE_SKIP_EMPTY_LINES);
        $dict = new Collection([]);
        foreach ($lines as $line) {
            $lineArr = explode(' ', $line);

            $dict->addProject(new Project((int)$lineArr[0], $lineArr[1], (int)$lineArr[2], $lineArr[3]));
        }
        return $dict;
    }

    public function storeDataToFile(ProjectCollectionInterface $carCollection, string $fileName)
    {
        $dataStr = '';
        for($i = 0; $i < count($carCollection->getProjectArr()); $i++){
            $dataStr .= $carCollection->getProjectArr()[$i]->getId() . ' ' .
                $carCollection->getProjectArr()[$i]->getAuthor() . ' ' .
                $carCollection->getProjectArr()[$i]->getBudget() . ' ' .
                $carCollection->getProjectArr()[$i]->getRating() . ' ' .  "\n";
        }
        file_put_contents("./$fileName.txt", "$dataStr", FILE_APPEND);
    }
}
