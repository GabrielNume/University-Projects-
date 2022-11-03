
<?php
function build_menu(){
session_start();
echo "<div class=\"menu\">
<input type=\"checkbox\" id=\"toggle\" name=\"toggle\">
        <ul class=\"navigation-menu\">";
        if(isset($_SESSION['is_admin'])&&$_SESSION['is_admin']==1){
            echo "<li><a href=\"admin.php\">Admin</a></li>";
        }
       echo "<li><a href=\"../index.php\">Home</a></li>";
            if(isset($_SESSION['username'])){
                echo "<li><form action=\"../auction_adder.php\" method=\"post\">
                <input type=\"submit\" name=\"auction\" value=\"Adauga licitatie\">
                </form></li>";
                echo "<li><a href=\"../profile.php\">Profilul meu</a></li>";
                echo "<li><form action=\"../logout.php\" method=\"post\">
                <input type=\"submit\" name=\"submit\" value=\"Logout\">
                     </form></li>";
            }
            else{
                echo "<li><a href=\"../login.php\">Login</a></li>";
                echo "<li><a href=\"../signin.php\">Register</a></li>";
            }
            echo "</ul>";
        echo "<i class=\"fa-solid fa-copyright copyright\">2022 Grovu Gabriel</i>"; 
        echo "<div class=\"navbar\">
        <label class=\"menu-label\" for=\"toggle\"><i class=\"fa fa-bars\"></i> Menu</label>";
        if(isset($_SESSION['username']))
        echo "<label class=\"menu-username\"><i class=\"fa-solid fa-user\"></i> ".$_SESSION['username']."</label>";
      echo "</div>";
}
?>