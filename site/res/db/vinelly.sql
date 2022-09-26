-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 25, 2019 alle 14:37
-- Versione del server: 10.1.29-MariaDB
-- Versione PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinelly`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'ema', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'dario', '098f6bcd4621d373cade4e832627b4f6'),
(3, 'prof', '098f6bcd4621d373cade4e832627b4f6');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_coupon` int(11) DEFAULT NULL,
  `id_corriere` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`id`, `id_cliente`, `id_coupon`, `id_corriere`) VALUES
(1, 1, NULL, 3),
(2, 2, NULL, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello_vini`
--

CREATE TABLE `carrello_vini` (
  `id` int(11) NOT NULL,
  `id_carrello` int(11) NOT NULL,
  `id_vino` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `carte`
--

CREATE TABLE `carte` (
  `id` int(11) NOT NULL,
  `nome_proprietario` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cognome_proprietario` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `codice` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `data_di_scadenza` date NOT NULL,
  `cvv` varchar(3) COLLATE latin1_general_ci NOT NULL,
  `tipologia` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `carte`
--

INSERT INTO `carte` (`id`, `nome_proprietario`, `cognome_proprietario`, `codice`, `data_di_scadenza`, `cvv`, `tipologia`) VALUES
(1, 'mario', 'rossi', '8382746390001780', '2021-01-01', '123', 'credit'),
(2, '', '', '', '0000-00-00', '', 'paypal'),
(3, 'marco', 'telli', '8282767653530101', '2025-12-01', '999', 'credit');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente_carta`
--

CREATE TABLE `cliente_carta` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_carta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `cliente_carta`
--

INSERT INTO `cliente_carta` (`id`, `id_cliente`, `id_carta`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente_coupon`
--

CREATE TABLE `cliente_coupon` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_coupon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `cliente_coupon`
--

INSERT INTO `cliente_coupon` (`id`, `id_cliente`, `id_coupon`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `id` int(11) NOT NULL,
  `id_indirizzo` int(11) NOT NULL,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cognome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `numero_di_telefono` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `data_nascita` date NOT NULL,
  `domanda_sicurezza` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `risposta_sicurezza` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `edit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `clienti`
--

INSERT INTO `clienti` (`id`, `id_indirizzo`, `nome`, `cognome`, `email`, `username`, `numero_di_telefono`, `password`, `data_nascita`, `domanda_sicurezza`, `risposta_sicurezza`, `edit`) VALUES
(1, 1, 'mario', 'rossi', 'mariorossi@mail.it', 'mariorossi', '3272393113', '098f6bcd4621d373cade4e832627b4f6', '2000-01-27', 'Nome della madre', 'test', 0),
(2, 4, 'marco', 'telli', 'marcotelli@mail.it', 'marcotelli', '3428975611', '098f6bcd4621d373cade4e832627b4f6', '1992-01-01', 'Nome del primo animale domestico', 'test', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `corrieri`
--

CREATE TABLE `corrieri` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `costo` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `corrieri`
--

INSERT INTO `corrieri` (`id`, `nome`, `costo`) VALUES
(1, 'Bartolini', '8.00'),
(2, 'SDA', '10.30'),
(3, 'PosteItaliane', '4.90'),
(4, 'DHL', '14.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `codice` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `importo_sconto` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `coupon`
--

INSERT INTO `coupon` (`id`, `codice`, `importo_sconto`) VALUES
(1, 'VINO10', 10.00),
(2, 'VINO20', 20.00),
(3, 'VINO30', 30.00),
(4, 'VINO5', 5.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `fatture`
--

CREATE TABLE `fatture` (
  `id` int(11) NOT NULL,
  `id_indirizzo` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cognome` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `fatture`
--

INSERT INTO `fatture` (`id`, `id_indirizzo`, `id_ordine`, `nome`, `cognome`) VALUES
(1, 1, 1, 'mario', 'rossi'),
(2, 3, 2, 'elisa', 'neri'),
(3, 1, 3, 'mario', 'rossi'),
(4, 4, 4, 'marco', 'telli');

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzi`
--

CREATE TABLE `indirizzi` (
  `id` int(11) NOT NULL,
  `stato` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `citta` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cap` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `via` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `indirizzi`
--

INSERT INTO `indirizzi` (`id`, `stato`, `citta`, `cap`, `via`) VALUES
(1, 'italia', 'termini imerese', '90018', 'via monachelle 2'),
(2, 'italia', 'palermo', '90023', 'via roma 2'),
(3, 'italia', 'palermo', '90023', 'via vittorio amedeo 83'),
(4, 'italia', 'catannia', '90031', 'via messina 2');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine_vino`
--

CREATE TABLE `ordine_vino` (
  `id` int(11) NOT NULL,
  `id_vino` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `ordine_vino`
--

INSERT INTO `ordine_vino` (`id`, `id_vino`, `id_ordine`, `quantita`) VALUES
(1, 7, 1, 6),
(2, 3, 2, 1),
(3, 10, 2, 1),
(4, 18, 3, 1),
(5, 11, 4, 1),
(6, 7, 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_indirizzo_sped` int(11) NOT NULL,
  `id_carta` int(11) NOT NULL,
  `id_coupon` int(11) DEFAULT NULL,
  `id_corriere` int(11) NOT NULL,
  `data_acquisto` datetime NOT NULL,
  `costo_totale` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`id`, `id_cliente`, `id_indirizzo_sped`, `id_carta`, `id_coupon`, `id_corriere`, `data_acquisto`, `costo_totale`) VALUES
(1, 1, 1, 1, 1, 1, '2019-01-24 21:31:03', 530.10),
(2, 1, 2, 2, NULL, 4, '2019-01-24 21:38:30', 94.50),
(3, 1, 1, 1, NULL, 3, '2019-01-24 21:41:23', 32.90),
(4, 2, 4, 3, 2, 3, '2019-01-24 23:01:27', 100.90);

-- --------------------------------------------------------

--
-- Struttura della tabella `vini`
--

CREATE TABLE `vini` (
  `id` int(11) NOT NULL,
  `cantina` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `regione` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gradi` double NOT NULL,
  `tipologia` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `prezzo` double(15,2) NOT NULL,
  `img` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `vini`
--

INSERT INTO `vini` (`id`, `cantina`, `nome`, `regione`, `gradi`, `tipologia`, `prezzo`, `img`, `descrizione`, `quantita`) VALUES
(1, 'Sordo', 'Barolo Monprivato DOCG 2013', 'Piemonte', 14.5, 'rosso', 80.00, 'barolo_monprivato.jpg', 'È solamente dopo cinque lunghi anni di invecchiamento che il Barolo può fregiarsi del titolo di “Riserva”. Ciò è valido anche per il Barolo “Leon” di Rivetto che, lasciato riposare nelle botti che offrono i maggiori potenziali, sarà perfetto dopo 15 o 20 anni dalla vendemmia. Il Barolo Riserva DOCG “Leon” 2008 di Rivetto è un vino che va acquistato e poi dimenticato per alcuni anni in cantina. Abbiate pazienza.', 71),
(2, 'Duemani', 'Costa Toscana Cabernet Franc IGP \"Cifra\" 2015', 'Toscana', 14, 'rosso', 22.50, 'cabernet_cifra.jpg', 'Un grande Cabernet Franc, quello di Duemani, che rappresenta perfettamente lo stile di questa cantina biodinamica, che fa vini puliti, dove il varietale emerge integralmente. Un rosso di carattere, dal naso elegante e complesso, che in bocca rimane misurato e in perfetto equilibrio. E’ forse questo equilibrismo da funambolo che colpisce, per quella linea sottile perfettamente equidistante tra morbidezza, freschezza e sapidità. Da provare. ', 178),
(3, 'Marco De Bartoli', 'Vecchio Samperi Ventennale', 'Sicilia', 17.5, 'rosso', 45.50, 'samperi_ventennale.jpg', 'È in onore al territorio, e alla contrada di Samperi situata nell’entroterra marsalese, arida terra calcarea ricca di minerali, che Marco De Bartoli ha chiamato il suo primo vino “Vecchio Samperi”. Oggi, il Vino Liquoroso Secco “Vecchio Samperi Ventennale” viene lasciato fermentare in fusti di rovere e castagno a temperatura ambiente, ed è invecchiato per una media di venti anni secondo il metodo soleras. Territoriale e unico, si evolve magnificamente nel bicchiere.', 49),
(4, 'Lungarotti', 'Torgiano Rosso DOC \"Rubesco\" 2013 Magnum', 'Umbria', 14, 'rosso', 21.00, 'rubesco_magnum.jpg', 'Uno dei vini più noti delle Cantine Lungarotti, il Rubesco, nasce grazie a un sapiente taglio di sangiovese e, in minima parte, colorino, varietà coltivate nella zona di Torgiano da sempre. Un rosso fresco e articolato, capace di andare incontro ai gusti più diversi grazie a un invidiabile equilibrio e profumi fragranti e accattivanti. Vinificato in acciaio e lasciato maturare per un anno in botte grande, nel bicchiere spicca per immediatezza e per armonia.', 50),
(5, 'Inama', 'Bradissimo Rosso Veneto IGT 2015', 'Veneto', 14.5, 'rosso', 25.00, 'brandissimo.jpg', 'Colore rosso cupo. Naso intenso di piccole bacche scure, spezie, pepe, ciliege passite e vaniglia. Al palato morbido, rotondo, di aroma profondo, senza impedimenti acidi e tannici. ', 50),
(6, 'Pieropan', 'Pieropan Soave Classico DOC \"La Rocca\" 2012', 'Veneto', 13, 'bianco', 29.00, 'la_rocca.jpg', 'Il vigneto conosciuto con il nome di \"La Rocca\" è situato sulla collina Monte Rocchetta, a ridosso del castello scaligero medioevale del paese di Soave. Un appezzamento mitico, che gode di un microclima particolare che consente di ottenere vini con bouquet e con note gustative uniche e non riproducibili.', 50),
(7, 'Gaja', 'Alteni di Brassica Gaja 2016 ', 'Piemonte', 13.5, 'bianco', 98.50, 'alteni_di_brassica.jpg', 'L\'Alteni di Brassica è uno dei grandi vini bianchi di Angelo Gaja. Ha una personalità morbida e intensa e un carattere internazionale, con sentori di frutta esotica e leggere sfumature boisé, dovute all\'affinamento in barrique. Una delle più alte espressioni di Sauvignon del Piemonte.', 42),
(8, 'Ronco delle mele', 'Magnum 2017 Venica & Venica S.S.', 'Friuli Venezia Giulia', 12.5, 'bianco', 68.00, 'magnum_venica.jpg', 'Il vigneto orientato a nord-ovest permette una lenta maturazione, con conseguente intensificazione delle caratteristiche varietali del ” Ronco delle Mele ”. Le uve diraspate vengono macerate per quasi 14 ore a 10/12 C°, in appositi contenitori, protette dall’ossigeno con sistemi innovativi anche al fine di ridurre l’apporto di antiossidanti. Il 20% del mosto fermenta e affina sui lieviti per 5 mesi in botti grandi (27 HL) il resto in acciaio.', 49),
(9, 'Cantina Ca\' del Bosco', 'Chardonnay \"Curtefranca\" 2012', 'Lombardia', 13, 'bianco', 50.00, 'chardonnay_curtefranca.jpg', 'Lo Chardonnay Curtefranca Bianco D.O.C. di Ca Del Bosco è un apprezzatissimo vino dell\'alta enologia Italiana. Le uve provenienti da vigneti di età media 33 anni tra i comuni di Erbusco e Corte Franca sono selezionate da occhi esperti, raffreddate e passate attraverso l\'esclusivo processo delle \'terme degli acini\'. Un lavaggio in tre vasche di ammollo ed un tunnel di asciugatura.', 50),
(10, 'Castello della Sala', 'Umbria Bianco IGT \"Cervaro della Sala\" 2015 Magnum', 'Umbria', 12.5, 'bianco', 35.00, 'cervaro_della_sala.jpg', 'Uno dei più famosi ed importanti vini bianchi italiani, il cui nome deriva dalla nobile famiglia proprietaria del Castello nel corso del XIV secolo: I Monaldeschi della Cervara. Nato nel 1985 e commercializzato a partire dal 1987, da sempre esprime il meglio dello chardonnay in assemblaggio con il più tipico dei vitigni della zona, il grechetto.', 49),
(11, 'Cantina del Vesuvio', 'Vesuvio Lacryma Christi Rosato DOC 2016', 'Campania', 12.5, 'rosato', 17.50, 'vesuvio_rosato.jpg', 'Conosciuto già durante l’epoca romana, il Lacryma Christi, tra leggenda e storia, è da considerarsi oggi il simbolo della massima espressione enologica delle terre del Vesuvio.\r\nFiglio di una vitivinicoltura certificata biologica, il Rosato della Cantina del Vesuvio prende vita vinificando uve di Piedirosso in purezza. ', 47),
(12, 'Leone de Castris', 'Salento Rosato IGT \"Five Roses Anniversario\" 2017', 'Puglia', 12, 'rosato', 27.50, 'salento_rosato.jpg', 'Uno dei cavalli di battaglia di tutta la produzione dell’azienda Leone de Castris: il “Five Roses Anniversario” è stato creato per la prima volta nel 1993, per celebrare i 50 anni del Five Roses; da allora, accanto alla versione normale, si continua a produrre ogni anno anche questo cru “Anniversario”, Salento Rosato IGT costituito da negroamaro e malvasia nera di Lecce, che colpisce per freschezza e ammalia i consumatori con un bel colore cerasuolo acceso.', 50),
(13, 'Duemani', 'Costa Toscana Rosato IGP \"Si\" 2017', 'Toscana', 14, 'rosato', 34.00, 'toscana_rosato.jpg', '“Un rosato splendente”, è questo che si pensa immediatamente quando si versa nel calice questo Costa Toscana Rosato IGP di Duemani. Poi lo si mette al naso ed esplodono degli aromi di piccoli frutti rossi e spezie che conquistano gli appassionati dei profumi puliti e riconoscibili, finché lo si mette in bocca e il capolavoro è completo. Piacevolissimo fino all’ultimo sorso, un rosato gastronomico che potete abbinare dall’antipasto alle carni bianche.', 10),
(14, 'Antiche Cantine Migliaccio', 'Lazio Rosato IGT \"Fieno di Ponza\" 2017', 'Lazio', 13, 'rosato', 27.50, 'lazio_rosato.jpg', 'Solamente 1.000 bottiglie per questo Lazio Rosato IGT che rappresenta un piccolo capolavoro di semplicità e gradevolezza. Quasi sconosciuto al grande pubblico il “Fieno di Ponza” rosato delle Antiche Cantine Migliaccio, vinificato ed affinato esclusivamente in acciaio, ci piace per la sua nota fruttata e minerale, sue caratteristiche distintive, e per il calore e la leggera nota tannica che conferiscono corpo e struttura alla beva, elegante e molto piacevole.', 50),
(15, 'Poggio al Tesoro', 'Bolgheri DOC \"Cassiopea - Pagus Cerbaia\" 2016', 'Trentino', 14, 'rosato', 33.00, 'bolgheri_cassiopea.jpg', 'Il Bolgheri DOC \"Cassiopea - Pagus Cerbaia\" di Poggio al Tesoro nasce dall\'omonimo appezzamento posto su terreni sedimentari. Ottenuto da uve syrah e cabernet sauvignon fermentate in parte in anfore e in parte in fusti di rovere, è un vino che regala un sorso rinfrancante, come una brezza che improvvisamente rinfresca un pomeriggio estivo.', 50),
(16, 'Terrazze dell\'Etna', 'Spumante Metodo Classico Brut Rosé 2014', 'Sicilia', 12.5, 'spumante', 22.00, 'spumante_etna.jpg', 'Il vincolo sentimentale tra Nino Bevilaqua e il mondo del vino è così stretto che risulta difficile spiegarlo solamente con le parole: per comprenderlo nel profondo però, basta assaggiare i suoi vini, come questo Spumante Metodo Classico Brut Rosé, che rappresenta un piccolo tassello dell’avventura intrapresa da questo viticoltore in terra siciliane. Un prodotto di personalità, con un perlage fine e un sorso persistente, che ne certifica l’indubbia qualità.', 45),
(17, 'Il Pollenza', 'Spumante Extra Brut Rosé Metodo Classico 2010', 'Marche', 12.5, 'spumante', 55.50, 'spumante_marche.jpg', 'Il vino non è solo una \"bevuta\", ma è soprattutto piacere, socializzazione, cultura e degustazione, amicizia e condivisione. Se cercate tutto questo, potrete trovarlo nello Spumante Extra Brut Rosé etichettato “Il Pollenza”: una bollicina adatta per supportare i vostri più spensierati aperitivi. Con freschezza e fragranza, è un vino che vi farà ricordare le calde giornate primaverili, in cui nell’aria si diffondono i profumi degli alberi in fiore.', 49),
(18, 'Arnaldo Caprai', 'Arnaldo Caprai Vino Spumante Metodo Classico Brut', 'Umbria', 12.5, 'spumante', 28.00, 'spumante_umbria.jpg', 'Questo Vino Spumante di Qualità Metodo Classico Brut è l’ennesima sfida vinta da Arnaldo Caprai. Frutto di una accurata selezione delle uve e di rigorosi protocolli di vinificazione, si eleva per 20 mesi sui lieviti e rivela un carattere moderno, adatto a tutte le occasioni. ', 49),
(19, 'Cocchi', 'Alta Langa Brut Nature DOCG \"Pas Dosé\" 2011', 'Piemonte', 12.5, 'spumante', 35.00, 'spumante_piemonte.jpg', 'Una spiccata concentrazione e una notevole acidità del frutto rappresentano la solida base da cui prende vita il “Pas Dosé” di casa Cocchi. È uno spumante che viene lasciato riposare sui lieviti in bottiglia per ben ottanta mesi, per poi arrivare a offrire un sorso articolato e complesso, sensuale e intrigante.', 50),
(20, 'Cantina Valdadige', 'Trento Brut DOC \"Celeber\" 2012 Magnum', 'Veneto', 12.5, 'spumante', 41.00, 'spumante_veneto.jpg', 'Il \"Celeber\" è un Trento DOC firmato dalla Cantina Valdadige che nasce dall’utilizzo esclusivo di chardonnay, vitigno che, quando si presenta con la silhouette delle bollicine, è sempre in grado di regalare soddisfazioni. Proprio come in questo caso, grazie a una trama morbida e fresca, che rende l’intera degustazione un’esperienza a dir poco piacevole.', 45);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_cliente_2` (`id_cliente`,`id_coupon`,`id_corriere`),
  ADD KEY `id_corriere` (`id_corriere`),
  ADD KEY `id_coupon` (`id_coupon`);

--
-- Indici per le tabelle `carrello_vini`
--
ALTER TABLE `carrello_vini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrello` (`id_carrello`,`id_vino`),
  ADD KEY `id_vino` (`id_vino`);

--
-- Indici per le tabelle `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cliente_carta`
--
ALTER TABLE `cliente_carta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`,`id_carta`),
  ADD KEY `id_carta` (`id_carta`);

--
-- Indici per le tabelle `cliente_coupon`
--
ALTER TABLE `cliente_coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`,`id_coupon`),
  ADD KEY `id_coupon` (`id_coupon`);

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_indirizzo` (`id_indirizzo`);

--
-- Indici per le tabelle `corrieri`
--
ALTER TABLE `corrieri`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `fatture`
--
ALTER TABLE `fatture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_indirizzo` (`id_indirizzo`,`id_ordine`),
  ADD KEY `id_ordine` (`id_ordine`);

--
-- Indici per le tabelle `indirizzi`
--
ALTER TABLE `indirizzi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordine_vino`
--
ALTER TABLE `ordine_vino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vino` (`id_vino`,`id_ordine`),
  ADD KEY `id_ordine` (`id_ordine`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`,`id_indirizzo_sped`,`id_carta`,`id_coupon`,`id_corriere`),
  ADD KEY `id_carta` (`id_carta`),
  ADD KEY `id_coupon` (`id_coupon`),
  ADD KEY `id_corriere` (`id_corriere`),
  ADD KEY `id_indirizzo_sped` (`id_indirizzo_sped`);

--
-- Indici per le tabelle `vini`
--
ALTER TABLE `vini`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `carrello_vini`
--
ALTER TABLE `carrello_vini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `carte`
--
ALTER TABLE `carte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `cliente_carta`
--
ALTER TABLE `cliente_carta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `cliente_coupon`
--
ALTER TABLE `cliente_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `clienti`
--
ALTER TABLE `clienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `corrieri`
--
ALTER TABLE `corrieri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `fatture`
--
ALTER TABLE `fatture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `indirizzi`
--
ALTER TABLE `indirizzi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `ordine_vino`
--
ALTER TABLE `ordine_vino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `vini`
--
ALTER TABLE `vini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clienti` (`id`),
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`id_corriere`) REFERENCES `corrieri` (`id`),
  ADD CONSTRAINT `carrello_ibfk_3` FOREIGN KEY (`id_coupon`) REFERENCES `coupon` (`id`);

--
-- Limiti per la tabella `carrello_vini`
--
ALTER TABLE `carrello_vini`
  ADD CONSTRAINT `carrello_vini_ibfk_1` FOREIGN KEY (`id_carrello`) REFERENCES `carrello` (`id`),
  ADD CONSTRAINT `carrello_vini_ibfk_2` FOREIGN KEY (`id_vino`) REFERENCES `vini` (`id`);

--
-- Limiti per la tabella `cliente_carta`
--
ALTER TABLE `cliente_carta`
  ADD CONSTRAINT `cliente_carta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clienti` (`id`),
  ADD CONSTRAINT `cliente_carta_ibfk_2` FOREIGN KEY (`id_carta`) REFERENCES `carte` (`id`);

--
-- Limiti per la tabella `cliente_coupon`
--
ALTER TABLE `cliente_coupon`
  ADD CONSTRAINT `cliente_coupon_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clienti` (`id`),
  ADD CONSTRAINT `cliente_coupon_ibfk_2` FOREIGN KEY (`id_coupon`) REFERENCES `coupon` (`id`);

--
-- Limiti per la tabella `clienti`
--
ALTER TABLE `clienti`
  ADD CONSTRAINT `clienti_ibfk_1` FOREIGN KEY (`id_indirizzo`) REFERENCES `indirizzi` (`id`);

--
-- Limiti per la tabella `fatture`
--
ALTER TABLE `fatture`
  ADD CONSTRAINT `fatture_ibfk_1` FOREIGN KEY (`id_indirizzo`) REFERENCES `indirizzi` (`id`),
  ADD CONSTRAINT `fatture_ibfk_2` FOREIGN KEY (`id_ordine`) REFERENCES `ordini` (`id`);

--
-- Limiti per la tabella `ordine_vino`
--
ALTER TABLE `ordine_vino`
  ADD CONSTRAINT `ordine_vino_ibfk_1` FOREIGN KEY (`id_vino`) REFERENCES `vini` (`id`),
  ADD CONSTRAINT `ordine_vino_ibfk_2` FOREIGN KEY (`id_ordine`) REFERENCES `ordini` (`id`);

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`id_carta`) REFERENCES `carte` (`id`),
  ADD CONSTRAINT `ordini_ibfk_2` FOREIGN KEY (`id_coupon`) REFERENCES `coupon` (`id`),
  ADD CONSTRAINT `ordini_ibfk_3` FOREIGN KEY (`id_corriere`) REFERENCES `corrieri` (`id`),
  ADD CONSTRAINT `ordini_ibfk_4` FOREIGN KEY (`id_indirizzo_sped`) REFERENCES `indirizzi` (`id`),
  ADD CONSTRAINT `ordini_ibfk_5` FOREIGN KEY (`id_cliente`) REFERENCES `clienti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
