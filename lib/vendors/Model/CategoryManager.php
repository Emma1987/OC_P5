<?php
namespace Model;

use EmmaM\Manager;
use Entity\Category;

class CategoryManager extends Manager
{
    public function getAllCategories()
    {
        $requete = $this->getDb()->query('SELECT * FROM Category');
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Category');
        return $categories = $requete->fetchAll();
    }

    public function getCategoriesByPost($postId)
    {
        $requete = $this->getDb()->prepare(
            'SELECT Category.id, Category.name, PostCategory.categoryId, PostCategory.postId 
            FROM PostCategory 
            LEFT JOIN Category ON Category.id = PostCategory.categoryId 
            WHERE postId = :postId'
        );
        $requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Category');
        return $category = $requete->fetchAll();
    }

    public function addCategoriesToPost($postId, $categoryId)
    {
        $requete = $this->getDb()->prepare('INSERT INTO PostCategory (postId, categoryId) VALUES (:postId, :categoryId)');
        $requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $requete->bindValue(':categoryId', $categoryId, \PDO::PARAM_INT);
        $requete->execute();
    }

    public function countCategories()
    {
        $requete = $this->getDb()->query('SELECT COUNT(*) FROM Category');
        return $categoryNumber = $requete->fetchColumn();
    }

    public function addNewCategory(Category $category)
    {
        $requete = $this->getDb()->prepare('INSERT INTO Category (name) VALUES (:name)');
        $requete->bindValue(':name', $category->getName(), \PDO::PARAM_INT);
        $requete->execute();
    }

    public function removeCategory($id)
    {
        $requete = $this->getDb()->prepare('DELETE FROM Category WHERE id = :id');
        $requete->bindValue(':id', $id, \PDO::PARAM_INT);
        $requete->execute();
    }

    public function removePostCategory($postId, $categoryId)
    {
        $requete = $this->getDb()->prepare('DELETE FROM PostCategory WHERE postId = :postId AND categoryId = :categoryId');
        $requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $requete->bindValue(':categoryId', $categoryId, \PDO::PARAM_INT);
        $requete->execute();
    }   
}