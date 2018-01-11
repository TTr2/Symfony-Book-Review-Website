<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 09/01/2018
 * Time: 12:13
 */
namespace Assignment1\BookReviewBundle\Form;

use Assignment1\BookReviewBundle\Entity\Book;
use Assignment1\BookReviewBundle\Entity\Author;
use Assignment1\BookReviewBundle\Repository\AuthorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $authorId = $options['authorId'];
        if ($authorId)
        {
            $builder
                ->add('title', TextType::class, array('label' => 'Title: '))
                ->add('author', EntityType::class, array('label' => 'Author: ', 'class' => Author::Class, 'choice_label' => 'FullName', 'query_builder' => function (AuthorRepository $er) use($authorId){return $er->createQueryBuilder($authorId)->getFirstResult();}))
                ->add('synopsis', TextareaType::class, array('label' => 'Synopsis: '))
                ->add('genre', TextType::class, array('label' => 'Genre: '))
                ->add('imageFile', FileType::class, array('label' => 'Book Cover: ', 'required' => false))
                ->add('pages', IntegerType::class, array('label' => 'Pages: '))
                ->add('isbn_13', TextType::class, array('label' => 'ISBN 13: '))
                ->add('publisher', TextType::class, array('label' => 'Publisher: '))
                ->add('publishedDate', DateType::class, array('label' => 'Published Date: ', 'widget' => 'single_text', 'html5' => true))
                ->add('amazonURL', TextType::class, array('label' => 'Amazon URL: '))
            ;
        }
        else
        {
            $builder
                ->add('title', TextType::class, array('label' => 'Title: '))
                ->add('author', EntityType::class, array('label' => 'Author: ', 'class' => Author::Class, 'choice_label' => 'FullName'))
                ->add('synopsis', TextareaType::class, array('label' => 'Synopsis: '))
                ->add('genre', TextType::class, array('label' => 'Genre: '))
                ->add('imageFile', FileType::class, array('label' => 'Book Cover: ', 'required' => false))
                ->add('pages', IntegerType::class, array('label' => 'Pages: '))
                ->add('isbn_13', TextType::class, array('label' => 'ISBN 13: '))
                ->add('publisher', TextType::class, array('label' => 'Publisher: '))
                ->add('publishedDate', DateType::class, array('label' => 'Published Date: ', 'widget' => 'single_text', 'html5' => true))
                ->add('amazonURL', TextType::class, array('label' => 'Amazon URL: '))
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Book::class, 'authorId' => null,
        ));
    }
}