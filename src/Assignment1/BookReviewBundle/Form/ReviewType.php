<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 09/01/2018
 * Time: 12:13
 */
namespace Assignment1\BookReviewBundle\Form;

use Assignment1\BookReviewBundle\Entity\Book;
use Assignment1\BookReviewBundle\Entity\Review;
use Assignment1\BookReviewBundle\Entity\User;
use Assignment1\BookReviewBundle\Repository\BookRepository;
use Assignment1\BookReviewBundle\Repository\UserRepository;
use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('summary', TextType::class, array('label' => 'Summary: '))
            ->add('rating', RatingType::class, array('label' => 'Rating: ', ))
            ->add('messageBody', TextareaType::class, array('label' => 'Review: '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Review::class,
        ));
    }
}