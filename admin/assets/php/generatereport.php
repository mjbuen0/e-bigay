<?php 
require_once('config.php');
require_once('../vendor/tcpdf/tcpdf.php');

if (isset($_POST['generateReport'])) {
    $month = date('m', strtotime($_POST['month']));
    $year = date('Y', strtotime($_POST['year']));

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

        //Page header
        public function Header() {
            // Logo
            $image_file = '../img/imagetemplate.jpg';
            $this->Image($image_file, 0, 0, 210, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            // $this->SetFont('helvetica', 'B', 20);
            // Title
            // $this->Cell(0, 50, 'E-Bigay', 'B', 1, 'C', 0, '', 0, false, 'M', 'M');

        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Our Code World');
    $pdf->SetTitle('Example Write Html');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // remove default header/footer
    $pdf->setPrintHeader(true);
    $pdf->setPrintFooter(true);


    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    $pdf->SetMargins(15, 50, 15, true);
    // add a page
    $pdf->AddPage();

    $html = '
    
    <h3 style="text-align:center; font-size:16px; font-weight: bold;">Monthly report: '.$_POST['month'].' '.$year.'</h3>
    <table border="1px">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="text-align:center; font-weight: bold;">Transaction ID</th>
                <th scope="col" style="text-align:center; font-weight: bold;">Account ID</th>
                <th scope="col" style="text-align:center; font-weight: bold;">Name</th>
                <th scope="col" style="text-align:center; font-weight: bold;">Date Claimed</th>
            </tr>
        </thead>
        <tbody id="claimed-donation-table-body">
            
        ';

    // $sql = "SELECT id, id = (SELECT T.acc_id FROM transaction T WHERE T.acc_id = R.id AND status = 'Pending'), name, email, address, phone FROM registered_accounts R";
    // $sql = "SELECT * FROM transactiontable WHERE `status` = 'Claimed'";
    $sql = "SELECT transac_id, acc_id, name, date_claimed FROM transactiontable WHERE status = 'Claimed' AND EXTRACT(YEAR FROM date_claimed) = '$year' AND EXTRACT(MONTH FROM date_claimed) = '$month'";
    $res = mysqli_query($con, $sql );
    if (mysqli_num_rows($res) > 0) {
        while($row=mysqli_fetch_array($res)){
            $html .= '
            <tr>
                <td>'.$row['transac_id'].'</td>
                <td>'.$row['acc_id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['date_claimed'].'</td>
            </tr>';
        }
    } else {
        $html .= '
        <tr>
            <td colspan="4">There is no data in chosen month or year</td>
        </tr>';
    }

    $html .= '</tbody>
    </table>';

    $pdf->writeHTML($html, true, 0, true, 0);
    // add a page
    // $pdf->AddPage();

    // $html = '<h1>Hey</h1>';
    // output the HTML content
    // $pdf->writeHTML($html, true, false, true, false, '');

    // reset pointer to the last page
    $pdf->lastPage();
    //Close and output PDF document
    $pdf->Output('E-bigay_Summary_of_Reports_'.$_POST['month'].'-'.$year.'.pdf', 'I');
}
?>