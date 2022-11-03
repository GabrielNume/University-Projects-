<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./error_pages.css">    
</head>

<body>
<div class="antialiased font-sans">
        <div class="md:flex min-h-screen">
            <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
                <div class="max-w-sm m-8">
                    <div class="text-black text-5xl md:text-15xl font-black">
                        DASHBOARD
                    </div>

                    <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>

                    <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                        YOU ARE NOW LOGGEED IN
                    </p>

                    <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                        <?php
                            foreach($_SESSION as $key => $value) {
                                echo $key . ": " . $value . "<br>";
                            }
                        ?>
                    </p>
                    <a href="index.php">Main page</a>
                    <form action="./logout.php" method="post">
                        <input type="submit" name="submit" value="Logout">
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
