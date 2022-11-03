<!DOCTYPE html>
<html lang="en">
    <?php
        // AICI PORNESC SESIUNEA SI VERIFIC DACA USERUL E AUTENTIFICAT
        // DACA NU E AUTENTIFICAT IL DUC INAPOI LA INDEX SA SE AUTENTIFICE
        // SI PAGINA ASTA NU SE MAI INCARCA 
        session_start();
        if (!$_SESSION["is_logged_in"]) {
            header("Location: ./index.php");
            exit();
        }
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./error_pages.css">    
    <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
</style>
</head>

<body>
<div class="antialiased font-sans">
        <div class="md:flex min-h-screen">
            <div class="w-full bg-white flex items-center justify-center">
                <div class="max-w-xl m-24">
                    <div class="text-black text-5xl md:text-15xl font-black">
                        DASHBOARD
                    </div>

                    <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>

                    <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                        YOU ARE NOW LOGGEED IN
                    </p>

                    <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                        <?php
                            // AICI AFISEZ DATELE SALVATE IN SESIUNE ALE UTILIZATORULUI AUTENTIFICAT 
                            foreach($_SESSION as $key => $value) {
                                echo $key . ": " . $value . "<br>";
                            }
                        ?>
                        <div style="display:grid;grid-template-columns: auto auto auto;">
                        <?php
                                // MAI JOS AVETI UN EXEMPLU CUM SA AFISATI DIN BAZA DE DATE USERI
                                // ACELASI LUCRU TREBE FACUT SI CU RESTU TABELELOR PE PAGINILE LOR 

                                // require_once "./databse_singleton_connector.php";
                                // $conn = DatabaseConnector::getInstance()->getConnection();
                                // // var_dump($conn);
                                // $variable = $conn->query("SELECT * FROM users");
                                // // $variable = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
                                // while ($row = $variable->fetch_assoc()) {
                                //     echo '<div class="card" >
                                //     <img src="'.$row["avatar_file_path"].'" alt="Avatar" style="width:100%">
                                //     <div class="container">
                                //     <p>London, UK</p>
                                //     <p> '.$row["name"].'</p>
                                //     </div>
                                // </div>';
                                // }
                        
                        ?>
                        </div>
                    </p>
                            
                    <form action="./logou_script.php" method="post">
                        <input type="submit" name="submit" value="Logout">
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>