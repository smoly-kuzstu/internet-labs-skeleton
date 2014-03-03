<?php

namespace Kuzstu\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BlogEntryType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text')
                ->add('content', 'text', array(
                    'label' => 'Содержимое',
                    'constraints' => array(
                        new NotBlank(),
                        new Length(array('min' => 3)),
                    )))
                ->add('btnSubmit', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kuzstu\BlogBundle\Entity\BlogEntry'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'kuzstu_blogbundle_blogentry';
    }

}
