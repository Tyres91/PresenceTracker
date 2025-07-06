<?php
namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Member;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titel'])
            ->add('date', DateType::class, [ /* … */ ])
            ->add('members', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, [
                'class'        => Event::class === \App\Entity\Member::class ? null : '\App\Entity\Member',
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => false,
                'attr'         => ['class' => 'select2'],
                'label'        => 'Teilnehmer',
                'required'     => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Event::class]);
    }
}
