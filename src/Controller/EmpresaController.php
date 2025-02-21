<?php 

    namespace App\Controller;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Empresa;
    use App\Form\EmpresaType;
    use Symfony\Component\HttpFoundation\Request; 

    class EmpresaController extends AbstractController {

        #[Route('/empresa', name: 'EmpresaController')]
        public function read(EntityManagerInterface $em) : Response {
            $empresa = new Empresa();
            $empresa->setNome('Lukhaz Produções');
            $empresa->setCnpj('12345678912345');
            $em->persist($empresa);
            $em->flush();
            return new Response ("Vasco");
        }


        #[Route('/empresa/adicionar', name: 'AdicionarEmpresaController')]
        public function create(Request $request, EntityManagerInterface $em) : Response {
            
            $empresa = new Empresa();
            $form = $this->createForm(EmpresaType::class, $empresa);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($empresa);
                $em->flush();
            }

            $data['title'] = 'Adicionar nova empresa';
            $data['form'] = $form;

            return $this->render('empresa/form.html.twig', $data);
        }
    }

?>