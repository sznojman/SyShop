<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 06.08.19
 * Time: 22:22
 */

namespace App\Form\Order;


use App\Entity\Order\Carrier;
use App\Entity\Order\CarrierInterface;
use App\Entity\Order\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SetCarrierType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add(
			'id',
			HiddenType::class
		);
		$builder->add(
			'carrier',
			EntityType::class,
			[
				'class' => Carrier::class,
				'choice_label' => function (CarrierInterface $carrier) {
					return "{$carrier->getName()} - {$carrier->getCost()} ";
				},
				'placeholder' => 'wybierz',
				'empty_data' => null,
				'expanded' =>true,
				'multiple'=>false
			]
		);
	}
	public function configureOptions(OptionsResolver $resolver)
	{


		$resolver->setDefaults(array(
			'data_class' => Order::class,
		));
	}
}