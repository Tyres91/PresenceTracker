<?php
namespace App\Form;

use App\Entity\Event;
use App\Entity\Member;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titel'])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label'  => 'Datum',
            ])
            ->add('members', EntityType::class, [
                'class'        => Member::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => false,
                'attr'         => ['class' => 'select2'],
                'label'        => 'Teilnehmer',
                'required'     => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Event::class]);
    }
}
