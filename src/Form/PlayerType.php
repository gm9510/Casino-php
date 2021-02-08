<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->addEventListener(FormEvents::PRE_SET_DATA,
                    function (FormEvent $event){
                        $player = $event->getData();
                        $form = $event->getForm();
                        if( !$player || null === $player->getId() ){
                            $form->add('Name');
                        }
                    }
                )
                ->addEventListener(FormEvents::PRE_SET_DATA,
                    function (FormEvent $event){
                        $player = $event->getData();
                        $form = $event->getForm();
                        if( null !== $player->getId() ){
                            $form->add('Money');
                        }
                    }
        );
    }


    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
