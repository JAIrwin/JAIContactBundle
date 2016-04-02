<?php

namespace JAI\Bundle\ContactBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

class Contact
{
    /**
     * @Assert\NotBlank()
     */
	protected $fromName;
    /**
     * @Assert\NotBlank()
     * @Assert\Email
     */
	protected $fromEmail;
    /**
     * @Assert\NotBlank()
     */
	protected $subject;
    /**
     * @Assert\NotBlank()
     */
	protected $message;
	
	/**
	 * @Recaptcha\IsTrue
	 */
	public $recaptcha;
		
	public function getFromName()
	{
		return $this->fromName;
	}

	public function setFromName($fromName)
	{
		$this->fromName = $fromName;
	}
	
	public function getFromEmail()
	{
		return $this->fromEmail;
	}

	public function setFromEmail($fromEmail)
	{
		$this->fromEmail = $fromEmail;
	}
	
	public function getSubject()
	{
		return $this->subject;
	}

	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
	
	public function getMessage()
	{
		return $this->message;
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}
}