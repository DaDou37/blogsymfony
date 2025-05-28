<?php

namespace App\Controller\Api;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController 
{ //on recupere la navbar, et on va y mettre nos categorie
    public function index(CategoriesRepository $categories): Response
    {

        return $this->render('_partials/_navbar.html.twig', [
            'items' =>$categories->findBy(['parent' => null])
        ]);
    }
}