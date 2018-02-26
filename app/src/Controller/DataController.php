<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 24.02.18
 * Time: 22:11
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends Controller
{
    /**
     * @Route("/add-post", name="app_data_add_post")
     */
    public function writePost(EntityManagerInterface $entityManager)
    {
        $post = new Post();
        $category = new Category();
        $comment_1 = new Comment();
        $comment_2 = new Comment();
        $tag_1 = new Tag();
        $tag_2 = new Tag();

        $category->setName('Sport');
        $category->setPosts($post);

        $comment_1->setContent('Good article');
        $comment_1->setPostedAt(new \DateTime('@' . (string) (time() - 60 * 30)));
        $comment_1->setPost($post);

        $comment_2->setContent('Bad article');
        $comment_2->setPostedAt(new \DateTime('@' . (string) (time() - 60 * 15)));
        $comment_2->setPost($post);

        $tag_1->setName('football');
        $tag_1->setPosts($post);

        $tag_2->setName('Dynamo');
        $tag_2->setPosts($post);

        $post->setTitle('Цыганков догнал Мбокани в гонке бомбардиров');
        $post->setContent("Полузащитник 'Динамо' Виктор Цыганков сравнялся с Дьемерси Мбокани по количеству забитых мячей в чемпионате Украины сезона 2017/18. На счету украинца 8 голов в 17 матчах, у конголезца столько же в 16 поединках.");
        $post->setPostedAt(new \DateTime('@' . (string) (time() - 60 * 60)));
        $post->setCategory($category);
        $post->setComments($comment_1);
        $post->setComments($comment_2);
        $post->setTag($tag_1);
        $post->setTag($tag_2);

        $entityManager->persist($post);
        $entityManager->persist($comment_1);
        $entityManager->persist($comment_2);
        $entityManager->persist($category);
        $entityManager->persist($tag_1);
        $entityManager->persist($tag_2);
        $entityManager->flush();

        return $this->render('data/write_post.html.twig', ['id' => $post->getId()]);
    }
}