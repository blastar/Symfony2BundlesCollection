<?php

namespace Admin\WarehouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AdminWarehouseBundle:Default:index.html.twig', array('name' => $name));
    }
}
