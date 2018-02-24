<?php
namespace Model;

use EmmaM\Manager;
use Entity\Image;

class ImageManager extends Manager
{
    public function getAllImages()
    {
        $requete = $this->getDb()->query('SELECT * FROM Image');
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Image');
        return $images = $requete->fetchAll();
    }

    public function getImageByPost($postId)
    {
        $requete = $this->getDb()->prepare('SELECT * FROM Image WHERE postId = :postId');
        $requete->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Image');
        return $image = $requete->fetch();
    }

    public function addImage(Image $image)
    {
        $requete = $this->getDb()->prepare(
            'INSERT INTO Image (tmpName, title, extension, size, url, postId) 
            VALUES (:tmpName, :title, :extension, :size, :url, :postId)'
        );

        $requete->bindValue(':tmpName', $image->getTmpName());
        $requete->bindValue(':title', $image->getTitle());
        $requete->bindValue(':extension', $image->getExtension(), \PDO::PARAM_STR);
        $requete->bindValue(':size', $image->getSize());
        $requete->bindValue(':url', $image->getUrl(), \PDO::PARAM_STR);        
        $requete->bindValue(':postId', $image->getPostId());

        $requete->execute();
    }

    public function deleteImage($id)
    {
        $requete = $this->getDb()->prepare('DELETE FROM Image WHERE id = :id');
        $requete->bindValue(':id', $id, \PDO::PARAM_INT);
        $requete->execute();
    }   
}