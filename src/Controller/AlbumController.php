<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use App\Form\AlbumType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @isGranted("ROLE_ADMIN")
 *
 * @Route("/album", name="album_")
 */
class AlbumController extends AbstractController
{
    /**
     * @Route("/album", name="album")
     */
    public function index(): Response
    {
        return $this->render('album/index.html.twig', [
            'controller_name' => 'AlbumController',
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function edit(Album $album, Request $request): Response
    {
        $form = $this->createForm(AlbumType::class, $album);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Album $data
             */
            $data = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $albums = $manager->getRepository(Album::class)->find($data->getId());

            $albums->setName($data->getName());
            $albums->setYear($data->getYear());
            $albums->setArtist($data->getArtist());
            $albums->setGenre($data->getGenre());
            $this->addFlash('notice', 'Your changes were saved');
            $manager->persist($albums);
            $manager->flush();

            return $this->redirectToRoute('albums', ['artistId' => $data->getArtist()->getId()]);
        }

        return $this->render('album/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", requirements={"id"="\d+"})
     */
    public function delete(Album $album, Request $request): Response
    {
        $form = $this->createFormBuilder($album)
            ->add('yes', SubmitType::class)
            ->add('no', SubmitType::class)
            ->getForm();
        $albumName = $album->getName();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var ClickableInterface $buttonYes
             */
            $buttonYes = $form->get('yes');
            /**
             * @var ClickableInterface $buttonNo
             */
            $buttonNo = $form->get('no');
            if ($buttonYes->isClicked()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->remove($album);
                $manager->flush();

                return $this->redirectToRoute('albums', ['artistId' => $album->getArtist()->getId()]);
            } elseif ($buttonNo->isClicked()) {
                return $this->redirectToRoute('tracks', ['id' => $album->getId()]);
            }
        }

        return $this->render('album/delete.html.twig', [
            'form' => $form->createView(),
            'albumName' => $albumName,
        ]);
    }

    /**
     * @Route("/new/{id}", name="new", defaults={"id"=null})
     */
    public function new(Artist $artist = null, Request $request): Response
    {
        $album = new Album();
        $album->setArtist($artist);
        $form = $this->createForm(AlbumType::class, $album);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $newAlbum = $form->getData();

            $manager->persist($newAlbum);
            $manager->flush();

            return $this->redirectToRoute('albums', ['artistId' => $newAlbum->getArtist()->getId()]);
        }

        return $this->render('album/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
