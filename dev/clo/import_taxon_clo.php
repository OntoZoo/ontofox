<?php header("Content-type: text/plain");
ini_set("display_errors", "1"); 
ini_set("display_startup_errors", "1"); 
error_reporting(E_ALL);

$strInput = 'African green monkey  	African green monkey polyomavirus	NCBITaxon:12480				
Agrothis segetum					Agrotis segetum	NCBITaxon:47767
anteater  	Myrmecophagidae	NCBITaxon:9349				
Antheraea perny					Antheraea pernyi	NCBITaxon:7119
armadillo, nine-banded 	Dasypus novemcinctus	NCBITaxon:9361				
armyworm, fall  	Spodoptera frugiperda	NCBITaxon:7108				
Atlantic salmon  	Salmo salar	NCBITaxon:8030				
baboon, African  	Papio	NCBITaxon:9554				
baboon, Papio hamadryas	Papio hamadryas	NCBITaxon:9557				
bat	Chiroptera	NCBITaxon:9397				
bat, free-tailed  	Molossidae	NCBITaxon:9436				
bat, mouse-eared   HB-9158 	Myotis	NCBITaxon:9434				
bear, black					Ursus americanus	NCBITaxon:9643
bluegill  	Lepomis macrochirus	NCBITaxon:13106				
Bolivian squirrel   monkey 	Saimiri boliviensis boliviensis	NCBITaxon:39432				
Bombyx mori (silkworm)	Bombyx mori	NCBITaxon:7091				
bovine  	Bos taurus	NCBITaxon:9913				
bovine, bos taurus cow	Bos taurus	NCBITaxon:9913				
bovine/mouse  	Bos taurus	NCBITaxon:9913	Mus musculus	NCBITaxon:10090		
buffalo	Syncerus	NCBITaxon:9969				
bullfrog  	Rana catesbeiana	NCBITaxon:8400				
bullhead, brown  	Ameiurus nebulosus	NCBITaxon:27778				
camel  	Camelus bactrianus	NCBITaxon:9837				
cat  	Felis catus	NCBITaxon:9685				
cat, domestic	Felis catus	NCBITaxon:9685				
catfish; walking  	Clarias batrachus	NCBITaxon:59899				
channel catfish  	Ictalurus punctatus	NCBITaxon:7998				
chicken	Gallus gallus	NCBITaxon:9031				
chicken, avian						
chicken, white leghorn	Gallus gallus	NCBITaxon:9031				
chimpanzee	Pan troglodytes	NCBITaxon:9598				
Chinese hamster  	Cricetulus griseus	NCBITaxon:10029				
crayfish  	Astacoidea	NCBITaxon:6724				
cusimanse  	Crossarchus	NCBITaxon:71110				
deer	Cervidae	NCBITaxon:9850				
deer, Columbian   black tail 	Odocoileus hemionus columbianus	NCBITaxon:9873				
deer, Sambar	Cervus unicolor	NCBITaxon:9862				
dog	Canis lupus familiaris	NCBITaxon:9615				
dog, beagle	Canis lupus familiaris	NCBITaxon:9615				
dog, cocker spaniel	Canis lupus familiaris	NCBITaxon:9615				
dog, golden retriever	Canis lupus familiaris	NCBITaxon:9615				
dolphin, Delphinus bairdi	Delphinus	NCBITaxon:9727				
dolphin, Stenella plagiodon	Stenella plagiodon	NCBITaxon:29074				
donkey	Equus asinus	NCBITaxon:9793				
Drosophila	Drosophila	NCBITaxon:7215				
Drosophila, hydnei					Drosophila hydei	NCBITaxon:7224
Drosophila, melanogaster	Drosophila melanogaster	NCBITaxon:7227				
Drosophila, virilis	Drosophila virilis	NCBITaxon:7244				
duck, Pekin  	Anas platyrhynchos	NCBITaxon:8839				
ferret  	Mustela putorius furo	NCBITaxon:9669				
fish	Hyperotreti	NCBITaxon:117565				
fish - bluestriped grunt	Haemulon sciurus	NCBITaxon:119718				
fish - carp, cyprinus	Cyprinus carpio	NCBITaxon:7962				
fish - Coho, salmon	Oncorhynchus kisutch	NCBITaxon:8019				
fish - Northern Pike	Esox lucius	NCBITaxon:8010				
fish - Ophicephalidae, Channa striata	Channa striata	NCBITaxon:64152				
fish - Poeciliid, Xiphophorus xiphidium	Xiphophorus xiphidium	NCBITaxon:8086				
fish - salmon	Salmonidae	NCBITaxon:8015				
fish - Sockeye, salmon	Oncorhynchus nerka	NCBITaxon:8023				
fish - trout	Salmoninae	NCBITaxon:504568				
fish - trout, rainbow	Oncorhynchus mykiss	NCBITaxon:8022				
fish - Walley whole fry	Sander vitreus	NCBITaxon:283036				
fox, grey  	Urocyon cinereoargenteus	NCBITaxon:55040				
fox, red	Vulpes vulpes	CBITaxon:9627				
frog, grass  	Neobatrachia	NCBITaxon:8416				
Fugu niphobles (kusafugu)	Takifugu niphobles	NCBITaxon:204815				
Fugu rubripes (torafugu)	Takifugu rubripes	NCBITaxon:31033				
gerbil, Mongolian  	Meriones unguiculatus	NCBITaxon:10047				
gibbon	Hylobatidae	NCBITaxon:9577				
goat  	Capra hircus	NCBITaxon:9925				
goldfish  	Carassius auratus	NCBITaxon:7957				
goose  	Anser	NCBITaxon:8842				
gorilla	Gorilla	NCBITaxon:9592				
guinea pig  	Cavia porcellus	NCBITaxon:10141				
hamster  	Cricetinae	NCBITaxon:10026				
hamster, Armenian  	Cricetulus migratorius	NCBITaxon:10032				
hamster, Chinese	Cricetulus griseus	NCBITaxon:10029				
hamster, Djungarian	Phodopus sungorus	NCBITaxon:10044				
hamster, golden Syrian	Mesocricetus auratus	NCBITaxon:10036				
hamster, Syrian	Mesocricetus auratus	NCBITaxon:10036				
hamster, Syrian golden	Mesocricetus auratus	NCBITaxon:10036				
hamster, Syrian golden kidney  	Mesocricetus auratus	NCBITaxon:10036				
hamster, Syrian golden skin; melanotic melanoma  	Mesocricetus auratus	NCBITaxon:10036				
hamster/mouse  	Cricetinae	NCBITaxon:10026	Mus musculus	NCBITaxon:10090		
horse  	Equus caballus	NCBITaxon:9796				
human	Homo sapiens	NCBITaxon:9606				
human /mouse  	Homo sapiens	NCBITaxon:9606	Mus musculus	NCBITaxon:10090		
human, African	Homo sapiens	NCBITaxon:9606				
human, Asiatic	Homo sapiens	NCBITaxon:9606				
human, Black	Homo sapiens	NCBITaxon:9606				
human, Caucasian	Homo sapiens	NCBITaxon:9606				
human, Chinese	Homo sapiens	NCBITaxon:9606				
human, Japanese	Homo sapiens	NCBITaxon:9606				
human, South American	Homo sapiens	NCBITaxon:9606				
human/(human x mouse) 	Homo sapiens	NCBITaxon:9606	Mus musculus	NCBITaxon:10090		
human/human	Homo sapiens	NCBITaxon:9606	Homo sapiens	NCBITaxon:9606		
human/mouse  	Homo sapiens	NCBITaxon:9606	Mus musculus	NCBITaxon:10090		
human; mouse  	Homo sapiens	NCBITaxon:9606	Mus musculus	NCBITaxon:10090		
iguana  	Iguana	NCBITaxon:8516				
insect - Estigmene agrea					Estigmene acrea	NCBITaxon:56594
insect - Estigmene agrea (saltmarsh caterpillar)					Estigmene acrea	NCBITaxon:56594
lepidoptera sciaridae diptera - Spodoptera frugiperda (fall armyworm)	Spodoptera frugiperda	NCBITaxon:7108				
lizard	Squamata	NCBITaxon:8509				
lizard, gekko  	Gekkonidae	NCBITaxon:8561				
Lymantria dispar (gypsy moth)	Lymantria dispar	NCBITaxon:13123				
Mamestra brassicae (cabbage moth)	Mamestra brassicae	NCBITaxon:55057				
marmoset  	Callithrix jacchus	NCBITaxon:9483				
marmoset, black tailed  	Callithrix argentata	NCBITaxon:9482				
marsupial - potoroo	Potorous	NCBITaxon:9309				
marsupial mouse	Dasyuridae	NCBITaxon:9277				
minipig  	Sus scrofa	NCBITaxon:9823				
mink  	Mustelinae	NCBITaxon:169418				
minnow, fathead  	Pimephales promelas	NCBITaxon:90988				
mongoose, African water  	Atilax paludinosus	NCBITaxon:210642				
monkey	Cercopithecidae	NCBITaxon:9527				
monkey, African   green 	Chlorocebus aethiops	NCBITaxon:9534				
monkey, African green  	Chlorocebus aethiops	NCBITaxon:9534				
monkey, Bolivian   squirrel 	Saimiri boliviensis boliviensis	NCBITaxon:39432				
monkey, Bolivian squirrel	Saimiri boliviensis boliviensis	NCBITaxon:39432				
monkey, chimpanzee	Pan	NCBITaxon:9596				
monkey, cynomologus	Macaca fascicularis	NCBITaxon:9541				
monkey, Guyanese squirrel  	Saimiri sciureus sciureus	NCBITaxon:190117				
monkey, marmoset	marmosets	NCBITaxon:38020				
monkey, owl  	Aotus	NCBITaxon:9504				
monkey, rhesus	Macaca mulatta	NCBITaxon:9544				
monkey, Rhesus  	Macaca mulatta	NCBITaxon:9544				
monkey, Rhesus macaque	Macaca mulatta	NCBITaxon:9544				
monkey, vervet	Chlorocebus aethiops	NCBITaxon:9534				
mosquito  	Culicidae	NCBITaxon:7157				
mosquito - Aedes albopictus	Aedes albopictus	NCBITaxon:7160				
moth  	Lepidoptera	NCBITaxon:7088				
moth - Antheraea eucalypti	Antheraea	NCBITaxon:7118				
moth, cabbage  	Mamestra brassicae	NCBITaxon:55057			Plutella xylostella	NCBITaxon:51655
mouse	Mus musculus	NCBITaxon:10090				
mouse (transgenic)  	Mus musculus	NCBITaxon:10090				
mouse, (C57BL/6xBALB/c) F1	Mus musculus	NCBITaxon:10090				
mouse, (C57BL/6xDBA/2)F1	Mus musculus	NCBITaxon:10090				
mouse, 129	Mus musculus	NCBITaxon:10090				
mouse, 129/J	Mus musculus	NCBITaxon:10090				
mouse, 129/SV	Mus musculus	NCBITaxon:10090				
mouse, A/Jax	Mus musculus	NCBITaxon:10090				
mouse, AAL	Mus musculus	NCBITaxon:10090				
mouse, AKR	Mus musculus	NCBITaxon:10090				
mouse, AKR/J	Mus musculus	NCBITaxon:10090				
mouse, ATH	Mus musculus	NCBITaxon:10090				
mouse, ATL	Mus musculus	NCBITaxon:10090				
mouse, B10.D2	Mus musculus	NCBITaxon:10090				
mouse, BALB/c	Mus musculus	NCBITaxon:10090				
mouse, BALB/cJ	Mus musculus	NCBITaxon:10090				
mouse, BDF/1	Mus musculus	NCBITaxon:10090				
mouse, C3H	Mus musculus	NCBITaxon:10090				
mouse, C3H.He	Mus musculus	NCBITaxon:10090				
mouse, C3H/An	Mus musculus	NCBITaxon:10090				
mouse, C3H/He	Mus musculus	NCBITaxon:10090				
mouse, C3H/HeJ	Mus musculus	NCBITaxon:10090				
mouse, C3H/HeNSIc	Mus musculus	NCBITaxon:10090				
mouse, C3H/Law	Mus musculus	NCBITaxon:10090				
mouse, C3HA	Mus musculus	NCBITaxon:10090				
mouse, C57B1/6J	Mus musculus	NCBITaxon:10090				
mouse, C57BL	Mus musculus	NCBITaxon:10090				
mouse, C57BL/6	Mus musculus	NCBITaxon:10090				
mouse, C57BL/6N	Mus musculus	NCBITaxon:10090				
mouse, C57BL/ICRF	Mus musculus	NCBITaxon:10090				
mouse, C57BL/ICRFat	Mus musculus	NCBITaxon:10090				
mouse, CD-1 transgenic	Mus musculus	NCBITaxon:10090				
mouse, Cloudman S91	Mus musculus	NCBITaxon:10090				
mouse, DBA	Mus musculus	NCBITaxon:10090				
mouse, DBA/2	Mus musculus	NCBITaxon:10090				
mouse, DBA/2J	Mus musculus	NCBITaxon:10090				
mouse, LAF1	Mus musculus	NCBITaxon:10090				
mouse, NIH 3T3	Mus musculus	NCBITaxon:10090				
mouse, NIH Swiss	Mus musculus	NCBITaxon:10090				
mouse, RIII	Mus musculus	NCBITaxon:10090				
mouse, SIM	Mus musculus	NCBITaxon:10090				
mouse, SL	Mus musculus	NCBITaxon:10090				
mouse, Swiss	Mus musculus	NCBITaxon:10090				
mouse, Swiss 3T3	Mus musculus	NCBITaxon:10090				
mouse, Swiss albino	Mus musculus	NCBITaxon:10090				
mouse, Swiss-Webster	Mus musculus	NCBITaxon:10090				
mouse, Tg transgenic	Mus musculus	NCBITaxon:10090				
mouse,(C57BL/10xC57BL/10.BR)	Mus musculus	NCBITaxon:10090				
mouse/human	Mus musculus	NCBITaxon:10090	Homo sapiens	NCBITaxon:9606		
mouse/mouse  	Mus musculus	NCBITaxon:10090	Mus musculus	NCBITaxon:10090		
mouse/rat	Mus musculus x Rattus norvegicus	NCBITaxon:36237				
muntjac  	Muntiacus	NCBITaxon:9885				
mustela vison (mink)	Neovison vison	NCBITaxon:452646				
opossum  	Didelphidae	NCBITaxon:9265				
orangutang	Pongo abelii	NCBITaxon:9601			Pongo pygmaeus	NCBITaxon:9600
oryx, short-horned  	Oryx	NCBITaxon:9957				
ovine	Ovis	NCBITaxon:9935				
Pacific herring  	Clupea pallasii	NCBITaxon:30724				
parakeet, shell  	Melopsittacus undulatus	NCBITaxon:13146				
peccary  	Tayassuidae	NCBITaxon:9827				
pig	Sus scrofa	NCBITaxon:9823				
pig/bovine	Sus scrofa	NCBITaxon:9823	Bos taurus	NCBITaxon:9913		
pig/horse	Sus scrofa	NCBITaxon:9823	Equus caballus	NCBITaxon:9796		
pig/pig	Sus scrofa	NCBITaxon:9823	Sus scrofa	NCBITaxon:9823		
potoroo  	Potorous	NCBITaxon:9309				
quail	Coturnix coturnix	NCBITaxon:9091			Odontophoridae	NCBITaxon:224313
quail, Japanese	Coturnix japonica	NCBITaxon:93934				
rabbit   	Oryctolagus cuniculus	NCBITaxon:9986				
rabbit, cottontail  	Sylvilagus	NCBITaxon:9987				
rabbit, New Zealand white	Oryctolagus cuniculus	NCBITaxon:9986				
rabbit, Orycytolagus cuniculus	Oryctolagus cuniculus	NCBITaxon:9986				
raccoon  	Procyon lotor	NCBITaxon:9654				
racoon					Procyon lotor	NCBITaxon:9654
rainbow trout  	Oncorhynchus mykiss	NCBITaxon:8022				
rat	Rattus norvegicus	NCBITaxon:10116				
rat, AxC	Rattus norvegicus	NCBITaxon:10116				
rat, BDIX	Rattus norvegicus	NCBITaxon:10116				
rat, brown Norway	Rattus norvegicus	NCBITaxon:10116				
rat, buffalo	Rattus norvegicus	NCBITaxon:10116				
rat, CD	Rattus norvegicus	NCBITaxon:10116				
rat, F344/Ducrj	Rattus norvegicus	NCBITaxon:10116				
rat, Fisher	Rattus norvegicus	NCBITaxon:10116				
rat, Fisher 344	Rattus norvegicus	NCBITaxon:10116				
rat, Galliera	Rattus norvegicus	NCBITaxon:10116				
rat, Holtzmann	Rattus norvegicus	NCBITaxon:10116				
rat, Lewis	Rattus norvegicus	NCBITaxon:10116				
rat, LOU	Rattus norvegicus	NCBITaxon:10116				
rat, Marshall	Rattus norvegicus	NCBITaxon:10116				
rat, NEDH	Rattus norvegicus	NCBITaxon:10116				
rat, Sprague-Dawley	Rattus norvegicus	NCBITaxon:10116				
rat, Walker	Rattus norvegicus	NCBITaxon:10116				
rat, Wistar	Rattus norvegicus	NCBITaxon:10116				
rat, Wistar Nossan	Rattus norvegicus	NCBITaxon:10116				
rat, Wistar-Commentry	Rattus norvegicus	NCBITaxon:10116				
rat, Wistar-Furth	Rattus norvegicus	NCBITaxon:10116				
rat, Yoshida	Rattus norvegicus	NCBITaxon:10116				
rat/mouse  	Rattus norvegicus	NCBITaxon:10116	Mus musculus	NCBITaxon:10090		
rat/rat  	Rattus norvegicus	NCBITaxon:10116	Rattus norvegicus	NCBITaxon:10116		
salmon, Chinook  	Oncorhynchus tshawytscha	NCBITaxon:74940				
salmon, chum  	Oncorhynchus keta	NCBITaxon:8018				
sheep	Ovis aries	NCBITaxon:9940				
sheep,Ovis aries/goat, Capra lircus	Ovis aries	NCBITaxon:9940	Capra hircus	NCBITaxon:9925		
silkworm  	Bombyx mori	NCBITaxon:7091				
snail  	Gastropoda	NCBITaxon:6448				
squirrel, plantain  	Callosciurus notatus	NCBITaxon:64678				
Syrian hamster/chicken	Mesocricetus auratus	NCBITaxon:10036	Gallus gallus	NCBITaxon:9031		
tahr  	Hemitragus	NCBITaxon:37178				
talapoin  	Miopithecus talapoin	NCBITaxon:36231				
tick - boophilus microplus, paquera	Ixodida	NCBITaxon:6935				
tick - hyalomma anatolicum, ludhiana	Ixodida	NCBITaxon:6935				
Tiger moth, Trichoplusia ni	Trichoplusia ni	NCBITaxon:7111				
toad, South African					Bufonidae	NCBITaxon:8382
toad, South African   clawed 	Xenopus laevis	NCBITaxon:8355				
toad, South African clawed  	Xenopus laevis	NCBITaxon:8355				
toad, tropical  					Bufo	NCBITaxon:8383
topminnow  	Fundulidae	NCBITaxon:28756				
trout, rainbow  	Oncorhynchus mykiss	NCBITaxon:8022				
turkey  	Phasianidae	NCBITaxon:9005				
turtle, box  	Terrapene	NCBITaxon:85610				
viper, Russell	Daboia russellii	NCBITaxon:8707				
viper, Russell’s  	Daboia russellii	NCBITaxon:8707				
white bass  	Morone chrysops	NCBITaxon:46259				
wolf	Canis	NCBITaxon:9611				
woodchuck, Eastern  					Marmota monax	NCBITaxon:9995
zebra, Burchell’s  	Equus burchellii	NCBITaxon:9790				
zebrafish  	Danio rerio	NCBITaxon:7955				';




$lines = preg_split('/[\r\n]+/', $strInput);

$annotations=array();
$taxons=array();

foreach ($lines as $line) {
	$tokens = preg_split('/\t/', $line);
	
	//print_r($tokens);
	
	if ($tokens[2]!='') {
		$taxon_id=str_replace('NCBITaxon:', '', $tokens[2]);
		$annotations[$taxon_id]['CLO Organism string: '.trim($tokens[0])]=1;
		$annotations[$taxon_id]['NCBI Taxon Preferred Name: '.trim($tokens[1])]=1;
		
		if (!isset($taxons[$taxon_id])) {
			$taxons[$taxon_id] = trim($tokens[1]);
		}
	}
	if ($tokens[4]!='') {
		$taxon_id=str_replace('NCBITaxon:', '', $tokens[4]);
		$annotations[$taxon_id]['CLO Organism string: '.trim($tokens[0])]=1;
		$annotations[$taxon_id]['2nd Taxon Preferred Name (hybrid): '.trim($tokens[3])]=1;
		
		if (!isset($taxons[$taxon_id])) {
			$taxons[$taxon_id] = trim($tokens[3]);
		}
	}
	if ($tokens[6]!='') {
		$taxon_id=str_replace('NCBITaxon:', '', $tokens[6]);
		$annotations[$taxon_id]['CLO Organism string: '.trim($tokens[0])]=1;
		$annotations[$taxon_id]['Remark (possible typo, multiple entry/same synonyms): '.trim($tokens[5])]=1;
		
		if (!isset($taxons[$taxon_id])) {
			$taxons[$taxon_id] = trim($tokens[5]);
		}
	}
}

foreach ($annotations as $taxon_id => $annotation) {
?>
<rdf:Description rdf:about="http://purl.obolibrary.org/obo/NCBITaxon_<?php echo $taxon_id?>">
	<rdfs:comment><?php echo join(', ', array_keys($annotation))?></rdfs:comment>
</rdf:Description>
<?php 
}

foreach ($taxons as $taxon_id => $label) {
?>
http://purl.obolibrary.org/obo/NCBITaxon_<?php echo $taxon_id?> #<?php echo $label?>

<?php 
}
?>