<?php
if(isset($_SESSION["customer_id"])){
    
    echo "Willkommen im Loginbereich";
}else{
    echo "<span style='font-size: 14pt;color:red;'>Fehler beim Login. Bitte prüfen Sie E-Mail-Adresse und Passwort</span>";
}
?>