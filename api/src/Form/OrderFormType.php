<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('master_id', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please check the master choice',
                    ])
                ],
            ])
            ->add('time_id', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please check the time choice',
                    ])
                ],
            ])
            ->add('service_id', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please check the service choice',
                    ])
                ],
            ])
            ->add('price')
            ->add('duration')
            ->add('client_id')
            ->add('client_name', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your name',
                    ])
                ],
            ])
            ->add('email', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ]),
                    new Email()
                ],
            ])
            ->add('phone')
            ->add('telegram')
            ->add('notification_type')
        ;
    }
}
