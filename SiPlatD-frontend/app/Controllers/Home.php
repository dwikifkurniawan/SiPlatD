<?php

namespace App\Controllers;


use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Controller;
use App\ThirdParty\FPDF;


class Home extends BaseController
{
	public function __construct()
	{
	}

	public function index()
	{
		return view('index');
	}
	public function manufacture()
	{
		return view('manufacture');
	}
	public function master_material()
	{
		return view('admin/master-data/material');
	}
	public function master_product()
	{
		return view('admin/master-data/product');
	}
	public function report_material()
	{
		return view('admin/report/material');
	}
	public function report_product()
	{
		return view('admin/report/product');
	}
	public function report_transaction()
	{
		return view('admin/report/transaction');
	}
	public function user()
	{
		return view('admin/user/user');
	}
	public function warehouse_material()
	{
		return view('admin/warehouse/material');
	}
	public function warehouse_product()
	{
		return view('admin/warehouse/product');
	}
	public function transaction()
	{
		return view('kasir/transaction');
	}
	public function r_transaction()
	{
		return view('kasir/r_trans');
	}
	public function generate_trans()
	{
		return view('kasir/generate_trans');
	}

	public function login()
	{
		return view('login');
	}

	public function cek_login()
	{
		$session = session();
		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		if ($username == "admin" && $password == "admin") {
			$data = [
				'user' => $username,
				'pswd' => $password
			];
			$session->set($data);
			return redirect()->to(base_url('Home/index'));
		}
		if ($username == "owner" && $password == "owner") {
			$data = [
				'user' => $username,
				'pswd' => $password
			];
			$session->set($data);
			return redirect()->to(base_url('Home/index'));
		}
		if ($username == "kasir" && $password == "kasir") {
			$data = [
				'user' => $username,
				'pswd' => $password,
				'id' => "5a6ec2e0-0c01-4c1e-8624-0cb0929cbe56",
				'prod' => 0
			];
			$session->set($data);
			return redirect()->to(base_url('Home/transaction'));
		}
	}
	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('Home/login'));
	}


	
	// 
	// Create Function
	// 
	public function create_product(){
		$api_url = "http://localhost:3000/products";

		$product = array(
			"name" => $_POST["product"],
			"description" => $_POST["description"],
			"category" => $_POST["category"],
			"price" => intval($_POST["price"]),
			"material_id" => $_POST["material"],
			"stock_quantity" => $_POST["stock_quantity"]
		);
		// print(json_encode($manufacture));

		$ch = curl_init($api_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code === 422) {
    
			echo "Invalid data: ";
			print_r($data["errors"]);
			exit;
		}
		
		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}
		
		return redirect()->to(base_url('home/warehouse_product'));
	}

	public function create_manufacture(){
		$api_url = "http://localhost:3000/manufactures";
		
		$manufacture = array(
			"type" => $_POST["type"],
			"date" => $_POST["date"],
			"status" => $_POST["status"],
			"quantity" => intval($_POST["quantity"]),
			"material_id" => $_POST["material"],
			"product_id" => $_POST["product"]
		);
		$manufacture_json = json_encode(array("manufacture" => $manufacture));
		// print(json_encode($manufacture));

		$ch = curl_init($api_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($manufacture));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code === 422) {
    
			echo "Invalid data: ";
			print_r($data["errors"]);
			exit;
		}
		
		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}

		return redirect()->to(base_url('home/manufacture'));
	}

	public function create_user(){
		$api_url = "http://localhost:3000/users";

		$user = array(
			"firstName" => $_POST["name"],
			"email" => $_POST["email"],
			"username" => $_POST["username"],
			"role" => $_POST["role"],
			"password" => $_POST["password"],
			"lastName" => $_POST["name"]
		);
		// print(json_encode($manufacture));

		$ch = curl_init($api_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($user));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code === 422) {
    
			echo "Invalid data: ";
			print_r($data["errors"]);
			exit;
		}
		
		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}
		return redirect()->to(base_url('home/user'));
	}

	public function create_material(){
		$api_url = "http://localhost:3000/materials";

		$user = array(
			"name" => $_POST["name"],
			"category" => $_POST["category"],
			"description" => $_POST["description"]
		);
		// print(json_encode($manufacture));

		$ch = curl_init($api_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($user));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code === 422) {
    
			echo "Invalid data: ";
			print_r($data["errors"]);
			exit;
		}
		
		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}
		return redirect()->to(base_url('home/warehouse_material'));
	}

	public function create_transaction(){
		session();
		$api_url = "http://localhost:3000/transactions";
		$totalprice = 0;

		// Generating invoice
		ob_start();
		// require('/app/ThirdParty/FPDF.php');
		$totalprice = 0;
		$pdf = new FPDF();
		$pdf->SetTitle("Test");
		$pdf->AliasNbPages();
		$pdf->AddPage();

		//set font to arial, bold, 14pt
		$pdf->SetFont('Arial','B',14);

		//Cell(width , height , text , border , end line , [align] )

		$pdf->Cell(130 ,5,'Plat D Konveksi',0,0);
		$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

		//set font to arial, regular, 12pt
		$pdf->SetFont('Arial','',12);

		$pdf->Cell(130 ,5,'3G5R+CM3, Nanjung, Margaasih',0,0);
		$pdf->Cell(59 ,5,'',0,1);//end of line

		$pdf->Cell(130 ,5,'Bandung Regency, West Java 40215',0,0);
		date_default_timezone_set('Asia/Jakarta');
		$date = date("d-m-Y H:i:s");
		$pdf->Cell(25 ,5,'Date',0,0);
		$pdf->Cell(34 ,5, $date, 0,1);//end of line

		$pdf->Cell(130 ,5,'087780451708',0,0);
		$pdf->Cell(25 ,5,'Invoice',0,0);
		$pdf->Cell(34 ,5,'# 7389553',0,1);//end of line

		$pdf->Cell(25 ,5,'Cashier',0,0);
		$pdf->Cell(34 ,5,'Dwiki',0,1);//end of line

		//make a dummy empty cell as a vertical spacer
		$pdf->Cell(189 ,10,'',0,1);//end of line

		//billing address
		// $pdf->Cell(100 ,5,'Bill to',0,1);//end of line

		// //add dummy cell at beginning of each line for indentation
		// $pdf->Cell(10 ,5,'',0,0);
		// $pdf->Cell(90 ,5,'[Name]',0,1);

		// $pdf->Cell(10 ,5,'',0,0);
		// $pdf->Cell(90 ,5,'[Company Name]',0,1);

		// $pdf->Cell(10 ,5,'',0,0);
		// $pdf->Cell(90 ,5,'[Address]',0,1);

		// $pdf->Cell(10 ,5,'',0,0);
		// $pdf->Cell(90 ,5,'[Phone]',0,1);

		//make a dummy empty cell as a vertical spacer
		$pdf->Cell(189 ,10,'',0,1);//end of line

		//invoice contents
		$pdf->SetFont('Arial','B',12);

		$pdf->Cell(130 ,5,'Item',1,0);
		$pdf->Cell(25 ,5,'Total',1,0);
		$pdf->Cell(34 ,5,'Price',1,1);//end of line

		$pdf->SetFont('Arial','',12);

		//Numbers are right-aligned so we give 'R' after new line parameter

		for($i = 0; $i < $_SESSION['prod']; $i++):
			$transaction = array(
				"description" => "Paid off",
				"item_total" => $_SESSION["prod{$i}"]["amount"],
				"price_total" => $_SESSION["prod{$i}"]["price"] * $_SESSION["prod{$i}"]["amount"],
				"product_id" => $_SESSION["prod{$i}"]["product_id"],
				"cashier_id" => $_SESSION["id"]
			);
			print(json_encode($transaction));
	
			$ch = curl_init($api_url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($transaction));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	
			$response = curl_exec($ch);
	
			$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
			curl_close($ch);
	
			$data = json_decode($response, true);
	
			if ($status_code === 422) {
		
				echo "Invalid data: ";
				print_r($data["errors"]);
				exit;
			}
			
			if ($status_code !== 200) {
				
				echo "Unexpected status code: $status_code";
				var_dump($data);    
				exit;
			}

			$totalprice = $totalprice + ($_SESSION["prod{$i}"]["price"] * $_SESSION["prod{$i}"]["amount"]);
			$pdf->Cell(130 ,5, $_SESSION["prod{$i}"]["name"],1,0);
			$pdf->Cell(25 ,5, $_SESSION["prod{$i}"]["amount"],1,0);
			$pdf->Cell(34 ,5, $_SESSION["prod{$i}"]["price"] * $_SESSION["prod{$i}"]["amount"], 1,1,'R');//end of line
			
			unset($_SESSION["prod{$i}"]["product_id"]);
			unset($_SESSION["prod{$i}"]["name"]);
			unset($_SESSION["prod{$i}"]["type"]);
			unset($_SESSION["prod{$i}"]["size"]);
			unset($_SESSION["prod{$i}"]["amount"]);
			unset($_SESSION["prod{$i}"]["price"]);
			unset($_SESSION["prod{$i}"]);
			// print(json_encode($_SESSION));
		endfor;

		//summary
		$pdf->Cell(130 ,5,'',0,0);
		$pdf->Cell(25 ,5,'Subtotal',0,0);
		$pdf->Cell(8 ,5,'Rp',1,0);
		$pdf->Cell(26 ,5, $totalprice, 1,1,'R');//end of line

		$pdf->Cell(130 ,5,'',0,0);
		$pdf->Cell(25 ,5,'Discount',0,0);
		$pdf->Cell(8 ,5,'Rp',1,0);
		$pdf->Cell(26 ,5,'0',1,1,'R');//end of line

		// $pdf->Cell(130 ,5,'',0,0);
		// $pdf->Cell(25 ,5,'Tax Rate',0,0);
		// $pdf->Cell(4 ,5,'$',1,0);
		// $pdf->Cell(30 ,5,'10%',1,1,'R');//end of line

		$pdf->Cell(130 ,5,'',0,0);
		$pdf->Cell(25 ,5,'Total Due',0,0);
		$pdf->Cell(8 ,5,'Rp',1,0);
		$pdf->Cell(26 ,5,$totalprice,1,1,'R');//end of line

		$invoice_id = rand(1000000,9999999);
		$pdf->Output('D', "{$invoice_id}_{$date}". '.pdf');
		ob_end_flush(); 
		
		$_SESSION["prod"] = 0;
		print(json_encode($_SESSION));
		// return redirect()->to(base_url('home/transaction'));
		view('kasir/transaction');
	}



	// 
	// Delete Function
	// 

	public function delete_product(){
		$api_url = "http://localhost:3000/products/{$_GET['id']}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}

		return redirect()->to(base_url('home/warehouse_product'));
		
	}

	public function delete_user(){
		$api_url = "http://localhost:3000/users/{$_GET['id']}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}

		return redirect()->to(base_url('home/user'));
		
	}

	public function delete_manufacture(){
		$api_url = "http://localhost:3000/manufactures/{$_GET['id']}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}

		return redirect()->to(base_url('home/manufacture'));
		
	}

	public function delete_material(){
		$api_url = "http://localhost:3000/materials/{$_GET['id']}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}

		return redirect()->to(base_url('home/warehouse_material'));
	}

	public function delete_transaction(){
		$api_url = "http://localhost:3000/transactions/{$_GET['id']}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}

		return redirect()->to(base_url('home/generate_trans'));
	}

	public function delete_temp_transaction(){
		session();
		if($_GET['id'] == $_SESSION["prod"] - 1){
			unset($_SESSION["prod{$_GET['id']}"]["product_id"]);
			unset($_SESSION["prod{$_GET['id']}"]["name"]);
			unset($_SESSION["prod{$_GET['id']}"]["type"]);
			unset($_SESSION["prod{$_GET['id']}"]["size"]);
			unset($_SESSION["prod{$_GET['id']}"]["amount"]);
			unset($_SESSION["prod{$_GET['id']}"]["price"]);
			unset($_SESSION["prod{$_GET['id']}"]);
		}
		else{
			for($i = $_GET['id']; $i < $_SESSION["prod"]-1; $i++){
				// unset
				unset($_SESSION["prod{$i}"]["product_id"]);
				unset($_SESSION["prod{$i}"]["name"]);
				unset($_SESSION["prod{$i}"]["type"]);
				unset($_SESSION["prod{$i}"]["size"]);
				unset($_SESSION["prod{$i}"]["amount"]);
				unset($_SESSION["prod{$i}"]["price"]);
				unset($_SESSION["prod{$i}"]);
				
				// set
				$j = $i+1;
				$_SESSION["prod{$i}"] = array(
					"product_id" => $_SESSION["prod{$j}"]["product_id"],
					"name" => $_SESSION["prod{$j}"]["name"],
					"type" => $_SESSION["prod{$j}"]["type"],
					"size" => $_SESSION["prod{$j}"]["size"],
					"amount"=> $_SESSION["prod{$j}"]["amount"],
					"price"=> $_SESSION["prod{$j}"]["price"]
				);
			}
		}

		$_SESSION["prod"] = $_SESSION["prod"] - 1;

		return redirect()->to(base_url('home/transaction'));
	}

	public function add_transaction()
	{
		$session = session();
		// print(json_encode($session->get()));
		$data = $session->get();
		// print(json_encode($_POST));

		$api_url = "http://localhost:3000/products/{$_POST['product']}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_data = curl_exec($ch);
		$response_data = json_decode($curl_data);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

		curl_close($ch);

		$_SESSION["prod{$_SESSION['prod']}"] = array(
			"product_id" => $response_data->id,
			"name" => $response_data->name,
			"type" => $_POST["type"],
			"size" => $_POST["size"],
			"amount"=> $_POST["amount"],
			"price"=> $response_data->price
		);
		$_SESSION['prod'] = $_SESSION['prod'] + 1;
		// $data = array_merge($data, $arr);
		// print(json_encode($result));
		print(json_encode($_SESSION));
		return redirect()->to(base_url('home/transaction'));
	}

	public function generate_material(){
        $api_url = 'http://localhost:3000/materials';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        $curl_data = curl_exec($curl_handle);
        curl_close($curl_handle);
        $response_data = json_decode($curl_data);

        $title = $_POST['report_name'];
        $date = $_POST['daterange'];

        $pdf = new FPDF();
        $pdf->SetTitle("{$title} - {$date}");
        $pdf->AliasNbPages();
        $pdf->AddPage();
		// Arial bold 15
		$pdf->SetFont('Arial','B',15);
		// Move to the right
		$pdf->Cell(80);
		// Title
		$pdf->Cell(30,10, "Report {$title}", 0,0,'C');
		// Line break
		$pdf->Ln(20);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(0,10,$date, 0,1,'C');
        $pdf->Cell(50,10,'Nama', 0,'L');
        $pdf->Cell(50,10,'kategori', 0,1,'L');
        foreach ($response_data as $material):
            $pdf->Cell(50,10,$material->name,0,0);
            $pdf->Cell(50,10,$material->category,0,1);
        endforeach;
        $pdf->Output('D', "{$title}_{$date}". '.pdf');
		// $pdf->Output('I', $title. '.pdf');
		// return redirect()->to(base_url('home/warehouse_material'));
    }

	public function generate_transaction(){
        $api_url = 'http://localhost:3000/transactions';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        $curl_data = curl_exec($curl_handle);
        curl_close($curl_handle);
        $response_data = json_decode($curl_data);

        $title = $_POST['report_name'];
        $date = $_POST['daterange'];

        $pdf = new FPDF();
        $pdf->SetTitle("{$title} - {$date}");
        $pdf->AliasNbPages();
        $pdf->AddPage();
		// Arial bold 15
		$pdf->SetFont('Arial','B',15);
		// Move to the right
		$pdf->Cell(80);
		// Title
		$pdf->Cell(30,10, "Report Transaksi {$title}", 0,0,'C');
		// Line break
		$pdf->Ln(20);
		$pdf->Cell(0,10,$date, 0,1,'C');
		$pdf->Cell(189 ,10,'',0,1);//end of line

		//report contents
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(38 ,5,'Item',1,0);
		$pdf->Cell(38 ,5,'Total',1,0);
		$pdf->Cell(38 ,5,'Price',1,0);
		$pdf->Cell(38 ,5,'Created At',1,0);
		$pdf->Cell(38 ,5,'Cashier',1,1);//end of line
		$pdf->SetFont('Arial','',12);
        // $pdf->Cell(0,10,$date, 0,1,'C');
        // $pdf->Cell(50,10,'Nama', 0,'L');
        // $pdf->Cell(50,10,'kategori', 0,1,'L');
        foreach ($response_data as $transaksi):
			$date = $transaksi->created_at;
			$day = substr($date,8,2);
			$month = substr($date,5,2);
			$year = substr($date,0,4);
			$createdDate = $day."/".$month."/".$year;

			$conv = number_format($transaksi->price_total, 0, ",", ".");
			$price = "Rp. {$conv}";
			
            $pdf->Cell(38,5,$transaksi->product->name,1,0);
			$pdf->Cell(38,5,$transaksi->item_total,1,0);
			$pdf->Cell(38,5, $price, 1,0);
			$pdf->Cell(38,5,$createdDate,1,0);
            $pdf->Cell(38,5,$transaksi->cashier->firstName,1,1,'L');
        endforeach;
        $pdf->Output('D', "{$title}_Transaksi_{$date}". '.pdf');
		// $pdf->Output('I', $title. '.pdf');
		// return redirect()->to(base_url('home/warehouse_material'));
    }


	// edit
	public function edit_manufacture(){
		$api_url = "http://localhost:3000/manufactures/{$_POST['selectedID']}";
		$manufacture = array(
			"type" => $_POST["type"],
			"status" => $_POST["status"],
			"quantity" => intval($_POST["quantity"]),
			"material_id" => $_POST["material"],
			"product_id" => $_POST["product"]
		);
		$manufacture_json = json_encode(array("manufacture" => $manufacture));
		// print(json_encode($manufacture));

		$ch = curl_init($api_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($manufacture));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code === 422) {
    
			echo "Invalid data: ";
			print_r($data["errors"]);
			exit;
		}
		
		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}

		return redirect()->to(base_url('home/manufacture'));
	}

	public function edit_product(){
		$api_url = "http://localhost:3000/products/{$_POST['id']}";

		$product = array(
			"name" => $_POST["product"],
			"description" => $_POST["description"],
			"category" => $_POST["category"],
			"price" => intval($_POST["price"]),
			"material_id" => $_POST["material"],
			"stock_quantity" => $_POST["stock_quantity"]
		);
		// print(json_encode($manufacture));

		$ch = curl_init($api_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		$response = curl_exec($ch);

		$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
		curl_close($ch);

		$data = json_decode($response, true);

		if ($status_code === 422) {
    
			echo "Invalid data: ";
			print_r($data["errors"]);
			exit;
		}
		
		if ($status_code !== 200) {
			
			echo "Unexpected status code: $status_code";
			var_dump($data);    
			exit;
		}
		
		return redirect()->to(base_url('home/warehouse_product'));
		// print(json_encode($_POST));
	}
}

