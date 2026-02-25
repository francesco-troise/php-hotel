<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista-hotel</title>
    <link rel="stylesheet" href="./css/lista_hotel.css">

</head>
<body>
    <header>
        <nav>
            <a href="./home.php">
                <img class="logo" src="./assets/logo.png" alt="Logo">
            </a>
            <span class="motto">Trova il miglior hotel!</span>
            <ul>
                <li><a href="./home.php">Home</a></li>
                <li><a href="./lista_hotel.php">Scopri gli hotel</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Diritto del viaggiatore</a></li>
            </ul>

        </nav>
    </header>
    <main>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Parcheggio</th>
                        <th>Distanza dal centro</th>
                        <th>Voto</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $Table_body = "";
                        $Table_body_temp = "";
                        $parking_status = "";
                        //Support variables for table creation

                        foreach($hotels as $hotel){
                            if($hotel["parking"] == false && isset($_GET["parking"])) continue;
                            if(isset($_GET["vote"]) && $hotel["vote"] < $_GET["vote"]) continue;
                            //If filters are applied, non-compliant hotels are discarded

                            $parking_status = $hotel["parking"] ? "Disponibile" : "Non disponibile";
                            //Convert the status from boolean to string

                            ["name" => $name, "description" => $description, "parking" => $park, "vote" => $vote, "distance_to_center" => $distance_center] = $hotel;
                            //Destructuring the $hotel array

                            $Table_body_temp= "<tr>
                                <td>$name</td>
                                <td>$description</td>
                                <td>$parking_status</td>
                                <td>$distance_center km</td>
                                <td>$vote/5</td>
                            </tr>";

                            $Table_body .= $Table_body_temp;
                            //Table body will contain the final markup of the entire table
                        }

                        echo $Table_body;
                    
                    ?>
                </tbody>
            </table>

            <form action="./lista_hotel.php" method="GET">
                <div class="form-wrapper">
                <label for="check_park">Solo con parcheggio</label>
                <input type="checkbox" name="parking" value="true" id="check-park">
                </div>
                
                <div class="form-wrapper">
                <label for="select_vote">Vedrai hotel a partire dal voto scelto</label>
                <select name="vote" id="select-vote">
                    <option value="false" disabled selected hidden >Filtra per voto</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select></div>
                
                <button type="submit">Aggiungi filtri</button>
                <a class="btn-reset" href="./lista_hotel.php">Resetta filtri</a>
            </form>

        </div>
    </main>
    <footer></footer>
    
</body>
</html>