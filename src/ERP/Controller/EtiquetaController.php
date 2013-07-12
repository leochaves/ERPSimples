<?php

namespace ERP\GameBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Etiqueta controller.
 *
 * @Route("/etiqueta")
 */
class EtiquetaController extends Controller {

    /**
     * Monta o formulário que receberá o endereço no padrão 
     * mercado livre... 
     *
     * @Route("/", name="etiqueta")
     * @Method({"GET", "POST"})
     * @Template("ERPGameBundle:Etiqueta:index.html.twig")
     */
    public function indexAction(Request $request) {

        $dados = array();
        $form = $this->createFormBuilder($dados)->add('msg', 'textarea')->getForm();        
       	
        if ($request->isMethod('POST')) {
            $form->bind($request);

            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            
            $dados = $this->parseEndereco($data['msg']);
            
        }

        return array(     
            'dados' => $dados,
            'form'   => $form->createView(),
        );
        
    }
    
    private function parseEndereco($endereco) {
    	
    	$endereco = quoted_printable_decode($endereco);
  /*
   *   2 => 
    array (size=10)
      0 => string 'BRUCIOCCIA' (length=10)
      1 => string 'Bruno Cioccia' (length=13)
      2 => string '11 22410585' (length=11)
      3 => string 'cioccia@hotmail.com' (length=19)
      4 => string 'Bruno Cioccia' (length=13)
      5 => string 'Avenida Zumkeller 933   ap 14 bl B' (length=34)
      6 => string '02420001' (length=8)
      7 => string 'São Paulo' (length=9)
      8 => string 'São Paulo' (length=9)
      9 => string 'Brasil' (length=6)
   */
    	preg_match_all('(<strong>(.*?)<\/strong>(.*?)(<br[/]*>)+)',$endereco,$encontrados);

    	$dados = array(
    			'nome_destinatario' => utf8_encode($encontrados[2][1]),
    			'endereco' => utf8_encode($encontrados[2][5]),
    			'cep' => utf8_encode($encontrados[2][6]),
    			'bairro_cidade' => utf8_encode($encontrados[2][7]),
    	);
    	

    	return $dados;
    	
    }

}
