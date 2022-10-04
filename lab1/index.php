<?php
session_start();
//$_SESSION["project"] = null;
if(isset($_SESSION["project"])){
    $project = $_SESSION["project"];
}
else{
    $project= [
        [
            "id"=>1,
            "author"=>"Igor Dowhanych",
            "budget"=>4000,
            "rating"=> [5,5,5]
        ],

        [
            "id"=>2,
            "author"=>"Vitalik Brovdi",
            "budget"=>2459,
            "rating"=> [3,1,1]
        ],
        [
            "id"=>3,
            "author"=>"Oleksandra Kovach",
            "budget"=>1139,
            "rating"=> [5,3,3]
        ],

        [
            "id"=>4,
            "author"=>"Alan Melnychenko",
            "budget"=>7681,
            "rating"=> [5,1,2]
        ],

        [
            "id"=>5,
            "author"=>"Danylo Sklyarov",
            "budget"=>999,
            "rating"=> [1,1,1]
        ]
    ];
}

function getId($project){
    for($i = 0; $i < count($project); $i++){
        if($_GET["id"] == $project[$i]["id"]){
            $max = $project[0]["id"];
            for($j = 0; $j < count($project); $j++){
                if($project[$j]["id"] > $max){
                    $max = $project[$j]["id"];
                }
            }
            $max++;
            return $max;
        }
    }
    return $_GET["id"];
}

function ratingCheck($rat){
    if(count($rat) != 3){
        return [0,0,0];
    }
    else{
        for($i = 0; $i < 3; $i++){
            if($rat[$i] > 5 || $rat[$i] < 1){
                $rat[$i] = 0;
            }
        }
        return $rat;
    }
}


if($_GET["edit"] != null){
    for($i = 0; $i < count($project); $i++){
        if($_GET["edit"] == $project[$i]["id"]){
            $project[$i] = ["id" => getId($project),
                "author" => $_GET["author"],
                "budget" => $_GET["budget"],
                "rating" => ratingCheck(explode(",",$_GET["rating"]))];
            $_SESSION["project"] = $project;
            break;
        }
    }

}
else{
    if($_GET["id"] == null){
        $_GET["id"] = 1;
    }
    if($_GET["author"] == null){
        $_GET["author"] = "Alex";
    }
    if($_GET["budget"] == null){
        $_GET["budget"] = 100;
    }
    if($_GET["rating"] == null){
        $_GET["rating"] = "3,3,3";
    }

    $project[] = ["id" => getId($project),
        "author" => $_GET["author"],
        "budget" => $_GET["budget"],
        "rating" => ratingCheck(explode(",",$_GET["rating"]))];
    $_SESSION["project"] = $project;
}

function sortByRating($x,$y, $arr ){
    $newArr = [];
    for($i = 0; $i < count($arr); $i++){
        $sum = $arr[$i]["rating"][0]+ $arr[$i]["rating"][1] + $arr[$i]["rating"][2];
        if($arr[$i]["budget"]<=$y&& $sum >= $x){array_push($newArr, $arr[$i]);}
    }
    return $newArr;
}
function arrayToString($arr){
    $str= "";
    for($i=0;$i<count($arr)-1;$i++){
        $str .= (string)$arr[$i].",";
    }
    $str .= (string)$arr[$i];
    return $str;
}
//var_dump(sortByRating(6,4000, $project));

echo "<table border='5px'>";
echo "<tr> <th> id</th> <th>author</th> <th>budget</th> <th>rating</th> </tr>";
for ($i=0; $i<count($project); $i++){
    echo "<tr>";
    foreach ($project[$i] as $key=>$value){
        if ($key=="rating"){
            $value = arrayToString($value);
        }
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo"</table>";
echo"<h4>Таблиця за функцією</h4>";
echo "<table border='5px'>";
echo "<tr> <th> id</th> <th>author</th> <th>budget</th> <th>rating</th> </tr>";
for ($i=0; $i<count(sortByRating(5,3654,$project)); $i++){
    echo "<tr>";
    foreach (sortByRating(5,3654,$project)[$i] as $key=>$value){
        if ($key=="rating"){
            $value = arrayToString($value);
        }
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo"</table>";
?>

<form method="get" action="">
    <p>Form</p>
    <input type="number" name="edit" placeholder="Type id for edit"> <br>
    <input type="number"  name="id" placeholder="Id"> <br>
    <input type="text"  name="author" placeholder="Author"> <br>
    <input type="number" name="budget"  placeholder="Budget"> <br>
    <input type="text" name="rating"  placeholder="Rating"> <br>
    <input type="submit" name="btn-ok" value="ok">


    <input type="hidden" name="fourthPoint" value="">
</form>



