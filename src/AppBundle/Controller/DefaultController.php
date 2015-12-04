<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/{_locale}/get/seed/{seed}", name="get_by_seed_locale")
     * @Route("/get/seed/{seed}", name="get_by_seed")
     */
    public function getBySeedAction(Request $request, $seed)
    {
        $return             = array('status'=>1, 'message'=>'', 'data'=>null); // retorno padrão
        $router             = $this->container->get('router');
        $translator         = $this->get('translator');


        // da uma limpada
        $seed = md5($seed . $this->container->getParameter('secret'));
        
        // extrai um numero de 0~9
        $seed  = substr(base_convert(md5($seed), 16, 10) , -1);

        srand($seed); // usa pro rand

        // image path
        $image_path = $router->getContext()->getScheme() . '://'  . $router->getContext()->getHost() . $router->getContext()->getBaseUrl();
        $image_path = '/image/cenouro.jpg';

        // gera
        $random = rand(1, 8);

        $message = '';

        // são tão poucas opções que nem vale a pena criar DB
        switch ($random) {

            case 1:
                $message = 'Yes!';
                break;

            case 2:
                $message = 'No!';
                break;

            case 3:
                $message = 'Maybe.';
                break;

            case 4:
                $message = 'Sure!';
                break;

            case 5:
                $message = "I really don't care.";
                break;
            
            case 6:
                $message = "Of course not.";
                break;

            case 7:
                $message = "Ask again.";
                break;

            case 8:
                $message = "Screw you!";
                break;
            
        }

        // traduz, se precisar
        $message = $translator->trans($message);

        // responde
        $data = array(
            'message'=>$message,
            'image'=>$image_path
        );


        $return['data'] = $data;

        return new JsonResponse($return);
    }
}
