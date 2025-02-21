<?php

namespace App\Controller;
use App\Repository\EmpresaRepository;    
use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController {
    #[Route('/api/empresas', name: 'app_api_empresas')]
    public function empresas(EmpresaRepository $empresaRepository): Response {
        $listaEmpresas = $empresaRepository->findAll();
        return $this->json($listaEmpresas, 200, [], ['groups' => ['api_list']]);
    }

    #[Route('/api/socios', name: 'app_api_socios')]
    public function socios(SocioRepository $socioRepository): Response {
        $listaSocios = $socioRepository->findAll();
        return $this->json($listaSocios, 200, [], ['groups' => ['api_list']]);
    }
}
