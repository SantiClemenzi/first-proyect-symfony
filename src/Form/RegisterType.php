<?php
namespace App\Form;

use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label'=>'Nombre'))
                ->add('apellido', TextType::class, array('label'=>'apellido'))
                ->add('email', EmailType::class, array('label'=>'email'))
                ->add('password', PasswordType::class, array('label'=>'contraseña'))
                ->add('submit', SubmitType::class, array('label'=>'Registrar'));
    }
}

