<?php 

    namespace App\Controller;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Socio;
    use App\Form\SocioType;
    use App\Repository\SocioRepository;
    use Symfony\Component\HttpFoundation\Request; 
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class SocioController extends AbstractController {

        #[Route('/socio', name: 'SocioController')]
        #[IsGranted('ROLE_USER')]

        public function read(SocioRepository $socioRepository) : Response {
            $data['socios'] = $socioRepository->findAll();
            $data['title'] = 'Visualizar sócios';
            return $this->render('socio/index.html.twig', $data);
        }


        #[Route('/socio/adicionar', name: 'AdicionarSocioController')]
        #[IsGranted('ROLE_USER')]

        public function create(Request $request, EntityManagerInterface $em) : Response {
            $socio = new Socio();
            $form = $this->createForm(SocioType::class, $socio);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($socio);
                $em->flush();
                return $this->redirectToRoute('SocioController');
            }

            $data['title'] = 'Adicionar novo sócio';
            $data['form'] = $form;
            return $this->render('socio/form.html.twig', $data);
        }


        #[Route('/socio/editar/{id}', name: 'EditarSocioController')]
        #[IsGranted('ROLE_USER')]

        public function update($id, Request $request, EntityManagerInterface $em, SocioRepository $socioRepository) : Response {
            $socio = $socioRepository->find($id);
            $form = $this->createForm(SocioType::class, $socio);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('SocioController');
            }

            $data['title'] = 'Adicionar novo sócio';
            $data['form'] = $form;
            return $this->render('socio/form.html.twig', $data);

        }


        #[Route('/socio/excluir/{id}', name: 'ExcluirSocioController')]
        #[IsGranted('ROLE_USER')]

        public function delete ($id, EntityManagerInterface $em, SocioRepository $socioRepository) : Response {
            $socio = $socioRepository->find($id);
            $em->remove($socio);
            $em->flush();
            return $this->redirectToRoute('SocioController');
        }

    }

?>