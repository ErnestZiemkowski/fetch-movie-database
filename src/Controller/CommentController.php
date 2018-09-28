<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Movie;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use \DateTime;
use JMS\Serializer\SerializerBuilder;

class CommentController extends AbstractController
{
    private $serializer;

    public function __construct() 
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @Route("/comment", name="comment")
     */
    public function index()
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    /**
     * @Route("/comment/new", name="new_comment")
     */
    public function new(Request $request)
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
