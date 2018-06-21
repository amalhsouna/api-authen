<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\CalculatorType;
use AppBundle\Form\ProductType;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/api/calculator", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $calculator = $request->request->all();
        $operation = $calculator['calculator']['operation'];
        if ('addition' === $operation) {
            $result = $calculator['calculator']['value1'] + $calculator['calculator']['value2'];
        }

        if ('soustraction' === $operation) {
            $result = $calculator['calculator']['value1'] - $calculator['calculator']['value2'];
        }

        if ('multiplication' === $operation) {
            $result = $calculator['calculator']['value1'] * $calculator['calculator']['value2'];
        }

        $form = $this->createForm(CalculatorType::class);

        return $this->render('default/calculator.html.twig', ['form' => $form->createView(), 'result' => $result]);
    }

    /**
     * Add new product
     *
     * @param Request $request
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post()
     *
     * @Route("/api/products", name="homepage")
     *
     * @return Product|\FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        /** validation of data */
        $form->submit($request->request->all());
        try {
            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($product);
                $em->flush();

                return $product;
            }
        } catch (\RuntimeException $exception) {
            return $this->view($exception->getForm());
        }
    }

    /**
     * Get products
     *
     * @Rest\Get()
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Route("/api/product", name="get_products")
     * @return Product|\FOS\RestBundle\View\View
     *
     */
    public function getAction()
    {
        $products = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Product')
            ->findAll();
        /* @var $products Product[] */
        return $products;
    }

    /**
     * Get products by Id | use finder elastic
     *
     * @Rest\Get()
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Route("/api/product_id", name="get_products_id")
     * @return Product|\FOS\RestBundle\View\View
     *
     */
    public function findProductById()
    {
        return $this->get('fos_elastica.finder.app.product')->find('1');
    }


    /**
     * Get product by id | use paramConverter( convert request parameters to objects.)
     *
     * @Rest\Get()
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Route("/api/product/{id}", name="get_products")
     * @return Product|\FOS\RestBundle\View\View
     *
     * @ParamConverter("product", class="AppBundle\Entity\Product")
     *
     */
    public function getProductsAction(Product $product)
    {
        return $product;
    }
}

