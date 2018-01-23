<?php
namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * ContactRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactRepository extends ServiceEntityRepository
{
	/**
	 * ContactRepository constructor.
	 *
	 * @param RegistryInterface $registry
	 */
	public function __construct(RegistryInterface $registry)
	{
		parent::__construct($registry, Contact::class);
	}

	/**
	 * @param   integer $personID
	 *
	 * @return  Contact
	 */
	public function findOneByPerson($personID)
	{
		$contact = parent::find($personID);

		return $contact instanceof Contact ? $contact : new Contact();
	}

}
