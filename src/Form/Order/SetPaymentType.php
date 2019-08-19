<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 06.08.19
 * Time: 22:32
 */

namespace App\Form\Order;

use App\Entity\Order\Order;
use App\Entity\Order\Payment;
use App\Entity\Order\PaymentInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class SetPaymentType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add(
			'id',
			HiddenType::class
		);
		$builder->add(
			'payment',
			EntityType::class,
			[
				'class' => Payment::class,
				'choice_label' => function (PaymentInterface $payment) {
					return " {$payment->getName()} ";
				},
				'placeholder' => 'wybierz ',
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