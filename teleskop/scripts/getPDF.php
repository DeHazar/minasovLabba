<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 24.05.2019
 * Time: 23:08
 */
require_once 'tfpdf.php';
require_once 'database_connection.php';

$check_id = $_REQUEST['checkId'];
$getCheckQuery = "SELECT * FROM checks WHERE id =".$check_id;
$result = $link ->query($getCheckQuery);
$checkInfo = $result ->fetch_array();

$productsId = explode(';',$checkInfo['productsId']);
array_pop($productsId);
$productsName = explode(';',$checkInfo['productsNames']);
array_pop($productsName);
$counts = explode(';',$checkInfo['counts']);
array_pop($counts);

$address = $checkInfo['address'];
$date = $checkInfo['date'];
$sum = $checkInfo['sum'];

$productsPrice =[];
for ($i = 0; $i < count($productsId); $i++) {
    $query = "SELECT price FROM products WHERE id=".$productsId[$i];
    $productsPrice[$i] = $link->query($query)->fetch_array()['price'];
}

$user_id = $checkInfo['user_id'];
$userQuery = "SELECT * FROM users WHERE id=".$user_id;
$res = $link ->query($userQuery)->fetch_array();

class PDF_reciept extends tFPDF {
    function __construct ($orientation = 'P', $unit = 'pt', $size = 'Letter') {
        parent::__construct($orientation, $unit, $size);
        $this->SetTopMargin(40);
        $this->SetLeftMargin(40);
        $this->SetRightMargin(40);
        $this->SetAutoPageBreak(true, 40);
    }


    function Header() {
        $this->AddFont('DejaVu','','DejaVuSans.ttf',true);
        $this->SetFillColor(36, 96, 84);
        $this->SetTextColor(225);
        $this->SetFont('DejaVu','',18);
        $this->Cell(0, 30, "Телескопы Хаббла", 0, 1, 'C', true);
    }

    function Footer() {
        $this->AddFont('DejaVu','','DejaVuSans.ttf',true);
        $this->SetTextColor(0);
        $this->SetXY(0,-60);
        $this->SetFont('DejaVu','',14);
        $this->Cell(0, 20, "Спасибо за покупку в Телескопы Хаббла!", 'T', 0, 'C');
    }

    function PriceTable($products, $prices, $counts, $sum) {
        $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $this->SetTextColor(0);
        $this->SetFillColor(36, 140, 129);
        $this->SetLineWidth(1);
        $this->Cell(360, 25, "Название", 'LTR', 0, 'C', true);
        $this->Cell(50, 25, "Кол-во", 'LTR', 0, 'C', true);
        $this->Cell(127, 25, "Цена", 'LTR', 1, 'C', true);
        $this->SetFont('DejaVu','',14);
        $this->SetFillColor(238);
        $this->SetLineWidth(0.2);
        $fill = false;
        for ($i = 0; $i < count($products); $i++) {
            $this->Cell(360, 20, $products[$i], 1, 0, 'L', $fill);
            $this->Cell(50, 20, $counts[$i], 1, 0, 'R', $fill);
            $this->Cell(127, 20,  $prices[$i].'руб.' , 1, 1, 'R', $fill);
            $fill = !$fill;
        }
        $this->SetX(350);
        $this->Cell(100, 20, "Всего", 1);
        $this->Cell(127, 20, $sum.'рублей', 1, 1, 'R');
    }
}

$pdf = new PDF_reciept();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
$pdf->SetFont('DejaVu','',14);
$pdf->SetY(100);

$pdf->Cell(100, 13, "По заказу");
$pdf->Cell(200, 13, $res['last_name']." ".$res['first_name']." ".$res['middle_name']);

$pdf->Cell(100, 13, 'Дата заказа');
$pdf->Cell(100, 13, $date, 0, 1);

$pdf->SetX(140);
$pdf->Cell(200, 20, substr($address,0,strpos($address,'Индекс')), 0, 2);
$pdf->Cell(200, 20, substr($address,strpos($address,'Индекс')), 0, 2);
$pdf->Ln(100);

$pdf->PriceTable($productsName, $productsPrice, $counts,$sum);
$pdf->Ln(10);
$pdf->Cell(200, 20, "Доставка в течение 2-14 дней", 0, 2);
$pdf->Ln(40);

$message = "Спасибо за покупку в нашем магазине";
$pdf->MultiCell(0, 15, $message);

$pdf->SetFont('Arial', 'U', 12);
$pdf->SetTextColor(1, 162, 232);
$pdf->Write(13, "telescopehubble@gmail.com", "mailto:example@example.com");

$pdf->Output('check.pdf', 'D');