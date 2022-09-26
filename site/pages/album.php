<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Vinelly - Galleria Prodotti</title>

    <!-- Bootstrap core CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../css/product.css" rel="stylesheet">
  </head>
  <body class="album-body">
	<!-- HEADER -->
        <?php
            include "header.php";
			include "session.php";
        ?>
    <br><br><br>
		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-opaque">
		  <div class="col-md-5 p-lg-1 mx-auto my-1">
			<h1 class="display-3 text-purple">Bianchi</h1>
			<p class="lead font-weight-normal">Il vino bianco viene prodotto con diverse tecniche che lavorano l'acino d'uva bianca, in modo da ottenere il solo succo ed eliminare quindi le bucce. Può essere anche prodotto da uva a bacca nera (ad esempio pinot noir) separando da subito le bucce dal succo, al contrario del processo di vinificazione in rosso, che prevede la macerazione anche delle bucce per estrarne il colore ed i contenuti. Si presenta all'aspetto di colore giallo in varie tonalità (dal verdolino all'ambrato, passando per il paglierino e il dorato); è generalmente caratterizzato da profumi floreali e fruttati e va consumato ad una temperatura di servizio compresa fra 8 °C e 14 °C; al gusto prevalgono le sensazioni di freschezza e acidità, anche se con l'aumentare della temperatura di servizio potrebbero presentarsi sgradevoli sensazioni di amaro. Gli accoppiamenti ottimali sono con le pietanze a base di pesce, molluschi, crostacei, verdure e carni bianche, ed in generale con piatti di cottura rapida e sughi poco strutturati.</p>
			<div class="btn-group">
				<p><a class="btn btn-lg btn-outline-secondary" href="gallery.php?type=bianco" role="button">Scopri di più</a></p>
			</div>
		  </div>
		</div>
		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-opaque">
		  <div class="col-md-5 p-lg-1 mx-auto my-1">
			<h1 class="display-3 text-purple">Rossi</h1>
			<p class="lead font-weight-normal">Il vino rosso si presenta all'aspetto di colore rosso in varie tonalità (dal porpora al rubino fino al granato e all'aranciato), e viene prodotto dal mosto fatto macerare sulle bucce, così da estrarre polifenoli e le sostanze coloranti naturalmente presenti su di esse. È generalmente caratterizzato da un'ampia varietà di profumi (fiori, frutta, confettura, erbe, spezie) e da una più o meno elevata sensazione di morbidezza, corposità e tannicità; va consumato ad una temperatura di servizio compresa fra 14 °C e 20 °C. Gli accoppiamenti ottimali sono con le carni rosse, la cacciagione, i formaggi, e tutte le pietanze basate su cotture prolungate e sughi strutturati.</p>
			<div class="btn-group">
				<p><a class="btn btn-lg btn-outline-secondary" href="gallery.php?type=rosso" role="button">Scopri di più</a></p>
			</div>
		  </div>
		</div>
		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-opaque">
		  <div class="col-md-5 p-lg-1 mx-auto my-1">
			<h1 class="display-3 text-purple">Rosati</h1>
			<p class="lead font-weight-normal">Il vino rosato si produce utilizzando uve rosse lavorate in modo da ottenere succo a veloce contatto con le bucce, da 2 ore fino massimo 36 circa. In questo modo le bucce cedono solo parte del colore al mosto. In alternativa si può usare il metodo del salasso, che consiste nel togliere parte del mosto durante la vinificazione in rosso (quindi in presenza delle bucce), così da ottenere un vino di colore rosato. È del tutto vietato produrre vini rosati mescolando vino bianco e vino rosso. L'unica eccezione è l'assemblaggio per ottenere spumante rosé. Si presenta all'aspetto di colore tra il rosa tenue, il cerasuolo e il chiaretto; è generalmente caratterizzato da profumi fruttati, e va consumato ad una temperatura di servizio compresa fra 10 °C e 14 °C; al gusto prevalgono le sensazioni di leggera acidità, di aromaticità e di lieve corposità. Gli accoppiamenti ottimali sono con pietanze gustose a base di pesce, paste asciutte con sughi delicati, salumi leggeri. Quando si parla di spumante il termine più consueto è rosé invece di rosato.</p>
			<div class="btn-group">
				<p><a class="btn btn-lg btn-outline-secondary" href="gallery.php?type=rosato" role="button">Scopri di più</a></p>
			</div>
		  </div>
		</div>
		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-opaque">
		  <div class="col-md-5 p-lg-1 mx-auto my-1">
			<h1 class="display-3 text-purple">Spumanti</h1>
			<p class="font-weight-normal">È un vino che presenta una moderata effervescenza dovuta alla presenza di anidride carbonica con una sovrappressione compresa, a temperatura ambiente, tra 1 e 2,5 bar. Sono naturali o gassificati (questi ultimi di mediocre qualità). Quelli naturali sono quasi sempre realizzati con il metodo Charmat. I vini frizzanti non devono essere assolutamente confusi con gli spumanti che sono vini speciali (e hanno una sovrappressione maggiore): un vino frizzante può essere considerato, a livello di effervescenza e spuma, a metà strada tra un vino "tranquillo" (ovvero senza alcuna presenza di bollicine cioè un vino "fermo") e uno spumante.</p>
			<div class="btn-group">
				<p><a class="btn btn-lg btn-outline-secondary" href="gallery.php?type=spumante" role="button">Scopri di più</a></p>
			</div>
		  </div>
		</div>

		<!-- FOOTER -->
        <?php
            include "footer.php";
        ?>

		<!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>
	</body>
</html>
