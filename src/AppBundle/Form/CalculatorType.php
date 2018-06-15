<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Event\AddNameFieldSubscriber;

class CalculatorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value1', IntegerType::class)
            ->add('value2', IntegerType::class)
            ->add('operation', ChoiceType::class, ['choices' => array(
                'addition' => 'addition',
                'soustraction' => 'soustraction',
                'multiplication' => 'multiplication',
            )])
            ->add('=', SubmitType::class);

        $builder->addEventSubscriber(new AddNameFieldSubscriber());
        /*$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            var_dump('fddffff');die;
            // ... add a choice list of friends of the current application user
        });*/
    }
}