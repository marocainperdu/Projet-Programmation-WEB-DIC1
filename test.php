<?php
// Test simple pour vérifier que PHP fonctionne
echo "<h1>Test PHP - Déco Élégance Sénégal</h1>";
echo "<p>PHP version: " . phpversion() . "</p>";
echo "<p>Date actuelle: " . date('d/m/Y H:i:s') . "</p>";

// Test des sessions
session_start();
$_SESSION['test'] = 'Session fonctionne !';
echo "<p>Test session: " . $_SESSION['test'] . "</p>";

// Test formatage prix sénégalais
function formatPriceCFA($price) {
    return number_format($price, 0, ',', ' ') . ' FCFA';
}

echo "<p>Prix exemple: " . formatPriceCFA(250000) . "</p>";
?>

<style>
body { 
    font-family: Arial, sans-serif; 
    max-width: 600px; 
    margin: 50px auto; 
    padding: 20px;
    background: #f8f9fa;
}
h1 { color: #2c3e50; }
p { 
    background: white; 
    padding: 10px; 
    border-left: 4px solid #d4a574; 
    margin: 10px 0;
}
</style>
