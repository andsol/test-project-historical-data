<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 10:03
 */

namespace App\Controller;

use App\Entity\Historical;
use App\Entity\HistoricalEmail;
use App\Entity\Symbol;
use App\Form\EmailForm;
use App\Form\HistoricalForm;
use App\Gateway\SymbolDataGatewayInterface;
use App\Gateway\SymbolGatewayInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoricalController extends Controller
{
    private $dataGateway;
    private $symbolGateway;

    public function __construct(SymbolDataGatewayInterface $dataGateway, SymbolGatewayInterface $symbolGateway)
    {
        $this->dataGateway = $dataGateway;
        $this->symbolGateway = $symbolGateway;
    }

    public function indexAction(Request $request)
    {
        $viewData = [];

        $historical = new Historical();
        $historical->setStartDate(new \DateTime());
        $historical->setEndDate(new \DateTime());

        $form = $this->createForm(HistoricalForm::class, $historical);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historical = $form->getData();

            $symbols = $this->symbolGateway->fetchAll();
            $viewData['symbol'] = $symbols[$historical->getSymbol()]->toArray();

            $symbolData = $this->dataGateway->fetch(
                $historical->getSymbol(),
                $historical->getStartDate(),
                $historical->getEndDate()
            );

            $arrayData = [];
            foreach ($symbolData as $row) {
                $arrayData[] = $row->toArray();
            }

            $viewData['symbolData'] = $arrayData;

            $json = [];
            $json[] = ['Date', 'Open price', 'Close price'];
            foreach ($arrayData as $row) {
                $json[] = [$row['date'], $row['open'], $row['close']];
            }

            $viewData['symbolDataJson'] = $json;

            $historicalEmail = new HistoricalEmail();
            $historicalEmail->setSymbol($historical->getSymbol());
            $historicalEmail->setStartDate($historical->getStartDate());
            $historicalEmail->setEndDate($historical->getEndDate());

            $emailForm = $this->createForm(EmailForm::class, $historicalEmail);
            $viewData['emailForm'] = $emailForm->createView();

        } else {
            $viewData['symbol'] = null;
            $viewData['symbolData'] = null;
            $viewData['symbolDataJson'] = null;
            $viewData['emailForm'] = null;
        }

        $viewData['form'] = $form->createView();

        return $this->render('historical/index.html.twig', $viewData);
    }

    public function emailAction(Request $request, \Swift_Mailer $mailer)
    {
        $historicalEmail = new HistoricalEmail();
        $historicalEmail->setStartDate(new \DateTime());
        $historicalEmail->setEndDate(new \DateTime());
        $form = $this->createForm(EmailForm::class, $historicalEmail);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $historicalEmail = $form->getData();

            $symbols = $this->symbolGateway->fetchAll();
            $symbol = $symbols[$historicalEmail->getSymbol()];

            $message = (new \Swift_Message($symbol->getName()))
                ->setFrom($historicalEmail->getEmail())
                ->setTo($historicalEmail->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/historical.html.twig',
                        [
                            'from' => $historicalEmail->getStartDate()->format('M d, Y'),
                            'to' => $historicalEmail->getEndDate()->format('M d, Y'),
                        ]
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            return $this->redirect('/historical');

        } else {
            $this->redirect('/historical');
        }
    }
}