<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Models/Category.php');
// require_once __DIR__ . '/../Models/Category.php';

class CategoryController
{

    public function addCategory(Category $category)
    {
        $sql = "INSERT INTO category (title, description) VALUES (:title, :description)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $category->getTitle(),
                'description' => $category->getDescription()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
