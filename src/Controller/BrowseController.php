<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Cover;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrowseController extends AbstractController
{
    /**
     * @Route("/browse", name="browse")
     */
    public function index(): Response
    {
        return $this->render('browse/index.html.twig', [
            'controller_name' => 'BrowseController',
        ]);
    }

    /**
     * @Route("/artists", name="artists")
     */
    public function artists(): Response
    {
        $artists = $this->getDoctrine()
            ->getRepository(Artist::class)
            ->findBy(
                [],
                ['name' => 'ASC']
            );

        return $this->render('browse/artists.html.twig', [
            'artists' => $artists,
        ]);
    }

    /**
     * @Route("/albums/{artistId}", name="albums", requirements={"artistId"="\d+"})
     */
    public function albums(int $artistId): Response
    {
        $artist = $this->getDoctrine()
            ->getRepository(Artist::class)
            ->find(
                $artistId
            );
        if (!$artist) {
            throw $this->createNotFoundException("Cette artiste n'existe pas...");
        }
        $albums = $artist->getAlbums();

        return $this->render('browse/albums.html.twig', [
            'albums' => $albums,
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("tracks/{id}", name="tracks")
     * @Entity("album", expr="repository.findWithTracksAndSongs(id)")
     */
    public function tracks(Album $album): Response
    {
        $tracks = $album->getTracks();

        $cover = $this->getDoctrine()
            ->getRepository(Cover::class)
            ->find($album->getGenre());
        $cover = base64_encode(stream_get_contents($cover->getJpeg()));

        return $this->render('browse/tracks.html.twig', [
            'tracks' => $tracks,
            'album' => $album,
            'image' => $cover,
        ]);
    }
}
