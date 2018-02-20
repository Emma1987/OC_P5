<?php
namespace Model;

use EmmaM\Manager;
use Entity\Category;

class CategoryManager extends Manager
{
	public function getAllCategories()
	{
		$db = $this->getDbConnexion();

		$requete = $db->query('SELECT * FROM Category');
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Category');
		$categories = $requete->fetchAll();

		return $categories;
	}

	public function getCategoriesByPost($postId)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('SELECT Category.id, Category.name, PostCategory.categoryId, PostCategory.postId FROM PostCategory LEFT JOIN Category ON Category.id = PostCategory.categoryId WHERE postId = :postId');
		$requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Category');
		$category = $requete->fetchAll();

		return $category;
	}

	public function addCategoriesToPost($postId, $categoryId)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('INSERT INTO PostCategory (postId, categoryId) VALUES (:postId, :categoryId)');
		$requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
		$requete->bindValue(':categoryId', $categoryId, \PDO::PARAM_INT);
		$requete->execute();
	}

	public function addNewCategory(Category $category)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('INSERT INTO Category (name) VALUES (:name)');
		$requete->bindValue(':name', $category->getName(), \PDO::PARAM_INT);
		$requete->execute();
	}

	public function removeCategory($id)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('DELETE FROM Category WHERE id = :id');
		$requete->bindValue(':id', $id, \PDO::PARAM_INT);
		$requete->execute();
	}

	public function removePostCategory($postId, $categoryId)
	{
		$db = $this->getDbConnexion();

		$requete = $db->prepare('DELETE FROM PostCategory WHERE postId = :postId AND categoryId = :categoryId');
		$requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
		$requete->bindValue(':categoryId', $categoryId, \PDO::PARAM_INT);
		$requete->execute();
	}	
}