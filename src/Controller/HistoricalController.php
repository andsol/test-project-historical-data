<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 10:03
 */

namespace App\Controller;

use App\Entity\Historical;
use App\Form\HistoricalForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoricalController extends Controller
{
    public function indexAction(Request $request)
    {
        $historical = new Historical();
        $historical->setStartDate(new \DateTime());
        $historical->setEndDate(new \DateTime());

        $form = $this->createForm(HistoricalForm::class, $historical);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            return $this->redirectToRoute('task_success');
        } else {

        }


        return $this->render('historical/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}