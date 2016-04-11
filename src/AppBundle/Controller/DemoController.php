<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DemoController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request){
        $formDemo = $this->createFormBuilder()
            ->add('name', TextType::class, array(
                'label' => 'Name',
                'required' => false,

            ))
            ->add('city', ChoiceType::class, array(
                'label' => 'City',
                'choices' => array(
                    'Paris' => 'paris',
                    'London' => 'london',
                    'Berlin' => 'berlin',
                    'Madrid' => 'madrid',
                )
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Save',
                'attr' => array(
                    'class' => 'btn btn-success btn-sm',
                )
            ))
            ->getForm()
        ;
        
        $formDemo->handleRequest($request);
        if($formDemo->isSubmitted() && $formDemo->isValid()){
            $data = $formDemo->getData();

            return $this->render('@App/Demo/display.html.twig', array(
                'city' => $data['city'],
            ));
            
        }


        return $this->render('AppBundle:Demo:index.html.twig', array(
            'formDemo' => $formDemo->createView()
        ));
    }
}
