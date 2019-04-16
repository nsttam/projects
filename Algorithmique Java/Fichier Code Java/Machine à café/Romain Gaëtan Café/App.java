
public class App {
	public static void main(String[] args) {
		int compteur = 0;
		boolean lait = false;
		boolean cafe = false;
		
		int boissonchoisi;
		int volumechoisi;
		int choixlait;
		int grainchoisi;
		int sucrechoisi;
		int paiementchoisi;
		
		String prixEnCts="";
		String choix[] = { "oui", "non" };
		String grain[] = { "Arabica", "Robusta" };
		String boissons[] = { "Cappucino", "Expresso", "Moccachino", "Thé" };
		String sucre[] = { "0", "1", "2", "3", "4" };
		String volume[] = { "court", "moyen", "long" };
		String paiement[] = { "espece", "Badge", "CB", "CB sans contact" };
		String boissonfinale[] = new String[7];

		System.out.println("Bonjour ,veuillez choisir votre boisson  :");
		for (String boisson : boissons) {
			compteur++;
			System.out.print(" " + compteur + ") " + boisson + " ");
		}
		compteur = 0;
		boissonchoisi = Terminal.lireInt();
		switch (boissonchoisi) {
		case 1:
			cafe = true;
			boissonfinale[0] = boissons[1];
			break;
		case 2:
			cafe = true;
			boissonfinale[0] = boissons[2];
			break;
		case 3:
			cafe = true;
			boissonfinale[0] = boissons[3];
			break;
		case 4:
			cafe = false;
			boissonfinale[0] = boissons[4];
			break;
		default:
			System.out.println("Ce choix est indisponible. ");
			break;
		}
		System.out.println("");
		if (cafe == true) {
			System.out.println("Choissisez le volume :");
			for (String vol : volume) {
				compteur++;
				System.out.print(" " + compteur + ") " + vol + " ");
			}
			volumechoisi = Terminal.lireInt();
			switch (volumechoisi) {
			case 1:
				lait = true;
				boissonfinale[1] = volume[1];
				prixEnCts ="20 cts";
				break;
			case 2:
				lait = true;
				boissonfinale[1] = volume[2];
				prixEnCts ="40 cts";
				break;
			case 3:
				lait = false;
				boissonfinale[1] = volume[3];
				prixEnCts ="50 cts";
				break;

			default:
				System.out.println("Ce choix est indisponible. ");
				break;
			}
			System.out.println("");
			compteur = 0;
			System.out.println("Choissisez le grain :");
			for (String gr : grain) {
				compteur++;
				System.out.print(" " + compteur + " " + gr + " ");
			}

			grainchoisi = Terminal.lireInt();
			switch (grainchoisi) {
			case 1:
				boissonfinale[2] = grain[0];
				break;
			case 2:
				boissonfinale[2] = grain[1];
				break;

			default:
				System.out.println("Ce choix est indisponible. ");
				break;
			}

		}
		compteur = 0;
		System.out.println("");
		if (lait = true) {
			System.out.println("Voulez vous du lait ?");
			for (String ouinon : choix) {
				compteur++;
				System.out.print(" " + compteur + ") " + ouinon + " ");

			}
			choixlait = Terminal.lireInt();
			switch (choixlait) {
			case 1:
				boissonfinale[3] = "Avec lait";
				break;
			case 2:
				boissonfinale[3] = "Sans lait";
				break;

			default:
				System.out.println("Ce choix est indisponible. ");
				break;
			}
		}
		compteur = 0;
		System.out.println("");
		System.out.println("Choissisez la dose de sucre :");
		for (String sc : sucre) {
			System.out.print(" " + compteur + ") " + sc + " sucre ");
			compteur++;
		}

		sucrechoisi = Terminal.lireInt();
		switch (sucrechoisi) {
		case 0:
			boissonfinale[4] = "Sans sucre";
			break;
		case 1:
			boissonfinale[4] = "1 sucre";
			break;
		case 2:
			boissonfinale[4] = "2 sucres";
			break;
		case 3:
			boissonfinale[4] = "3 sucres";
			break;
		case 4:
			boissonfinale[4] = "4 sucres";
			break;

		default:System.out.println("Ce choix est indisponible. ");
			
			break;
		}
		System.out.println("");
		System.out.println("Prix : "+prixEnCts);
		
		
		compteur = 0;
		System.out.println("");
		System.out.println("Choissisez le mode de paiement :");
		for (String paie : paiement) {
			compteur++;
			System.out.print(" " + compteur + ") " + paie + "");
			
		}
		
		paiementchoisi = Terminal.lireInt();
		switch (paiementchoisi) {
		
		case 1:
			boissonfinale[5] = paiement[0];
			break;
		case 2:
			boissonfinale[5] = paiement[1];
			break;
		case 3:
			boissonfinale[5] = paiement[2];
			break;
		case 4:
			boissonfinale[5] = paiement[3];
			break;

		default:System.out.println("Ce choix est indisponible. ");
			break;
		}
		System.out.println("");
		boissonfinale[6] = prixEnCts;
		for (String i : boissonfinale) {
			System.out.print(i + " ");
		}
		System.out.println("");
		
		System.out.println("Veuillez patienter : ");
		try {
			for (int i = 0; i <10; i++) {
				Thread.sleep(1000);
				System.out.print("*");
			}
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		System.out.println(" ");
		System.out.println("Servez vous ." );
	}
}
