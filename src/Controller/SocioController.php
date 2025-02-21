<?php 

    namespace App\Controller;
    use App\Repository\EmpresaRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Socio;
    use App\Form\SocioType;

    class SocioController extends AbstractController {

        #[Route('/socio', name: 'SocioController')]
        public function read(EntityManagerInterface $em, EmpresaRepository $empresaRepository) : Response {
            $empresa = $empresaRepository->find(3);
            $socio = new Socio();
            $socio->setNome("Lucas Carvalho da Silva");
            $socio->setCpf("11111111111");
            $socio->setEmail("lucas@lucas.com.br");
            $socio->setEmpresa($empresa);
            $em->persist($socio);
            $em->flush();
            return new Response ("Vasco da Gama");
        }


        #[Route('/socio/adicionar', name: 'AdicionarSocioController')]
        public function create() : Response {
            $form = $this->createForm(SocioType::class);
            $data['title'] = 'Adicionar novo sócio';
            $data['form'] = $form;
            return $this->render('socio/form.html.twig', $data);
        }
    }

?>