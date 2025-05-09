<?php 

    namespace App\Controller;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Empresa;
    use App\Form\EmpresaType;
    use App\Repository\EmpresaRepository;
    use Symfony\Component\HttpFoundation\Request; 
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class EmpresaController extends AbstractController {

        #[Route('/empresa', name: 'EmpresaController')]
        #[IsGranted('ROLE_USER')]

        public function read(EmpresaRepository $empresaRepository) : Response {

            $data['empresas'] = $empresaRepository->findAll();
            $data['title'] = 'Visualizar empresas';
            
            return $this->render('empresa/index.html.twig', $data);

        }


        #[Route('/empresa/adicionar', name: 'AdicionarEmpresaController')]
        #[IsGranted('ROLE_USER')]

        public function create(Request $request, EntityManagerInterface $em) : Response {
            
            $empresa = new Empresa();
            $form = $this->createForm(EmpresaType::class, $empresa);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($empresa);
                $em->flush();
                return $this->redirectToRoute('EmpresaController');
            }

            $data['title'] = 'Adicionar nova empresa';
            $data['form'] = $form;

            return $this->render('empresa/form.html.twig', $data);
        }


        #[Route('/empresa/editar/{id}', name: 'EditarEmpresaController')]
        #[IsGranted('ROLE_USER')]

        public function update($id, Request $request, EntityManagerInterface $em, EmpresaRepository $empresaRepository) : Response {
            $empresa = $empresaRepository->find($id);
            $form = $this->createForm(EmpresaType::class, $empresa);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('EmpresaController');
            }

            $data['title'] = 'Editar empresa';
            $data['form'] = $form;

            return $this->render('empresa/form.html.twig', $data);

        }


        #[Route('/empresa/excluir/{id}', name: 'ExcluirEmpresaController')]
        #[IsGranted('ROLE_USER')]

        public function delete($id, EntityManagerInterface $em, EmpresaRepository $empresaRepository) : Response {
            $empresa = $empresaRepository->find($id);
            $em->remove($empresa);
            $em->flush();
            return $this->redirectToRoute('EmpresaController');
        }
    }

?>