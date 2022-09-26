<?php
  include "session.php";
  require("../res/php/fpdf/fpdf.php");
  $pdf = new FPDF( 'P', 'mm', 'A4' );

  $id_fattura = $_GET['id_fattura'];

  $pdf->SetAutoPagebreak(False);
  $pdf->SetMargins(0,0,0);

  //contatore per il multipagina
  $sql = 'SELECT count(*) AS n FROM ordine_vino JOIN (ordini JOIN fatture ON fatture.id_ordine = ordini.id) ON ordine_vino.id_ordine = ordini.id WHERE fatture.id=' .$id_fattura;
  $result = mysqli_query($db, $sql);
  $fattura = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $nb_page = intval($fattura['n'] / 28)+1;
  $num_page = 1; $limit_inf = 0; $limit_sup = 28;
  While ($num_page <= $nb_page) {
    $pdf->AddPage();

    //logo
    $pdf->Image('../res/img/logo_dark.png', 20, 20, 60, 20);

    //numero pagina in alto a dx
    $pdf->SetXY( 120, 5 ); $pdf->SetFont( "Arial", "B", 12 ); $pdf->Cell( 160, 8, $num_page . '/' . $nb_page, 0, 0, 'C');

    //coupon
    $select = 'SELECT codice, importo_sconto FROM fatture JOIN (ordini JOIN coupon ON ordini.id_coupon = coupon.id) ON fatture.id_ordine = ordini.id WHERE fatture.id=' .$id_fattura;
    $result = mysqli_query($db, $select) or die ('Error SQL : ' .$result.mysqli_connect_error() );
    $coupon_num_rows = mysqli_num_rows($result);
    if($coupon_num_rows > 0){
      $coupon = mysqli_fetch_array($result,MYSQLI_ASSOC);
    }
    //corriere
    $select = 'SELECT corrieri.nome AS nome, costo FROM corrieri JOIN (fatture JOIN ordini ON fatture.id_ordine = ordini.id) ON corrieri.id = ordini.id_corriere WHERE fatture.id=' .$id_fattura;
    $result = mysqli_query($db, $select) or die ('Error SQL : ' .$result.mysqli_connect_error() );
    $corriere = mysqli_fetch_array($result,MYSQLI_ASSOC);

    //n° fattura e data
    $select = 'SELECT fatture.nome, fatture.cognome, data_acquisto, costo_totale, stato, citta, cap, via FROM clienti JOIN (ordini JOIN (fatture JOIN indirizzi ON fatture.id_indirizzo = indirizzi.id) ON fatture.id_ordine = ordini.id) ON clienti.id = ordini.id_cliente WHERE fatture.id='.$id_fattura;
    $result = mysqli_query($db, $select) or die ('Error SQL : ' .$result.mysqli_connect_error() );
    $fatt_totale = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $data_fatt = $fatt_totale['data_acquisto'];

    $num_fact = "Fattura n_" .$id_fattura;
    $pdf->SetLineWidth(0.1); $pdf->SetFillColor(142, 68, 171); $pdf->Rect(120, 15, 85, 8, "DF");
    $pdf->SetXY( 120, 15 ); $pdf->SetTextColor(255); $pdf->SetFont( "Arial", "B", 12 ); $pdf->Cell( 85, 8, $num_fact, 0, 0, 'C'); $pdf->SetTextColor(0);
    $pdf->SetXY( 119, 22 ); $pdf->SetFont('Arial','',7); $pdf->Cell( 85, 8, $data_fatt, 0, 0, 'L');

    //nome file
    $nome_file = $id_fattura.".pdf";

    //indirizzo acquirente
    $pdf->SetFont('Arial','B',11);
    $select = "SELECT via,citta,stato,cap FROM indirizzi JOIN fatture ON indirizzi.id = fatture.id_indirizzo WHERE fatture.id=".$id_fattura;
    $result = mysqli_query($db, $select);
    $indirizzo = mysqli_fetch_array($result,MYSQLI_ASSOC);


    $pdf->SetXY( 120, 30 ); $pdf->Cell( 100, 8, $fatt_totale['nome']." ".$fatt_totale['cognome'], 0, 0, '');
    $pdf->SetXY( 120, 35 ); $pdf->Cell( 100, 8, $indirizzo['via'], 0, 0, '');
    $pdf->SetXY( 120, 40 ); $pdf->Cell( 100, 8, $indirizzo['cap']." ".$indirizzo['citta'].", ".$indirizzo['stato'], 0, 0, '');

    //se è l'ultima pagina
    if ($num_page == $nb_page){
      //totale e rettangoli
      $pdf->SetLineWidth(0.1); $pdf->SetFillColor(142, 68, 171); $pdf->Rect(5, 231, 90, 8, "DF");

      $totale = "Totale: ".$fatt_totale['costo_totale']."€";
      $totale = iconv('UTF-8', 'windows-1252', $totale);
      $pdf->SetTextColor(255); $pdf->SetFont('Arial','',10); $pdf->SetXY( 18, 231 ); $pdf->Cell( 63, 8, $totale, 0, 0, 'C'); $pdf->SetTextColor(0);

      $str = "Corriere: ".$corriere['nome']." ".$corriere['costo']."€";
      if($coupon_num_rows > 0){
        $str .= " | Coupon: ".$coupon['codice']." -".$coupon['importo_sconto']."€";
      }
	  if($fatt_totale['costo_totale'] > 500){
        $str .= " | Sconto: 10%";
      }
      $str = iconv('UTF-8', 'windows-1252', $str);
      $pdf->Rect(5, 231, 200, 8, "D"); $pdf->SetFont('Arial','',10); $pdf->SetXY( 97, 231 ); $pdf->Cell( 63, 8, $str, 0, 0, '');
    }

    // ***********************
    // tabella artcioli
    // ***********************

    // scheletro tabella
    $pdf->SetLineWidth(0.1); $pdf->Rect(5, 55, 200, 176, "D");
    $pdf->Line(5, 63, 205, 63);
    $pdf->Line(145, 55, 145, 231); $pdf->Line(158, 55, 158, 231);
    $pdf->SetXY( 1, 55 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 140, 8, "Prodotto", 0, 0, 'C');
    $pdf->SetXY( 145, 55 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 13, 8, "Qta", 0, 0, 'C');
    $pdf->SetXY( 156, 55 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 50, 8, "Prezzo", 0, 0, 'C');

    // articoli
    $pdf->SetFont('Arial','',8);
    $y = 55;

    $select = 'SELECT prezzo, ordine_vino.quantita AS qta, vini.nome AS nome FROM fatture JOIN (ordini JOIN (ordine_vino JOIN vini ON vini.id = ordine_vino.id_vino) ON ordine_vino.id_ordine = ordini.id) ON ordini.id = fatture.id_ordine WHERE fatture.id='.$id_fattura;
    $select .= ' LIMIT ' . $limit_inf . ',' . $limit_sup;
    $result = mysqli_query($db, $select) or die ('Erreur SQL : ' .$result.mysqli_connect_error() );
    $count = mysqli_num_rows($result);
    $i = 0;
    while ($i < $count){
      //nome
      $ordine = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $pdf->SetXY( 7, $y+9 ); $pdf->Cell( 140, 5, $ordine['nome'], 0, 0, 'L');
      //quantità
      $pdf->SetXY( 145, $y+9 ); $pdf->Cell( 8, 5, $ordine['qta'], 0, 0, 'R');
      //prezzo
      $prezzo = $ordine['prezzo']*$ordine['qta']."€";
      $prezzo = iconv('UTF-8', 'windows-1252', $prezzo);
      $pdf->SetXY( 187, $y+9 ); $pdf->Cell( -12, 5, $prezzo, 0, 0, 'C');
      $pdf->Line(5, $y+14, 205, $y+14);
      $y += 6;
      $i++;
    }
    // **************************
    // piè di pagina
    // **************************
    //rettangolo
    $pdf->SetLineWidth(0.1); $pdf->Rect(5, 265, 200, 6, "D");
    $pdf->SetXY( 1, 265 ); $pdf->SetFont('Arial','',7);
    $pdf->Cell( $pdf->GetPageWidth(), 7, iconv('UTF-8', 'windows-1252', "Questo documento non è valido come fattura e non può essere usato per detrarre l'IVA"), 0, 0, 'C');

    //info azienda
    $y1 = 270;
    $pdf->SetFont('Arial','B',10);

    $pdf->SetXY( 1, $y1 + 4 );
    $pdf->Cell( $pdf->GetPageWidth(), 5, "Vinelly", 0, 0, 'C');
    $pdf->SetFont('Arial','',10);
    $pdf->SetXY( 1, $y1 + 8 );
    $pdf->Cell( $pdf->GetPageWidth(), 5, "Via Archirafi 34, Palermo (Italy)", 0, 0, 'C');
    $pdf->SetXY( 1, $y1 + 12 );
    $pdf->Cell( $pdf->GetPageWidth(), 5, "+39 349 534 3852", 0, 0, 'C');

    $pdf->SetXY( 1, $y1 + 16 );
    $pdf->Cell( $pdf->GetPageWidth(), 5, "support@vinelly.it".$nb_page, 0, 0, 'C');

    //aggiorniamo i contatori per le pagine*/
    $num_page++; $limit_inf += 28; $limit_sup += 28;
  }
  $pdf->Output("I", $nome_file);
?>
