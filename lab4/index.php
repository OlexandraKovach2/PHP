<?php

//Об’єкт “Проект” (Код, автор проекту, кошторис проекту у грн.,
//оцінки проекту у трьох номінаціях (цілі числа від 1 до 5)).
//Запит проектів, кошторис яких не більше У грн.,
//які у трьох номінаціях у сумі набрали не менше, ніж Х балів.


// Клас для зберігання та редагування колекції об'єктів, виводу даних на сторінку,
use Model\Project;
use Model\Project\Collection;
use Model\Project\Repository;

function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}

spl_autoload_register('myAutoloader');

$Project1 = new Project( 1,'Олександра Ковач',1000,'5,5,5');
$Project2 = new Project( 2,'Ігор Довганич',4000,'5,5,5');

$Collections = new Collection([$Project1, $Project2]);
$dbh=new PDO('mysql:host=localhost;dbname=lab4', 'root', 'root');
$Database = new Repository($dbh);
$Database->addProject('Олександра Ковач',1000,'5,5,5');
$Database->updateProject(3, "Ihor Dovhanych", 5000, "4,4,6");
$DBArray = $Database->readProjects();
echo "<table border='1px solid'>";
for($i = 0; $i < count($DBArray); $i++){
    echo '<tr>';
    echo '<td>' . $DBArray[$i]['id'] . '</td>';
    echo '<td>' . $DBArray[$i]['author'] . '</td>';
    echo '<td>' . $DBArray[$i]['budget'] . '</td>';
    echo '<td>' . $DBArray[$i]['rating'] . '</td>';
    echo  '</tr>';
}


