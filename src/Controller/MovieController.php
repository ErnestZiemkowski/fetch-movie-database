<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Genre;
use App\Entity\Director;
use App\Entity\Language;
use App\Entity\Country;
use App\Entity\Writer;
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
    private $serializer;

    public function __construct() {
        $this->serializer = SerializerBuilder::create()->build();
    }

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
                try {
                    $movie = $this
                        ->getDoctrine()
                        ->getRepository(Movie::class)
                        ->findOneBy(array('title' => $body->Title));

                    if(!$movie instanceof Movie)
                    {
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
    
                        $genres = explode(', ', $body->Genre);    
                        
                        foreach($genres as $genre)
                        {
                            $genreEntity = $this
                                ->getDoctrine()
                                ->getRepository(Genre::class)
                                ->findOneBy(array('genre' => $genre));
                            
                            if(!$genreEntity instanceof Genre)
                            {
                                $genreEntity = new Genre();
                                $genreEntity->setGenre($genre);
                                $genreEntity->setMovie($movie);
                                $entityManager->persist($genreEntity);
                                $entityManager->persist($movie);
                            }
                            $movie->setGenre($genreEntity);
                            $genreEntity->setMovie($movie);
                            $entityManager->persist($genreEntity);
                            $entityManager->persist($movie);
                        }

                        $directors = explode(', ', $body->Director);

                        foreach($directors as $director)
                        {
                            $directorEntity = $this
                                ->getDoctrine()
                                ->getRepository(Director::class)
                                ->findOneBy(array('director' => $director));

                            if(!$directorEntity instanceof Director)
                            {
                                $directorEntity = new Director();
                                $directorEntity->setDirector($director);
                                $directorEntity->setMovie($movie);
                                $entityManager->persist($directorEntity);
                                $entityManager->persist($movie);
                            }    
                            $movie->setDirector($directorEntity);
                            $directorEntity->setMovie($movie);
                            $entityManager->persist($directorEntity);
                            $entityManager->persist($movie);
                        }

                        $writers = explode(', ', $body->Writer);

                        foreach($writers as $writer)
                        {
                            $writerEntity = $this
                                ->getDoctrine()
                                ->getRepository(Writer::class)
                                ->findOneBy(array('writer' => $writer));
                            if(!$writerEntity instanceof Writer)
                            {
                                $writerEntity = new Writer();
                                $writerEntity->setWriter($writer);
                                $writerEntity->setMovie($movie);
                                $entityManager->persist($writerEntity);
                                $entityManager->persist($movie);
                            }
                            $movie->setWriter($writerEntity);
                            $writerEntity->setMovie($movie);
                            $entityManager->persist($writerEntity);
                            $entityManager->persist($movie);
                        }

                        $languages = explode(', ', $body->Language);

                        foreach($languages as $language)
                        {
                            $languageEntity = $this
                                ->getDoctrine()
                                ->getRepository(Language::class)
                                ->findOneBy(array('language' => $language));
                            if(!$languageEntity instanceof Language)
                            {
                                $languageEntity = new Language();
                                $languageEntity->setLanguage($language);
                                $languageEntity->setMovie($movie);
                                $entityManager->persist($languageEntity);
                                $entityManager->persist($movie);
                            }
                            $movie->setLanguage($languageEntity);
                            $languageEntity->setMovie($movie);
                            $entityManager->persist($languageEntity);
                            $entityManager->persist($movie);
                        }

                        $countries = explode(', ', $body->Country);

                        foreach($countries as $country)
                        {
                            $countryEntity = $this
                                ->getDoctrine()
                                ->getRepository(Country::class)
                                ->findOneBy(array('country' => $country));
                            if(!$countryEntity instanceof Country)
                            {
                                $countryEntity = new Country();
                                $countryEntity->setCountry($country);
                                $countryEntity->setMovie($movie);
                                $entityManager->persist($countryEntity);
                                $entityManager->persist($movie);
                            }
                            $movie->setCountry($countryEntity);
                            $countryEntity->setMovie($movie);
                            $entityManager->persist($countryEntity);
                            $entityManager->persist($movie);
                        }

                        $entityManager->flush();
        
                        $serializedEntity = $this
                            ->serializer
                            ->serialize($movie, 'json');
    
                        return new Response($serializedEntity);
    
                    }
                    $serializedEntity = $this
                        ->serializer
                        ->serialize($movie, 'json');

                    return new Response($serializedEntity);
    
                } catch(\Exception $e) {
                    throw $e;
                }
            } else {
                return $this->json([
                    'message'  => 'Given movie title does not exist in external OMDB API database!'
                ]);                
            }
        } else {
            return $this->json([
                'message'  => 'Required valid title parameter in body!'
            ]);
        }
    }
}
