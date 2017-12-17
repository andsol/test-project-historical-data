<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 10:50
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HistoricalForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('symbol', TextType::class)
            ->add('startDate', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'))
            ->add('endDate', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'))
            ->add('save', SubmitType::class, array('label' => 'Find'));
    }
}