<?php
namespace App\Form;
use App\Form\Model\CharacterFilterModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class CharacterFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // reducing the array to one dimension with key as ids
        $choices['All'] = null;

        foreach ($options['data']->locations as $k => $v) {
            $choices[$v['name']] = $v['id'];
        }

        $builder->add('locations',  ChoiceType::class,
            ['choices' => $choices,]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CharacterFilterModel::class,
        ]);
    }
}