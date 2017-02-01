<?php

namespace OrderBundle\Controller;

use OrderBundle\Entity\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Order/Order/index.html.twig');
    }
}
