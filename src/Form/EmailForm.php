<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 16:46
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class EmailForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction('/historical/email');
        $builder->add('symbol', HiddenType::class);
        $builder->add('startDate', DateType::class, ['attr'=> ['style'=>'display:none;'],'label' => false]);
        $builder->add('endDate', DateType::class, ['attr'=> ['style'=>'display:none;'],'label' => false]);
        $builder->add('email', EmailType::class);
        $builder->add('save', SubmitType::class, array('label' => 'Send'));
    }
}