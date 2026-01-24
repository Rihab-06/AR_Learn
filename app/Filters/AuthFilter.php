<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
       // 1. Vérification de l'authentification
    // On vérifie si la clé 'isLoggedIn' n'existe pas ou est fausse dans la session
    if (!session()->get('isLoggedIn')) {
    // Redirige l'utilisateur vers la page d'accueil avec un message d'erreur flash
    return redirect()->to('/')->with('error', 'Vous devez vous connecter d\'abord');
}

    // 2. Vérification des droits d'accès (Rôles)
    // On vérifie si des arguments ont été passés au filtre et si le rôle 'admin' est requis
    if ($arguments && in_array('admin', $arguments)) {
    // Si l'utilisateur est connecté mais que son rôle en session n'est pas 'admin'
     if (session()->get('role') !== 'admin') {
        // Redirige vers l'accueil avec un message de refus
        return redirect()->to('/')->with('error', 'Accès refusé');
    }
}
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
