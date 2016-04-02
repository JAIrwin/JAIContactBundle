<?php
namespace JAI\ContactBundle\Form\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

class ContactForm extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('fromName', TextType::class, [
			'label' => 'contact.from.name',
			'attr' => [
				'placeholder' => 'contact.name.placeholder',
				'autofocus' => true
				]
			]
		)
		->add('fromEmail', EmailType::class, [
			'label' => 'Email',
			'attr' => [ 'placeholder' => 'email.placeholder' ] ])
		->add('subject', TextType::class, [ 'label' => 'contact.subject' ])
		->add('message', TextareaType::class, [ 'label' => 'contact.message' ])
		->add('recaptcha', EWZRecaptchaType::class, [ 'label' => false ])
		->add('send', SubmitType::class)
		;
	}
}
