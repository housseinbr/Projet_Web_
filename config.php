<?php
class Config {
    private static $pdo = null;

    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "hygeia";

    public static function getConnexion() {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$servername . ";dbname=" . self::$dbname,
                    self::$username,
                    self::$password
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                error_log('Erreur de connexion à la base de données: ' . $e->getMessage());
                throw new Exception('Erreur de connexion à la base de données. Veuillez réessayer plus tard.');
            }
        }
        return self::$pdo;
    }

    public static function testConnection() {
        try {
            self::getConnexion();
            echo "Connexion réussie!";
        } catch (Exception $e) {
            echo "Erreur de connexion: " . $e->getMessage();
        }
    }
}

// Appeler la méthode de test de connexion
Config::testConnection();
?>