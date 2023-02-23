<?php

namespace App\Controller;


use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Builder\Class_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\PizzaBestellung;
use Psr\Log\LoggerInterface;



#[Route('/pizza_bestellung')]
class PizzaBestellungController extends AbstractController
{
    #[Route('/', name: 'pizza_bestellung_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $pizzabestellungen = $doctrine->getRepository(PizzaBestellung::class)->findAll();

        return $this->render('pizza_bestellung/index.html.twig', [
            'pizzabestellungen' => $pizzabestellungen,
            'groesseOptions' => PizzaBestellung::getDieGroesse(),
            'zustellungOptions' => PizzaBestellung::getZustellungsOptions(),
        ]);
    }

    private function buildForm($pizzabestellung){
        return $this->createFormBuilder($pizzabestellung)
            ->add('name', TextType::class)
            ->add('address', TextareaType::class)
            ->add('telefon', TextType::class)
            ->add('email', TextType::class)
            ->add('groesse', ChoiceType::class,[
                'choices' => array_flip(PizzaBestellung::getDieGroesse())
            ])
            ->add('zustellung', ChoiceType::class, [
                'choices' => array_flip(PizzaBestellung::getZustellungsOptions())
            ])
            ->add('save', SubmitType::class)
            ->getForm();
    }


    #[Route('/new', name: 'pizza_bestellung_new')]
    public function newPizzaBestellung(Request $request, ManagerRegistry $doctrine): Response
    {
        $pizzabestellung = new PizzaBestellung();
        $form = $this -> buildForm($pizzabestellung);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $pizzabestellung = $form -> getData();
            $em = $doctrine->getManager();
            $em->persist($pizzabestellung);
            $em->flush();
            return $this->redirectToRoute('pizza_bestellung_index');
        }

        return $this->render('pizza_bestellung/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'pizza_bestellung_edit')]
    public function editPizzaBestellung($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $pizzabestellung = $doctrine->getRepository(PizzaBestellung::class)->find($id);
        if($pizzabestellung){
            $form = $this -> buildForm($pizzabestellung);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $pizzabestellung = $form -> getData();
                $em = $doctrine->getManager();
                $em->flush();
                return $this->redirectToRoute('pizza_bestellung_index');
            }
            return $this->render('pizza_bestellung/new.html.twig', [
                'form' => $form,
            ]);
        }
        return $this->redirectToRoute('pizza_bestellung_index');
    }

    #[Route('/delete/{id}', name: 'pizza_bestellung_delete')]
    public function deletePizzaBestellung($id, ManagerRegistry $doctrine): Response
    {
        $issue = $doctrine->getRepository(PizzaBestellung::class)->find($id);
        if ($issue){
            $em = $doctrine->getManager();
            $em->remove($issue);
            $em->flush();
        }
        return $this->redirectToRoute('pizza_bestellung_index');
    }
}
