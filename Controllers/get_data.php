<?php
require_once '../config.php'; // Incluye la conexión a la base de datos

header('Content-Type: application/json');

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    try {
        if ($type == 'categories') {
            $stmt = "SELECT id, category as name FROM categories";
            $pdo = Config::cnx()->prepare($stmt);
            $pdo->execute();
        } elseif ($type == 'subcategories' && isset($_GET['id_category'])) {
            $pdo = Config::cnx()->prepare("SELECT id, subcategory as name FROM subcategories WHERE subcategories.id_category = ?");
            $pdo->execute([$_GET['id_category']]);
        } elseif ($type == 'suppliers') {
            $stmt = "SELECT id, name FROM suppliers";
            $pdo = Config::cnx()->prepare($stmt);
            $pdo->execute();
        } else {
            echo json_encode([]);
            exit;
        }

        echo json_encode($pdo->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la consulta']);
    }
}