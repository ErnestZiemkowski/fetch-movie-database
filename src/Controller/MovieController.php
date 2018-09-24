<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use GuzzleHttp\Client;
use \DateTime;
use JMS\Serializer\SerializerBuilder;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="movie")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MovieController.php',
        ]);
    }

    /**
     * @Route("/movie/new", name="new_movie")
     */
    public function new(Request $request)
    {
        $title = $request->request->get('title');

        if(isset($title) && !empty($title)) {
            $title = trim($request->request->get('title'), ' ');
            $client = new Client();
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=638d622&t=' . $title);
            $resBodyType = $res->getHeader('content-type');
            $resStatusCode = $res->getStatusCode(); 

            if($resStatusCode === 200 && $resBodyType[0] === 'application/json; charset=utf-8') {
                $body = json_decode($res->getBody());
                // var_dump($body->Title);
                // $year = (int)$body->Year;
                // $body->imdbVotes = str_replace(',','', $body->imdbVotes);
                $movie = new Movie();
                $movie->setTitle($body->Title);
                $movie->setYear(new DateTime($body->Year));
                $movie->setRated($body->Rated);
                $movie->setReleased(new DateTime($body->Released));
                $movie->setRuntime($body->Runtime);
                $movie->setPlot($body->Plot);
                $movie->setAwards($body->Awards);
                $movie->setPosterUrl($body->Poster);
                $movie->setMetascore($body->Metascore);
                $movie->setImdbRating($body->imdbRating);
                $movie->setImdbVotes(str_replace(',','', $body->imdbVotes));
                $movie->setImdbId($body->imdbID);
                $movie->setType($body->Type);
                $movie->setDvd(new DateTime($body->DVD));
                $movie->setBoxOffice($body->BoxOffice);
                $movie->setProduction($body->Production);
                $movie->setWebsiteUrl($body->Website);

                $entityManager = $this
                    ->getDoctrine()
                    ->getManager();

                $entityManager->persist($movie);
                $entityManager->flush();

                // return $this->json([
                //     'message' => 'Movie saved to database!',
                //     'movie' => (array)$movie
                // ]);

                $serializer = SerializerBuilder::create()->build();
                $serializedEntity = $serializer->serialize($movie, 'json');
                return new Response($serializedEntity);

            } else {
                return $this->json(['message'  => 'Given movie title does not exist in external OMDB API database!']);                
            }
        } else {
            return $this->json(['message'  => 'Required valid title parameter in body!']);
        }
    }


}
