<?php 

    namespace App\Form;

use App\Entity\Empresa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class SocioType extends AbstractType {
        public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder->add('nome', TextType::class, ['label' => 'Nome completo: ']);
            $builder->add('cpf', TextType::class, ['label' => 'CPF: ']);
            $builder->add('email', TextType::class, ['label' => 'E-mail: ']);
            $builder->add('empresa_id', EntityType::class, [
                'class' => Empresa::class,
                'choice_label' => 'nome',
                'label' => 'Empresa: '
            ]);
            $builder->add('Salvar', SubmitType::class);
        }
    }

?>