<?php

namespace App\Controller;

use \DateTime;
use App\Entity\Movie;
use App\Entity\Comment;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    private $serializer;

    public function __construct() 
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @Route("/comments", name="get_all_comments")
     */
    public function getComments()
    {
        $comments = $this
            ->getDoctrine()
            ->getRepository(Comment::class)
            ->findAll();
        
        $serializedEntities = $this
            ->serializer
            ->serialize($comments, 'json');

        return new Response($serializedEntities);
    }

    /**
     * @Route("/comments/{movieId}", name="get_comments_by_movie_ID")
     */
    public function getCommentsByMovieId($movieId)
    {
        var_dump('dupa');
        $comments = $this
            ->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(array('movie' => $movieId));

        $serializedEntities = $this
            ->serializer
            ->serialize($comments, 'json');

        return new Response($serializedEntities);
    }

    /**
     * @Route("/comment/new", name="new_comment")
     */
    public function createComment(Request $request)
    {
        $movieId = $request->request->get('movie_id');
        $commentContent = $request->request->get('content');

        if(isset($movieId) && !empty($movieId) && isset($commentContent) && !empty($commentContent)) {
            try {
                $movie = $this
                ->getDoctrine()
                ->getRepository(Movie::class)
                ->find($movieId);

                $comment = new Comment();
                $comment->setContent($commentContent);
                $comment->setCreatedAt(new DateTime('now'));
                $comment->setMovie($movie);

                $entityManager = $this
                    ->getDoctrine()
                    ->getManager();

                $entityManager->persist($comment);
                $entityManager->flush();

                $serializedEntity = $this
                    ->serializer
                    ->serialize($comment, 'json');

                return new Response($serializedEntity);

            } catch(\Exception $e) {
                throw $e;
            }
        } else {
            return $this->json([
                'message' => 'Invalid parameters!'
            ]);
        }
    }
}
