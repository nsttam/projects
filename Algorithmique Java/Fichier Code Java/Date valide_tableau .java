
public class App {

	public static void main(String[] args) {
		// on declare une variable jour en chiffre :
		int jour = 0;
		// on declare une variable mois en chiffre :
		int mois = 0;
		// on declare une variable annee en chiffre :
		int annee = 0;
		// on declre une variable pour annee bisextile  booleen :
		boolean estBisextile = false;
		// on declare une variable pour le nbrDeJour :
		// on declare une variable pour le nummois :
		int[] nDJ = { 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 };

		// on rentre le jour de la date
		Terminal.ecrireStringln("  entrez votre date");
		Terminal.ecrireString("jour :");
		// on ecris le jour de la date et on le lis
		jour = Terminal.lireInt();
		// on rentre le mois de la date
		Terminal.ecrireString("mois :");
		// on ecris et lis le mois de la date
		mois = Terminal.lireInt();
		// on rentre l'année de la date
		Terminal.ecrireString("année :");
		// on ecris et lis la date de l'année
		annee = Terminal.lireInt();

		// on verifie si l'année est bisextile ?
		if (annee % 4 == 0 && annee % 100 != 0) {
			estBisextile = true;
		}
		else if(annee % 400 == 0) {
			estBisextile = true;
		}
		// si année bisextile : +1 a la valeur du noMois 1 sinon valeur =0
		if (estBisextile == true) {
			nDJ[1] = nDJ[1] + 1;}
		// pour savoir si l’annee est valide
		// on dis que dans tout les cas si le mois est au dessus de 12 et inferieur à 1
		// et le jour au dessus de 31 et en dessous de 1 c’est pas valide
		//if(jour<=nDJ [mois-1] && jour >= 1 && mois <= 12 && mois >= 1) {
		if(mois <= 12 && jour<=nDJ [mois-1] && jour >= 1 && mois >= 1) {
			Terminal.ecrireStringln("Date Valide !");
		} else {
				Terminal.ecrireStringln("Date Non Valide !");
				
				
			}
		}
		
		

	}

