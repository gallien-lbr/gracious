<?php
namespace App\Form;

use App\Form\Model\CharacterFilterModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CharacterFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // iterate through attributes and populate list
        foreach (['location','episode'] as $var) {
            $filters[$var]['--All --'] = null;

            foreach ($options['data']->$var as $v) {
                $filters[$var][$v['name']] = intval($v['id']);
            }
            ksort($filters[$var]);
        }

        $filters['dimension']['--All--'] = null;
        foreach ($options['data']->dimension as $k => $v) {
            $filters['dimension'][$k] = implode(',', $v);
        }

        $builder
              ->add(
                  'location',
                  ChoiceType::class,
                  ['choices' => $filters['location']]
              )

            ->add('filter_location', SubmitType::class, [
                'attr' => ['class' => 'filter btn btn-primary'],
                'label' => 'Filter by location',
            ])

            ->add(
                'episode',
                ChoiceType::class,
                ['choices' => $filters['episode']]
            )

            ->add('filter_episode', SubmitType::class, [
                'attr' => ['class' => 'filter btn btn-primary'],
                'label' => 'Filter by episode',
            ])

            ->add('dimension', ChoiceType::class, [
                'choices' => $filters['dimension']
            ])

            ->add('filter_dimension', SubmitType::class, [
                'attr' => ['class' => 'filter btn btn-primary'],
                'label' => 'Filter by dimension',
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CharacterFilterModel::class,
        ]);
    }
}
