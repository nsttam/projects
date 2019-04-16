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
		boolean estPresentDansTirage = false;
		int passage = 0;
	    boolean permutation = true;
		
		// Constantes
		int BORNE_MIN = 1;
		int BORNE_MAX = 49;
		
		for (int i = 0; i < grille.length; i++) {
			do {
				estPresentDansGrille = false;
				Terminal.ecrireString("Num�ro " + (i+1) + " : Entrez un nombre compris entre " + BORNE_MIN + " et " + BORNE_MAX + " : ");
				valeurSaisie = Terminal.lireString();
				
				try {
					// Essaie de convertir le string en nombre entier
					numeroSaisi = Integer.parseInt(valeurSaisie);
				}
				catch (Exception e) {
					// Si la conversion n'est pas possible on aboutit ici
					Terminal.ecrireStringln("Merci de saisir un nombre entier !");
				} 
				
				// Est-ce que le num�ro saisi est d�j� dans la grille ?
				// On parcourt le tableau grille pour le savoir
				for (int j = 0; j <= i; j++) {
					if (grille[j]==numeroSaisi) {
						estPresentDansGrille = true;
						Terminal.ecrireStringln("Num�ro d�j� pr�sent dans votre grille");
						break;
					}
				}
				
			} while (!(numeroSaisi>=BORNE_MIN && numeroSaisi<BORNE_MAX && !estPresentDansGrille));
			// On place dans la case i du tableau grille le num�ro saisi
			grille[i] = numeroSaisi;
		}
		
		// On trie la grille (voir http://lwh.free.fr/pages/algo/tri/tri.htm pour plus d'info)
		while ( permutation) {
			permutation = false;
			passage ++;
			for (int i=0; i<grille.length-passage; i++) {
				if (grille[i]>grille[i+1]){
					permutation = true;
					Terminal.ecrireStringln("permutation sur " + i);
					// on echange les deux elements
					int temp = grille[i];
					grille[i] = grille[i+1];
					grille[i+1] = temp;
				}
			}
		}

		// On affiche la grille tri�e
		Terminal.ecrireString("Voici votre grille :");
		for (int i = 0; i < grille.length; i++) {
			Terminal.ecrireString(" " + grille[i]);
			if (i<grille.length-1) Terminal.ecrireString(",");
		}
				

		// On effectue le tirage devant un huissier de justice
		for (int i = 0; i < tirage.length; i++) {
			do {
				estPresentDansTirage = false;
				// Le nombre al�atoire sera compris entre la borne min et la borne max inclue
				int nbAleatoire = BORNE_MIN + random.nextInt(BORNE_MAX);
				
				// Est-ce que le num�ro choisi al�atoirement est d�j� dans tirage ?
				// On parcourt le tableau tirage pour le savoir
				for (int j = 0; j < i; j++) {
					if (tirage[j]==nbAleatoire) {
						// Java arrive dans ce bloc car le num�ro choisi al�atoirement est d�j� pr�sent dans le tableau tirage
						estPresentDansTirage = true;
						// inutile de poursuivre dans la boucle, on sort de la boucle avec l'instruction break
						break;
					}
				}
				// Si le nombre al�atoire n'est pas pr�sent dans le tableau tirage, on l'ajoute au tableau tirage
				if (estPresentDansTirage==false) tirage[i] = nbAleatoire;
				
			} while (estPresentDansTirage);
		}
		Terminal.ecrireStringln("");
		
		// On affiche le tirage
		Terminal.ecrireString("Voici le tirage :");
		for (int i = 0; i < tirage.length; i++) {
			Terminal.ecrireString(" " + tirage[i]);
			if (i<tirage.length-1) Terminal.ecrireString(",");
		}
	}
}