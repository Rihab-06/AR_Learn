<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        
        // Si pas connecté, rediriger vers login
        if(!$session->get('isLoggedIn')){
            return redirect()->to('/');
        }
        
        // Passer les données de session à la vue
        $data = [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email')
        ];
        
        return view('/dash/dashboard', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
