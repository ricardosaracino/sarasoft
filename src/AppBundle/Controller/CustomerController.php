<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Customer controller.
 *
 * @Route("/customer")
 */
class CustomerController extends Controller
{
	/**
	 * Lists all Customer entities.
	 *
	 * @Route("/", name="customer_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$customers = $em->getRepository('AppBundle:Customer')->findAll();

		return $this->render(
			'customer/index.html.twig',
			[
				'customers' => $customers
			]
		);
	}

	/**
	 * Creates a new Customer entity.
	 *
	 * @Route("/new", name="customer_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$customer = new Customer();
		$form = $this->createForm('AppBundle\Form\Type\CustomerType', $customer);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($customer);
			$em->flush($customer);

			return $this->redirectToRoute('customer_show', array('id' => $customer->getId()));
		}

		return $this->render(
			'customer/new.html.twig',
			array(
				'customer' => $customer,
				'form' => $form->createView(),
			)
		);
	}

	/**
	 * Finds and displays a Customer entity.
	 *
	 * @Route("/{id}", name="customer_show")
	 * @Method("GET")
	 */
	public function showAction(Customer $customer)
	{
		return $this->render(
			'customer/show.html.twig',
			array(
				'customer' => $customer,
			)
		);
	}

	/**
	 * Displays a form to edit an existing Customer entity.
	 *
	 * @Route("/{id}/edit", name="customer_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Customer $customer)
	{
		$form = $this->createForm('AppBundle\Form\Type\CustomerType', $customer);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('customer_show', array('id' => $customer->getId()));
		}

		return $this->render(
			'customer/edit.html.twig',
			array(
				'customer' => $customer,
				'form' => $form->createView()
			)
		);
	}
}
