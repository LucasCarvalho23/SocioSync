<?php 

    namespace App\Form;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class EmpresaType extends AbstractType {
        public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder->add('nome', TextType::class, ['label' => 'Nome da Empresa: ']);
            $builder->add('cnpj', TextType::class, ['label' => 'CNPJ da Empresa: ']);
            $builder->add('Salvar', SubmitType::class);
        }
        public function configureOptions(OptionsResolver $resolver) {
            $resolver->setDefaults([
                'csrf_protection' => false, 
            ]);
        }
    }

?>