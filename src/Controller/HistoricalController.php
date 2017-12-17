<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 10:03
 */

namespace App\Controller;

use App\Entity\Historical;
use App\Entity\Symbol;
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
        }

        $viewData['form'] = $form->createView();

        return $this->render('historical/index.html.twig', $viewData);
    }

    public function sendEmail()
    {

    }
}