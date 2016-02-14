<?php

namespace Djez\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Djez\Bundle\DataModeleBundle\Repositories\AnnoncesRepository;
use Djez\Bundle\DataModeleBundle\Repositories\CategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SuperCategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SpecifiqueRepository;
use Djez\Bundle\DataModeleBundle\Entity\Annonces;
use Djez\Bundle\DataModeleBundle\Entity\Photos;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\Config\Definition\Exception\Exception;


		class PublierController extends Controller
		{
			const MAXIMUM_FILES = 1048576;

			public function publierAnnonceAction(){

				//0. Main tab selector
				$selectedTab = 2;
				$logger = $this->get('logger');
		    $logger->info('Publishing annonce');

				$request = $this->getRequest();

				if($request->isXmlHttpRequest()){

					$queryAction = $request->get('queryAction');
					$idCategorie = $request->get('idCategorie');

					if($queryAction == "MARQUE" ){

						$marques = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Annonces')->getMarques($idCategorie);
						return $this->container->get('templating')->renderResponse('DjezClientBundle:Partial:marques.html.twig', array('carBrands' => $marques, ));

					}elseif ($queryAction == "MODELE") {

						$idMarque = $request->get('idMarque');
						$modeles = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Annonces')->getModeles($idMarque, $idCategorie);
						return $this->container->get('templating')->renderResponse('DjezClientBundle:Partial:modeles.html.twig', array('carModeles' => $modeles, ));
					}

				}else{

					//1. Get ccy from request
					$devise = $request->getSession()->get('devise');

					//2. Gestion de la barre de recherche rapide
					$categories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->getAllCategories();
					$subCategories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:SuperCategorie')->getAllSuperCategories();
					$prices = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Prix')->getAllPrices($devise);
					$localisation = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Localisation')->getAllLocalisation();

					return $this->render('DjezClientBundle:Client:vendre.html.twig', array(
						'categories' => $categories,
						'subCategories' => $subCategories,
						'prices' => $prices,
						'devise' => $devise,
						'selectedTab' => $selectedTab,
						'processingMsgType' => null,
						'processingMsg' => null,
						'places' => $localisation
						));
				}

			}


			private function enregistrerPhoto( $file, $uploaddir )
			{

				$logger = $this->get('logger');
				$translatorService = $this->get('translator');

				// Le fichier est corrompu
				if (!isset($file['error']) || is_array($file['error']))
				{
			    throw new Exception($translatorService->trans('error.file_corrupted_%name%',array('%name%' => $file['name'])), 1);
			  }
				// Une erreur s'est produite lors du transfert
				if($file['error'] === UPLOAD_ERR_INI_SIZE || $file['error'] === UPLOAD_ERR_FORM_SIZE)
				{
					throw new Exception($translatorService->trans('error.file_toobig_%name%',array('%name%' => $file['name'])), 1);
				}

				if($file['error'] !== UPLOAD_ERR_OK)
				{
					throw new Exception($translatorService->trans('error.file_transfer_%name%',array('%name%' => $file['name'])), 1);
				}
				// Fichier trop volumineux
				if ($file['size'] > self::MAXIMUM_FILES)
				{
	        	throw new Exception($translatorService->trans('error.file_toobig_%name%',array('%name%' => $file['name'])), 1);
	    	}
				// Verifier le contenu des fichier vs extentions
		    $finfo = finfo_open(FILEINFO_MIME_TYPE);
		    if (false === $ext = array_search(
		    	finfo_file($finfo, $file['tmp_name']),
		        array(
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
		            'gif' => 'image/gif',
		        ),
		        true
		    ))
				{
		        throw new Exception($translatorService->trans('error.file_content_vs_extention_%name%',array('%name%' => $file['name'])), 1);
		    }
				// Verification du nom du fichier
					$name = preg_replace("/[^A-Z0-9._-]/i", "_", $file["name"]);

				// Debut de la sauvegarde du fichier sur le server
				$logger->info('Saving pictures : '.$name);

					// Ne pas ecraser un fichier existant
				$logger->debug('Checking if file name already exist...');
					$i = 0;
					$parts = pathinfo($name);
					while (file_exists($uploaddir . "/" . $name))
				{
						$logger->debug('File name already exist generating new file name');
	 					$i++;
	 					$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
						$logger->debug('The new file name is : '.$name);
					}

				// Le nom definitif du fichier est crée
				$logger->info('File final name is : '.$name);

				// Sauvegarde du fichier sur le serveur
				$logger->info('Start copying file on server : ' . $name . ' ==> ' .$uploaddir);
				$success = move_uploaded_file($file["tmp_name"], $uploaddir . "/" . $name);
				if (!$success)
				{
						throw new Exception($translatorService->trans('error.saving_file_on_server_%name%',array('%name%' => $file['name'])), 1);
				}

				$logger->info('Copy done without error : '. $uploaddir . "/" . $name);

				// set proper permissions on the new file
				$logger->info('Updating file permissions to 0644 : '. $uploaddir . "/" . $name);
				chmod($uploaddir . "/" . $name, 0644);

				// Le fichier est bien sauvegardé sur le serveur
				$logger->info('File saved successfully on server : '. $uploaddir . "/" . $name);

				// On retourne le nom du fichier pour la sauvegarde en base
				return $name;
		}


			public function enregistrerAnnonceAction(){

					$logger = $this->get('logger');
					$selectedTab = 2;
					$translatorService = $this->get('translator');

					if (empty($_POST)) {
						$messageType = $translatorService->trans("custom_alert.error");
						$message = $translatorService->trans('error.empty_form');
						$logger->error('No data received from client side $_POST is empty');
					}else{
						//Obtention de la date courante
						date_default_timezone_set('UTC');
						$currentDate = new \DateTime(date('Y-m-d H:i:s'), new \DateTimeZone('Europe/Paris'));
						$uploaddir = $this->container->getParameter('upload_folder');

						try{
							// 1. Recuperation des champs du formulaire
							// Info basique de annonce
							$em = $this->getDoctrine()->getManager();
							$annonce = new Annonces;

							if (!isset($_POST['titre']) || strlen(trim($_POST['titre'])) == 0 ||
								  !isset($_POST['description']) || strlen(trim($_POST['description'])) == 0 ||
									!isset($_POST['prix']) || strlen(trim($_POST['prix'])) == 0 ||
									!isset($_POST['devise-annonce']) || strlen(trim($_POST['devise-annonce'])) == 0 ||
									!isset($_POST['categorie']) || strlen(trim($_POST['categorie'])) == 0)
									{
										$messageType = $translatorService->trans("custom_alert.error");
										$message = $translatorService->trans('error.champs_generique_requis');
										// Lever une exception pour arreter le processing et supprimer les fichiers déjà chargé
										$logger.debug('At least one of the following fields is not set : titre, description, prix, devise-annonce, categorie');
										$logger.debug('Stopping request processing');
										throw new Exception("Invalide data : titre, description, prix, devise-annonce, categorie", 1);
									}
							list($libelleSuperCategorie, $idCategorie) = split('-', $_POST['categorie']);
							if ($libelleSuperCategorie == 'VEHICULE' &&
								 (!isset($_POST['marque']) || strlen(trim($_POST['marque'])) == 0 ||
								  !isset($_POST['modele']) || strlen(trim($_POST['modele'])) == 0 ||
									!isset($_POST['annee']) || strlen(trim($_POST['annee'])) == 0 ||
									!isset($_POST['transmission']) || strlen(trim($_POST['transmission'])) == 0 ||
									!isset($_POST['puissance']) || strlen(trim($_POST['puissance'])) == 0 ||
									!isset($_POST['carburant']) || strlen(trim($_POST['carburant'])) == 0
								 ))
								 {
									 $messageType = $translatorService->trans("custom_alert.error");
									 $message = $translatorService->trans('error.champs_vehicule_requis');
									 // Lever une exception pour arreter le processing et supprimer les fichiers déjà chargé
									 $logger.debug('At least one of the following fields is not set : marque, modele, annee, transmission, puissance, carburant');
									 $logger.debug('Stopping request processing');
									 throw new Exception("Invalide data : marque, modele, annee, transmission, puissance, carburant", 1);
								 }
							if (!isset($_POST['typeAnnonceur']) || strlen(trim($_POST['typeAnnonceur'])) == 0 ||
	 								!isset($_POST['email']) || strlen(trim($_POST['email'])) == 0
								 )
								 {
									 $messageType = $translatorService->trans("custom_alert.error");
									 $message = $translatorService->trans('error.champs_annonceur_requis');
									 // Lever une exception pour arreter le processing et supprimer les fichiers déjà chargé
									 $logger.debug('At least one of the following fields is not set : typeAnnonceur, email');
									 $logger.debug('Stopping request processing');
									 throw new Exception("Invalide data : typeAnnonceur, email", 1);
								 }
							// Le formulaire est valide
							$logger->debug('Adds publication form has been validated');
							$logger->debug('Start setting entity field....');
							$logger->debug('TitreAnnonce -----> '. addcslashes($_POST['titre'],"%_"));
							$annonce->setTitreAnnonce(addcslashes($_POST['titre'],"%_"));

							$logger->debug('Description -----> '. addcslashes($_POST['description'],"%_"));
							$annonce->setDescriptionAnnonce(addcslashes($_POST['description'],"%_"));

							$logger->debug('PrixObjet -----> '. addcslashes($_POST['prix'],"%_"));
							$annonce->setPrixObjet(addcslashes($_POST['prix'],"%_"));

							if (isset($_POST['unite'])) {
								$logger->debug('unite -----> '. addcslashes($_POST['unite'],"%_"));
								$annonce->setUnitePrix(addcslashes($_POST['unite'],"%_"));
							}

							if (isset($_POST['negociable']))
							{

								$logger->debug('Negociable -----> true');
								$annonce->setNegociable(true);

							}else {

								$logger->debug('Negociable -----> false');
								$annonce->setNegociable(false);
							}

							if (isset($_POST['localisation']))
							{
								$localisationId = $_POST['localisation'];
								if ($localisationId === "OTHER") {
									if (isset($_POST['localisation-other'])) {
										$logger->debug('Localisation -----> '. addcslashes($_POST['localisation-other'],"%_"));
										$annonce->setLocalisation(addcslashes($_POST['localisation-other'],"%_"));
									}
								}else {
									$emplacement = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Localisation')->getLocalisation($localisationId);
									if (!is_null($emplacement)){
										$logger->debug('Localisation -----> '. $emplacement->getPays(). "-" .$emplacement->getVille());
										$annonce->setLocalisation($emplacement->getPays(). "-" .$emplacement->getVille());
									}
								}
							}

							$logger->debug('Devise -----> '. addcslashes($_POST['devise-annonce'],"%_"));
							$annonce->setDevise(addcslashes($_POST['devise-annonce'],"%_"));

							$logger->debug('TypeAnnonceur -----> '. addcslashes($_POST['typeAnnonceur'],"%_"));
							$annonce->setTypeAnnonceur(addcslashes($_POST['typeAnnonceur'],"%_"));

							$logger->debug('Email -----> '. addcslashes($_POST['email'],"%_"));
							$annonce->setEmailAnnonceur(addcslashes($_POST['email'],"%_"));

							if (isset($_POST['telephone']))
							{

								$logger->debug('Telephone -----> '. addcslashes($_POST['telephone'],"%_"));
								$annonce->setTelephoneAnnonceur(addcslashes($_POST['telephone'],"%_"));

							}
							$categorie = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->findOneByIdCategorie($idCategorie);
							$annonce->setCategorie($categorie->getLibelleCategorie());

							if ($libelleSuperCategorie == 'VEHICULE' ){
								$marque = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Marques')->findOneByIdMarque(addcslashes($_POST['marque'],"%_"));
								$modele = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Modeles')->findOneByIdModele(addcslashes($_POST['modele'],"%_"));
								$annonce->setModele($modele->getLibelleModele());
								$annonce->setMarque($marque->getLibelleMarque());

								$logger->debug('Annee -----> '. addcslashes($_POST['annee'],"%_"));
								$annonce->setAnnee(addcslashes($_POST['annee'],"%_"));

								$logger->debug('Transmission -----> '. addcslashes($_POST['transmission'],"%_"));
								$annonce->setTransmission(addcslashes($_POST['transmission'],"%_"));

								$logger->debug('Puissance -----> '. addcslashes($_POST['puissance'],"%_"));
								$annonce->setPuissance(addcslashes($_POST['puissance'],"%_"));

								$logger->debug('Carburant -----> '. addcslashes($_POST['carburant'],"%_"));
								$annonce->setCarburant(addcslashes($_POST['carburant'],"%_"));
							}

							$annonce->setDateCreation($currentDate);
							$annonce->setActif(true);


							// 2. Recuperation des photos
							// Recuperation de la photo d'accroche
							$accroche = "";
							if (isset($_POST['accroche'])) {
								$accroche = addcslashes($_POST['accroche'],"%_");
							}
							// Creation du sous repertoire de stockage s'il nexiste pas encore
							$uploaddir = $this->container->getParameter('upload_folder') . date('Ymd');
							$logger->debug('The upload directory is '. $uploaddir);
							if (!file_exists($uploaddir))
							{
								mkdir($uploaddir, 0755, true);
							}
							$logger->debug('Processing uploaded image files');
							$savedFiles= "";
							$accrocheFound = false;
							for ($i=1; $i < 6; $i++) {
								// Ci dessous le nom du champ du formulaire contenant la photo
								$nomDansFormulaire = "photo-".$i;
								$logger->debug('Processing file in form field '.$nomDansFormulaire);

								if (!empty($_FILES[$nomDansFormulaire]) && $_FILES[$nomDansFormulaire]['error'] !== UPLOAD_ERR_NO_FILE)
								{
										$logger->debug('A file has been found in form field '.$nomDansFormulaire);
										$file = $_FILES[$nomDansFormulaire];
										try
										{
											$fileName = $this->enregistrerPhoto($file, $uploaddir);
											$logger->debug('The file name is '. $fileName);

											// On enregistre le nom de la photo dans cette variable pour la supprimer si ca tourne mal
											$savedFiles .= " ".$fileName;
											$logger->debug('Adding file name to rollback list : '. $savedFiles);

											// Creation et renseignement de l'entité photo
											$logger->debug('Creating new photo entity to record image information');
											$photo = new Photos;

											$logger->debug('photo->nomUnique -----> ' . $fileName);
											$photo->setNomUnique($fileName);

											$logger->debug('photo->nomAffiche -----> ' . $fileName);
											$photo->setNomAffiche($fileName);

											$logger->debug('photo->repertoireStockage -----> ' . $uploaddir);
											$photo->setRepertoireStockage($uploaddir);

											$photo->setActif(true);
											$photo->setDateCreation($currentDate);
											// On verifie s'il sagit de la photo d'accroche
											if ($nomDansFormulaire === $accroche)
											{
												$logger->debug('photo->accroche -----> ' . $accroche);
												$photo->setAccroche(true);
												$accrocheFound = true;
											}
											// Enregistrer la photo dans annonce
											$logger->debug('Adding newly created photo instance to annonce entity');
											$photo->setAnnonce($annonce);
											$annonce->addPhoto($photo);
										} catch (Exception $e)
										{
											$logger->debug('An error occured during image file processing. Rollback saved files before propagating the exception....');
											$this->supprimerPhotos(trim($savedFiles), $uploaddir);
											throw new Exception($e->getMessage(), 1);
										}
									}else {
										$logger->debug('No file associated to '. $nomDansFormulaire);
									}
							}
					// Si aucune photo d'accrohe n'est trouvée et qu'au moins une photo a ete charge alors on prend la dernier comme accroche
					if (!$accrocheFound && isset($photo)) {
						$photo->setAccroche(true);
					}
					// Validation de la transaction
					$logger->debug('Persisting the add...');
					$em->persist($annonce);
					$em->flush();
					$logger->debug('Add have been persisted successfully!');
					$messageType = $translatorService->trans("custom_alert.information");
					$message = $translatorService->trans('add.save_success');
				} catch (Exception $e)
				{
					$logger->error($e->getMessage());
					// Get the error message from transcription file
					$messageType = $translatorService->trans("custom_alert.error");
					$message = $e->getMessage();
				}
			}
			$logger->debug('Preparing the rendering...');

			// Get ccy from request
			$devise = $this->getRequest()->getSession()->get('devise');
			$logger->debug('Currency has been retreived from request object : '.$devise);

			// Gestion de la barre de recherche rapide
			$categories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->getAllCategories();
			$subCategories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:SuperCategorie')->getAllSuperCategories();
			$prices = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Prix')->getAllPrices($devise);
			$localisation = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Localisation')->getAllLocalisation();

			return $this->render('DjezClientBundle:Client:vendre.html.twig', array(
				'categories' => $categories,
				'subCategories' => $subCategories,
				'prices' => $prices,
				'devise' => $devise,
				'selectedTab' => $selectedTab,
				'processingMsgType' => $messageType,
				'processingMsg' => $message,
				'places' => $localisation
				));
			}

			private function supprimerPhotos($listePhotos, $uploaddir)
			{
					if (strlen($listePhotos) === 0) {
						return;
					}
					$fileInfo = explode(' ', $listePhotos);
					foreach($fileInfo as $value)
					{
						unlink($uploaddir . "/" . $value);
					}
			}

		}
