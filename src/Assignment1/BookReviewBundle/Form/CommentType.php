<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 22/12/2017
 * Time: 11:01
 */

namespace Assignment1\BookReviewBundle\Form;


use Assignment1\BookReviewBundle\Entity\Author;
use Assignment1\BookReviewBundle\Entity\Comment;
use Assignment1\BookReviewBundle\Entity\Review;
use Assignment1\BookReviewBundle\Entity\User;
use Assignment1\BookReviewBundle\Repository\ReviewRepository;
use Assignment1\BookReviewBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentBody', TextareaType::class, array('label' => 'Comment: '))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Comment::class));
    }
}
