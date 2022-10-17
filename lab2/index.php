<?php

function getSimpleData(): array
{

    $file = file('./Data.txt', FILE_SKIP_EMPTY_LINES);
    $project = [];
    foreach ($file as $line) {
        $lineArr = explode(' ', $line);

        $project[] = [
            'id' => (int)$lineArr[0],
            'author' => $lineArr[1],
            'budget' => (int)$lineArr[2],
            'rating' => ratingCheck(explode(',', $lineArr[3])),

        ];

    }

    return $project;
}

function getUniqueId(array $projects, int $proposedId)
{
    if (count($projects) == 0) {
        return $proposedId;
    }
    $max = $projects[0]['id'];
    foreach ($projects as $project) {
        if ($project['id'] > $max) {
            $max = $project['id'];
        }
    }
    if ($proposedId > $max) {
        return $proposedId;
    }
    $max++;
    return $max;
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

$projects = getSimpleData();
if (!empty($_GET["edit"])) {

    for ($i = 0; $i < count($projects); $i++) {
        if ($_GET["edit"] == $projects[$i]["id"]) {
            saveDataInFileAfterSave($_GET, $projects, $_GET['id'], $_GET['edit']);
            $projects[$i] = fullFillProjectData($projects, $_GET);
            break;

        }
    }
} elseif (array_key_exists('id', $_GET)) {

    saveDataInFile($_GET, $projects, $_GET['id']);
    $projects[] = fullFillProjectData($projects, $_GET);

}
function fullFillProjectData($projects, $data): array
{
    return [
        "id" => getUniqueId($projects, $data['id']),
        "author" => $data["author"],
        "budget" => $data["budget"],
        "rating" => explode(',', $data["rating"])

    ];
}

function saveDataInFile($data, $projects, $id)
{
    $dataStr = getUniqueId($projects, $id) . ' ' . $data['author'] . ' ' . $data['budget'] . ' ' . $data['rating'] . "\n";
    file_put_contents('./Data.txt', "$dataStr", FILE_APPEND);
}

function saveDataInFileAfterSave($data, $projects, $id, $edit)
{
    $dataStr = '';
    for ($i = 0; $i < count($projects); $i++) {

        if ($projects[$i]['id'] == $edit) {
            $projects[$i] = fullFillProjectData($projects, $data);
            var_dump($projects[$i]);
            $dataStr .= $projects[$i]['id'] . ' ' . $projects[$i]['author'] . ' ' . $projects[$i]['budget'] . ' ' . $projects[$i]['rating'] . "\n";
        } else {
            $dataStr .= $projects[$i]['id'] . ' ' . $projects[$i]['author'] . ' ' . $projects[$i]['budget'] . ' ' . $projects[$i]['rating'];
        }
    }
    file_put_contents('./Data.txt',"$dataStr");
}

function sortByRating($x, $y, $arr)
{
    $newArr = [];
    for ($i = 0; $i < count($arr); $i++) {
        $sum = $arr[$i]["rating"][0] + $arr[$i]["rating"][1] + $arr[$i]["rating"][2];
        if ($arr[$i]["budget"] <= $y && $sum >= $x) {
            array_push($newArr, $arr[$i]);
        }
    }
    return $newArr;
}

function arrayToString($arr)
{
    $str = "";
    for ($i = 0; $i < count($arr) - 1; $i++) {
        $str .= (string)$arr[$i] . ",";
    }
    $str .= (string)$arr[$i];
    return $str;
}

//var_dump(sortByRating(6,4000, $project));

echo "<table border='5px'>";
echo "<tr> <th> id</th> <th>author</th> <th>budget</th> <th>rating</th> </tr>";
for ($i = 0; $i < count($projects); $i++) {
    echo "<tr>";
    foreach ($projects[$i] as $key => $value) {
        if ($key == "rating") {
            $value = arrayToString($value);
        }
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "<h4>Таблиця за функцією</h4>";
echo "<table border='5px'>";
echo "<tr> <th> id</th> <th>author</th> <th>budget</th> <th>rating</th> </tr>";
for ($i = 0; $i < count(sortByRating(5, 3654, $projects)); $i++) {
    echo "<tr>";
    foreach (sortByRating(5, 3654, $projects)[$i] as $key => $value) {
        if ($key == "rating") {
            $value = arrayToString($value);
        }
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>

<form method="get" action="">
    <p>Form</p>
    <input type="number" name="edit" placeholder="Type id for edit"> <br>
    <input type="number" name="id" placeholder="Id"> <br>
    <input type="text" name="author" placeholder="Author"> <br>
    <input type="number" name="budget" placeholder="Budget"> <br>
    <input type="text" name="rating" placeholder="Rating"> <br>
    <input type="submit" name="btn-ok" value="ok">


    <input type="hidden" name="fourthPoint" value="">
</form>


