<?php
namespace App\School\Validator\Constraints;

use App\School\Entity\House;
use App\School\Util\HouseManager;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HousesValidator extends ConstraintValidator
{
	/**
	 * @var HouseManager
	 */
	private $houseManager;

	/**
	 * HousesValidator constructor.
	 *
	 * @param HouseManager $houseManager
	 */
	public function __construct(HouseManager $houseManager)
	{
		$this->houseManager = $houseManager;
	}

	/**
	 * @param mixed      $value
	 * @param Constraint $constraint
	 */
	public function validate($value, Constraint $constraint)
	{
		$this->houses = $this->houseManager->getSettingManager()->get('house.list', []);

		if (empty($value) || !$value instanceof ArrayCollection)
			$value = new ArrayCollection();

		foreach ($this->houses as $q => $w)
		{
			$house = new House();
			$house->setName($q);
			if ($this->houseManager->getStatus($house) > 0)
			{
				$valid = false;
				foreach ($value->toArray() as $house)
				{
					if ($q == $house->getName())
					{
						$valid = true;
						break;
					}
				}
				if (!$valid)
					$this->context->buildViolation('school.houses.remove.locked', ['%name%' => $q])
						->addViolation();
			}
		}
	}

}