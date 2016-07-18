<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Result;
use AppBundle\Form\Type\ResultType;
use AppBundle\Form\Type\TwoWeeksFoodType;
use AppBundle\Form\Type\FourWeeksFoodType;
use AppBundle\Form\Type\TwoWeeksFoodBodyType;
use AppBundle\Form\Type\FourWeeksFoodBodyType;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Pack;

class ResultsController extends Controller
{
    /**
     * @Route("/bilan/{resultId}", name="results", requirements={"resultId"="\d+"})
     */
    public function editAction(Request $request, $resultId)
    {
        $result = $this->getDoctrine()
            ->getRepository('AppBundle:Result')
            ->findOneById($resultId);
        
        if ($result) {
            if ($result->getResultType() == Result::ESTHETIC) {
                $initialPhotoFront = $result->getPhotoFront();
                $initialPhotoSide = $result->getPhotoSide();
                $initialPhotoBack = $result->getPhotoBack();
                $form = $this->createForm(ResultType::class, $result);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $result = $form->getData();

                    $dir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/photos';

                    if ($photoFront = $result->getPhotoFront()) {
                        $photoFrontName = md5(uniqid()) . '.' . $photoFront->guessExtension();
                        $photoFront->move($dir, $photoFrontName);
                        $result->setPhotoFront($photoFrontName);
                    } else {
                        $result->setPhotoFront($initialPhotoFront);
                    }
                    if ($photoSide = $result->getPhotoSide()) {
                        $photoSideName = md5(uniqid()) . '.' . $photoSide->guessExtension();
                        $photoSide->move($dir, $photoSideName);
                        $result->setPhotoSide($photoSideName);
                    } else {
                        $result->setPhotoSide($initialPhotoSide);
                    }
                    if ($photoBack = $result->getPhotoBack()) {
                        $photoBackName = md5(uniqid()) . '.' . $photoBack->guessExtension();
                        $photoBack->move($dir, $photoBackName);
                        $result->setPhotoBack($photoBackName);
                    } else {
                        $result->setPhotoBack($initialPhotoBack);
                    }

                    $result->setCompleted(true);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($result);
                    $em->flush();
                    
                    return $this->render('AppBundle:Results:success.html.twig');
                }
                return $this->render('AppBundle:Results:edit.html.twig', array(
                            'form' => $form->createView()
                ));
            } elseif ($result->getResultType() == Result::TWO_WEEKS_FOOD) {
                $form = $this->createForm(TwoWeeksFoodType::class, $result);
                $handleForm = $this->container->get('app.handle_form')->process($request, $form);
                if ($handleForm) {
                    return $this->render('AppBundle:Results:success.html.twig');
                }
                return $this->render('AppBundle:Results:weekFood.html.twig', array(
                            'form' => $form->createView()
                ));
            } elseif ($result->getResultType() == Result::FOUR_WEEKS_FOOD) {
                $form = $this->createForm(FourWeeksFoodType::class, $result);
                $handleForm = $this->container->get('app.handle_form')->process($request, $form);
                if ($handleForm) {
                    return $this->render('AppBundle:Results:success.html.twig');
                }
                return $this->render('AppBundle:Results:monthFood.html.twig', array(
                            'form' => $form->createView()
                ));
            } elseif ($result->getResultType() == Result::TWO_WEEKS_FOOD_BODY) {
                $form = $this->createForm(TwoWeeksFoodBodyType::class, $result);
                $handleForm = $this->container->get('app.handle_form')->process($request, $form);
                if ($handleForm) {
                    return $this->render('AppBundle:Results:success.html.twig');
                }
                return $this->render('AppBundle:Results:weekFoodBody.html.twig', array(
                            'form' => $form->createView()
                ));
            } elseif ($result->getResultType() == Result::FOUR_WEEKS_FOOD_BODY) {
                $form = $this->createForm(FourWeeksFoodBodyType::class, $result);
                $handleForm = $this->container->get('app.handle_form')->process($request, $form);
                if ($handleForm) {
                    return $this->render('AppBundle:Results:success.html.twig');
                }
                return $this->render('AppBundle:Results:weekFoodBody.html.twig', array(
                            'form' => $form->createView()
                ));
            }
        } else {
            return new Response('Bilan introuvable', 500);
        }
    }

    /**
     * @Route("/reply/{result_id}", name="reply", requirements={"result_id"="\d+"})
     */
    public function replyAction(Request $request, $result_id)
    {
        $em = $this->getDoctrine()->getManager();
        $result = $this->getDoctrine()->getRepository('AppBundle:Result')->findOneById($result_id);
        $result->setDone(1);
        $em->persist($result);
        $em->flush();
        
        $pack = $result->getPack();

        $email = ($pack->getPackType() == Pack::THEME) ? $this->container->getParameter('sender_themes') : $this->container->getParameter('sender_custom');
        $sujet = 'Coaching : David costa';
        $message = $this->container->get('templating')->render('AppBundle:Emails:reply.html.twig', array('text_reply' => $request->query->get('text_reply'), 'initial' => $pack->getInitial()));
        $destinataire = $pack->getInitial()->getEmail();
        $headers = "From: \"".$email."\"<".$email.">\n";
        $headers .= "Reply-To: ".$email."\n";
        $headers .= "Content-Type: text/plain; charset=\"utf-8\""." ";
        $headers .= 'Content-Transfer-Encoding: 8bit';
        mail($destinataire,$sujet,$message,$headers);
        $this->addFlash(
            'notice', 'Un message a été envoyé au client'
        );
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    /**
     * @Route("/done/{id}", name="result_done", requirements={"id"="\d+"})
     */
    public function doneAction(Request $request, $id)
    {
        $result = $this->getDoctrine()
            ->getRepository('AppBundle:Result')
            ->findOneById($id);
        if($result->getDone()){
            $result->setDone(0);
        } else{
            $result->setDone(1);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($result);
        $em->flush();
        return new Response();
    }

}
