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
        // reducing the array to one dimension with key as ids
        $locations['--All locations--'] = null;

        foreach ($options['data']->locations as $k => $v) {
            $locations[$v['name']] = intval($v['id']);
        }
        ksort($locations);

        $builder->add('locations',  ChoiceType::class,
            ['choices' => $locations,]
        )
              ->add('episodes', ChoiceType::class,
                    ['choices' => []])

             ->add('dimensions',ChoiceType::class,[])

            ->add('Filter', SubmitType::class, [
                'attr' => ['class' => 'filter btn btn-primary'],
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