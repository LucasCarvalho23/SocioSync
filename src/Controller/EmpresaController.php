<?php 

    namespace App\Controller;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Empresa;

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
    }

?>