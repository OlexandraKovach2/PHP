<?php
session_start();
$_SESSION["subject"] = null;


if(isset($_SESSION["subject"])) {
    $subject = $_SESSION["subject"];
}else {
    $subject = [
        [
            "id" => 1,
            "name" => "PHP",
            "scores" => 4,
            "teacher" => "Alex",

        ],
        [
            "id" => 2,
            "name" => "Archit",
            "scores" => 6,
            "teacher" => "Igor",

        ],
        [
            "id" => 3,
            "name" => "Mathematics",
            "scores" => 8,
            "teacher" => "Sashka",

        ],
        [
            "id" => 4,
            "name" => "Ang",
            "scores" => 2,
            "teacher" => "Vitalik",

        ],
        [
            "id" => 5,
            "name" => "Ukrainian language",
            "scores" => 3,
            "teacher" => "Lesha",

        ]
    ];
}
function getId($subject){
    for($i = 0; $i < count($subject); $i++){
        if($_GET["id"] == $subject[$i]["id"]){
            $max = $subject[0]["id"];
            for($j = 0; $j < count($subject); $j++){
                if($subject[$j]["id"] > $max){
                    $max = $subject[$j]["id"];
                }
            }
            $max++;
            return $max;
        }
    }
    return $_GET["id"];
}


if($_GET["edit"] != null){
    for($i = 0; $i < count($subject); $i++){
        if($_GET["edit"] == $subject[$i]["id"]){
            $subject[$i] = ["id" => getId($subject),
                "name" => $_GET["name"],
                "scores" => $_GET["scores"],
                "teacher" => $_GET["teacher"],

                $_SESSION["subject"] = $subject];
            break;
        }
    }

}
else{
    if($_GET["id"] == null){
        $_GET["id"] = 1;
    }
    if($_GET["name"] == null){
        $_GET["name"] = "PHP";
    }
    if($_GET["teacher"] == null){
        $_GET["teacher"] = 100;
    }
    if($_GET["scores"] == null){
        $_GET["scores"] = "Sashka";
    }


    $subject[] = ["id" => getId($subject),
        "name" => $_GET["name"],
        "teacher" => $_GET["staff"],
        "scores" => $_GET["scores"],

        $_SESSION["subject"] = $subject];
}




echo "<h2>Таблиця всіх значень</h2>";
echo "<table border='1px'>";
echo "<tr> <th>Id</th> <th>Name</th> <th>Staff number</th> <th>Scores</th>  </tr>";
for($i = 0; $i < count($subject); $i++){
    echo "<tr>";
    foreach ($subject[$i] as $key=>$value){
        if($value != null){
            echo "<td>$value</td>";
        }

    }

    echo "</tr>";
}
echo "</table>";



?>


<form method="get" action="">
    <p>Form</p>
    <input type="number" name="edit" placeholder="Type id for edit"> <br>
    <input type="number"  name="id" placeholder="Id"> <br>
    <input type="text"  name="name" placeholder="Name"> <br>
    <input type="text" name="staff" type="number" " placeholder="Teacher"> <br>
    <input type="number" name="scores"  placeholder="Scores"> <br>
    <input type="submit" name="btn-ok" value="ok">


    <input type="hidden" name="fourthPoint" value="">
</form>






