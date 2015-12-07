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
        $image_path = $request->getUriForPath('/image/cenouro.png');

        $message = '';

        // são tão poucas opções que nem vale a pena criar DB

        // balanceia as chances um pouco

        switch (rand(1, 4)) {
            case 1:
                $message = 'Yes!';
                break;


            case 2:
                $message = 'No!';
                break;
            
            default:
                switch (rand(1, 6)) {

                    case 1:
                        $message = 'Maybe.';
                        break;

                    case 2:
                        $message = 'Sure!';
                        break;

                    case 3:
                        $message = "I really don't care.";
                        break;
                    
                    case 4:
                        $message = "Of course not.";
                        break;

                    case 5:
                        $message = "Ask again.";
                        break;

                    case 6:
                        $message = "Screw you!";
                        break;
                    
                }
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


        $response = new JsonResponse($return);

        // cache
        $response->setPublic();

        $response->setSharedMaxAge(600000);
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }
}
