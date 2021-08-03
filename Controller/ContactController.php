<?php

namespace JAI\Bundle\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use JAI\Bundle\ContactBundle\Form\Contact\ContactForm;
use JAI\Bundle\ContactBundle\Entity\Contact;


class ContactController extends Controller
{
	public function contactAction(Request $request)
	{
		$contact = new Contact();
		$form = $this->createForm(ContactForm::class, $contact);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$honeytrap = $contact->getFromEmail();
			if($honeytrap == '') {
				$this->sendFeedback($contact);
				return $this->redirectToRoute('jai_contact_success');
			}
		}
		return $this->render('JAIContactBundle:contact:submit.html.twig', array('form' => $form->createView(),
			)
		);
	}

	public function successAction()
	{
		return $this->render('JAIContactBundle:contact:success.html.twig');
	}

	public function sendFeedback($contact) {
		$fromName = $contact->getFromName();
		$fromEmail = $contact->getRepeatEmail();
		$subject = $contact->getSubject();
		$message = $contact->getMessage();
		$feedback_email = $this->getParameter('feedback_email');
		$feedback = (new \Swift_Message($subject))
		->setFrom($fromEmail)
		->setTo($feedback_email)
		// html version of the message
		->setBody(
			$this->renderView(
				'JAIContactBundle:Emails:feedback.html.twig',
				array(
					'from_name' => $fromName,
					'from_email' => $fromEmail,
					'subject' => $subject,
					'message' => $message
				)
			),
			'text/html'
		)
		// plaintext version of the message
		->addPart(
			$this->renderView(
				'JAIContactBundle:Emails:feedback.txt.twig',
				array(
					'from_name' => $fromName,
					'from_email' => $fromEmail,
					'subject' => $subject,
					'message' => $message
				)
			),
			'text/plain'
		);
		$this->get('mailer')->send($feedback);
	}
}
