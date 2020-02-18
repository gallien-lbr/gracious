<?php

namespace App\Form;

use App\Entity\AContract;
use App\Entity\ContractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class,[])
            ->add('contractType',EntityType::class, [
                'class' => ContractType::class,
            ])
            ->add('submit',SubmitType::class,[])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));

    }

    protected function addElements(FormInterface $form, ContractType $type = null) {
        //todo...
        /*$form->add('contractType',ContractTypeType::class,[
            'required' => true,
            'data' => $type,
        ]);*/
    }

    function onPreSubmit(FormEvent $event) {
        //todo...
        $d = $event->getData();
        $d = $event->getData();
        $f = $event->getForm();
        dd($d);
    }

    function onPreSetData(FormEvent $event) {

        $d = $event->getData();
        $f = $event->getForm();
        dd($d);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AContract::class,
        ]);
    }
}
