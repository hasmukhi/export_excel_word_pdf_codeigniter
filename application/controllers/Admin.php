<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller 
{
	public function __construct() 
  	{
	    parent::__construct(); 
    	$this->load->model('AdminModel');
  	}
  	public function index()
  	{
  		//GEt State Data
		$data['states']=$this->AdminModel->fetch_state();
		$this->load->view('admin/manage_state',$data);
	}
	/*public function manage_state()
	{
		
		//GEt State Data
		$data['states']=$this->AdminModel->fetch_state();
		//$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/manage_state',$data);
		//$this->load->view('admin/includes/footer',$data);
		
	}*/
	//State export csv
	public function state_export_csv()
	{
		
		header('Content-Type: application/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=state' . date("Ymd") . '_' . time() . '.csv');
        header('Pragma: no-cache');

        if (isset($_POST['csv'])) {             
        }

        $export_state_data = $this->AdminModel->fetch_state();
		
        
        if (!empty($export_state_data)) {
            $output = fopen('php://output', 'w');

            $table_header_data = $this->db->list_fields('state');
            $table_headers = array();
            foreach ($table_header_data as $key => $val) {
                array_push($table_headers, $val);
            }
            fputcsv($output, $table_headers);
			foreach ($export_state_data as $row) {
				//print_r($row);                    
				
                // fputcsv($output, $row);
                fputcsv($output, $row);
            }
            fclose($output);
        } else {
            echo "RECORD NOT FOUND";
        }
		
    }
	//End State Export CSV
	//State Export Excel
	public function state_export_excel()
    {	
    	
		header("Content-Type: application/xls; charset=utf-8;");
        header('Content-Disposition: attachment; filename=state' . date("Ymd") . '_' . time() . '.xls');
        header('Pragma: no-cache');
        if (isset($_POST['excl'])) {
        }
		//get state data
        $data['states']=$this->AdminModel->fetch_state();
		if (empty($data['states'])) {
			echo "RECORD NOT FOUND";
		} else {
			$this->load->view('admin/state_export_table', $data);
		}
    	
    }
	//End State Export Excel
	//State Export Word
	public function state_export_word()
    {
    	
        header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=state" . date("Ymd") . '_' . time() . ".doc"); 
        header('Pragma: no-cache');
        //get state data
        $data['states']=$this->AdminModel->fetch_state();
		if (empty($data['states'])) {
			echo "RECORD NOT FOUND";
		} else {
			$this->load->view('admin/state_word', $data);
		}
    	
    }
	//End State Export Word
	//State Export PDF
	public function state_export_pdf() 
  	{
		
		$data = array();            
		$htmlContent='';
		//get state data
		$data['states']=$this->AdminModel->fetch_state();
		if (empty($data['states'])) {
			echo "RECORD NOT FOUND";
		} else {
			$htmlContent = $this->load->view('admin/state_pdf', $data, TRUE);       
			$createPDFFile = "state" . date("Ymd") . '_' . time().'.pdf';
			$this->createPDF(ROOT_FILE_PATH.$createPDFFile, $htmlContent);
		}
		
    }
	//End State Export PDF
	
	//---------------------- TCPDF Function For Creating Pdf ----------------------//
	public function createPDF($fileName,$html) 
    {
	    ob_start(); 
	    // Include the main TCPDF library (search for installation path).
	    $this->load->library('Pdf');
	    // create new PDF document
	    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	    // set document information
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('Olway Software');
	    $pdf->SetTitle('PDF');
	    $pdf->SetSubject('Olway Software');
	    $pdf->SetKeywords('Olway,Software,PDF');

	    // set default header data
	    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

	    // set header and footer fonts
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	    
	    $pdf->SetPrintHeader(false);
	    $pdf->SetPrintFooter(false);

	    // set default monospaced font
	    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	    // set margins
	    $pdf->SetMargins(PDF_MARGIN_LEFT, 6, PDF_MARGIN_RIGHT);
	    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	    // set auto page breaks
	    //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	    $pdf->SetAutoPageBreak(TRUE, 0);

	    // set image scale factor
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	    // set some language-dependent strings (optional)
	    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	        require_once(dirname(__FILE__).'/lang/eng.php');
	        $pdf->setLanguageArray($l);
	    }       

	    // set font
	    $pdf->SetFont('dejavusans', '', 10);

	    // add a page
	    $pdf->AddPage();

	    // output the HTML content
	    $pdf->writeHTML($html, true, false, true, false, '');

	    // reset pointer to the last page
	    $pdf->lastPage();       
	    ob_end_clean();
	    //Close and output PDF document
	    $pdf->Output($fileName, 'I');
    }
}
