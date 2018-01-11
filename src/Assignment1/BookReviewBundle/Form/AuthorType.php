<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 22/12/2017
 * Time: 11:01
 */

namespace Assignment1\BookReviewBundle\Form;


use Assignment1\BookReviewBundle\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array('label' => 'First Name: '))
            ->add('lastName', TextType::class, array('label' => 'Last Name: '))
            ->add('imageFile', FileType::class, array('label' => 'Author Image: ', 'required' => false))
            ->add('biography', TextareaType::class, array('label' => 'Biography: '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Author::class,
        ));
    }
}
