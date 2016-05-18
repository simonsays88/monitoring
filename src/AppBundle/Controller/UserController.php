<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Pack;

class UserController extends Controller {

    /**
     * @Route("/utilisateurs", name="user_list")
     */
    public function listAction(Request $request) {
        $users = $this->getDoctrine()
                ->getRepository('AppBundle:Initial')
                ->findAll();

        return $this->render('AppBundle:User:list.html.twig', [
                    'users' => $users,
        ]);
    }

    /**
     * @Route("/utilisateurs/{user_id}", name="user", requirements={"user_id"="\d+"})
     */
    public function showAction(Request $request, $user_id) {
        $user = $this->getDoctrine()
                ->getRepository('AppBundle:Initial')
                ->findOneBy(array('userId' => $user_id));

        if ($user) {
            $resultExercises = $this->getDoctrine()
                    ->getRepository('AppBundle:ResultExercise')
                    ->getAllResultExercisesByUser($user);

            $performances = array();
            foreach ($resultExercises as $re) {
                $performances[$re->getExercise()->getName()][$re->getId()] = array($re->getRepetition(), $re->getValue(), $re->getExercise()->getUnit(), $re->getResult()->getCreatedAt());
            }
            // replace this example code with whatever you need
            return $this->render('AppBundle:User:show.html.twig', [
                        'user' => $user,
                        'performances' => $performances
            ]);
        } else {
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }
    }

    /**
     * @Route("/start-pack/{pack_id}", name="start_pack", requirements={"pack_id"="\d+"})
     */
    public function startPackAction(Request $request, $pack_id) {
        $em = $this->getDoctrine()->getManager();
        $pack = $this->getDoctrine()
                ->getRepository('AppBundle:Pack')
                ->findOneById($pack_id);

        $weekDay = date('w');
        $date = new \DateTime();
        if ($weekDay == 1) {
            $startAt = $date;
            $pack->setStatus(Pack::STATUS_ONGOING);
        } else {
            $ndDaysUntilNextMonday = 8 - $weekDay;
            $startAt = $date->add(new \DateInterval('P' . $ndDaysUntilNextMonday . 'D'));
        }
        $pack->setStartedAt($startAt);
        $em->flush();

        return $this->redirectToRoute('pack_index');
    }

    /**
     * @Route("/pause/{pack_id}", name="stop_pack", requirements={"pack_id"="\d+"})
     */
    public function stopPackAction(Request $request, $pack_id) {
        $em = $this->getDoctrine()->getManager();
        $pack = $this->getDoctrine()
                ->getRepository('AppBundle:Pack')
                ->findOneById($pack_id);

        $pack->setStatus(Pack::STATUS_PAUSE);
        $em->flush();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    /**
     * @Route("/reprendre/{pack_id}", name="resume_pack", requirements={"pack_id"="\d+"})
     */
    public function resumePackAction(Request $request, $pack_id) {
        $em = $this->getDoctrine()->getManager();
        $pack = $this->getDoctrine()
                ->getRepository('AppBundle:Pack')
                ->findOneById($pack_id);

        $pack->setStatus(Pack::STATUS_ONGOING);
        $em->flush();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

}
