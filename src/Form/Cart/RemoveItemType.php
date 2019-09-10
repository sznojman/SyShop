<?php


namespace App\Form\Cart;

use App\Entity\Cart\CartItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RemoveItemType extends AbstractType
{
	private $urlGenerator;

	public function __construct(UrlGeneratorInterface $urlGenerator)
	{
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->setAction($this->urlGenerator->generate('cart.removeItem', ['id' => $builder->getData()->getId()]));

		$builder->add(
			'id',
			HiddenType::class
		);

		$builder->add(
			'submit',
			SubmitType::class,
			[
				'label' => null,
				'attr' => [
					'class' => 'fas fa-trash-alt',
				]
			]
		);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => CartItem::class,
		));
	}
}