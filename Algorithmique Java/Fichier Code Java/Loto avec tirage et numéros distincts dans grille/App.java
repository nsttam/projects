import java.util.Random;

public class App {

	public static void main(String[] args) {
		// Variables
		int[] grille = new int[5];
		int[] tirage = new int[5];
		int numeroSaisi = 0;
		String valeurSaisie = null;
		Random random = new Random();
		boolean estPresentDansGrille = false;
		
		// Constantes
		int BORNE_MIN = 1;
		int BORNE_MAX = 49;
		
		for (int i = 0; i < grille.length; i++) {
			do {
				estPresentDansGrille = false;
				Terminal.ecrireString("Numéro " + (i+1) + " : Entrez un nombre compris entre " + BORNE_MIN + " et " + BORNE_MAX + " : ");
				valeurSaisie = Terminal.lireString();
				
				try {
					// Essaie de convertir le string en nombre entier
					numeroSaisi = Integer.parseInt(valeurSaisie);
				}
				catch (Exception e) {
					// Si la conversion n'est pas possible on aboutit ici
					Terminal.ecrireStringln("Merci de saisir un nombre entier !");
				} 
				
				// Est-ce que le numéro saisi est déjà dans la grille ?
				for (int j = 0; j <= i; j++) {
					if (grille[j]==numeroSaisi) {
						estPresentDansGrille = true;
						Terminal.ecrireStringln("Numéro déjà présent dans votre grille");
						break;
					}
				}
				
			} while (!(numeroSaisi>=BORNE_MIN && numeroSaisi<BORNE_MAX && !estPresentDansGrille));
			// On place dans la case i du tableau grille le numéro saisi
			grille[i] = numeroSaisi;
		}
		
		Terminal.ecrireString("Voici votre grille :");
		for (int i = 0; i < grille.length; i++) {
			Terminal.ecrireString(" " + grille[i]);
			if (i<grille.length-1) Terminal.ecrireString(",");
		}
		
		for (int i = 0; i < tirage.length; i++) {
			tirage[i] = BORNE_MIN + random.nextInt(BORNE_MAX);
		}

		Terminal.ecrireStringln("");
		
		Terminal.ecrireString("Voici le tirage :");
		for (int i = 0; i < tirage.length; i++) {
			Terminal.ecrireString(" " + tirage[i]);
			if (i<tirage.length-1) Terminal.ecrireString(",");
		}

	}

}
