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
$saveProjectCollection = new Repository();

$saveProjectCollection->createNewFile('ok');
$saveProjectCollection->storeDataToFile($Collections, 'ok');
var_dump($Collections);
echo '<br> ------------------ <br>';

$Collections->removeProjectByCode(1);

var_dump($Collections);
// збереження/завантаження даних з файлів.
