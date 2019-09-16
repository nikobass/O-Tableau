<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\PresenceLunch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PresenceLunchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $students = $options['students'];

        

            $builder
            ->add('student', EntityType::class,[
                'class'=> Student::class,
                'choices'=> $students,
                'expanded' =>true,
                'multiple' =>true
            ]
            );
            foreach ($students as $student) {
                
                $builder
                ->add('is_present', CheckboxType::class, [
                    'value' => false,

                ])
                //->add('is_ordered')
                //->add('is_canceled')
                ->add('has_eated', CheckboxType::class, [
                    'value' => false,
                ]);
                //->add('calendar')
                
            ;}
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PresenceLunch::class,
            'students'=>null,
        ]);
    }
}
