<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Autorisation;
use App\Form\AutorisationType;
use App\Repository\AutorisationRepository;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\Bien;
use App\Repository\BienRepository;

class HomecareController extends AbstractController
{

  /**
  * @Route("/", name="homecare")
  */
  public function index()
  {
    if($this->isGranted('ROLE_PROPRIETAIRE'))
    {
      return $this->redirectToRoute('bien_index');
    }
    else if ($this->isGranted('ROLE_PROFESSIONNEL'))
    {
      return $this->redirectToRoute('pro_bien_index');
    }
    else
    {
      return $this->redirectToRoute('app_login');
    }
  }

  /**
  * @Route("/my/{idBien}", name="homecare_my")
  */
  public function indexMy($idBien)
  {
    // Récupérer le repository de l'entité Bien
    $repositoryBien = $this->getDoctrine()->getRepository(Bien::class);
    // Récupérer les biens enregistrés en BD
    $bien = $repositoryBien->find($idBien);
    // Envoyer les biens récupérés à la vue chargée de les afficher

    $this->denyAccessUnlessGranted('VIEW', $bien);

    return $this->render('homecare/index.html.twig',
    ['bien' => $bien]);

    return $this->render('proprietaire_base.html.twig',
    ['bien' => $bien]);
  }


  /**
  * @Route("/pro/{idBien}", name="homecare_pro")
  */
  public function indexPro($idBien, UserInterface $user)
  {
    // Récupérer le repository de l'entité Bien
    $repositoryBien = $this->getDoctrine()->getRepository(Bien::class);
    // Récupérer les biens enregistrés en BD
    $bien = $repositoryBien->find($idBien);

    $this->denyAccessUnlessGranted('VIEW_PRO', $bien);

    // Récupérer le repository de l'entité Autorisation
    $repositoryAutorisation = $this->getDoctrine()->getRepository(Autorisation::class);
    // Récupérer les biens enregistrés en BD
    $autorisations = $repositoryAutorisation->findByAutorisation($user, $bien);

    return $this->render('professionnel/homecare/index.html.twig', [
      'bien' => $bien, 'autorisations' => $autorisations
    ]);

    // return $this->render('professionnel_base.html.twig',
    // ['bien' => $bien, 'autorisations' => $autorisations]);
  }
}
