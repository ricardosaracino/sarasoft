<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
/**
 * Class AddressType
 * @package AppBundle\Form
 */
class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('line1')
			->add('line2')
			->add('line3')
			->add('city')
			->add('zipOrPostalcode')
			->add('stateOrProvince')
			->add('country',CountryType::class, ['preferred_choices' => ['CA','US']]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => \AppBundle\Entity\Address::class
        ]);
    }
}
