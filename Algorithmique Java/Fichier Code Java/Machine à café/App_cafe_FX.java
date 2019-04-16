import java.util.Timer;
import java.util.TimerTask;

/**
 * @author François-Xavier COTE
 * @version 1.0
 */
public class App {

	// Constantes
	static final float TEMPERATURE_OPTIMALE_EAU_EN_DEGRE_CELSIUS = 92.5f;
	
	// Variables
	static String[] boissons = new String[4];
	static float temperatureEauEnDegreCelsius = 90f;
	static int quantiteCafeEnGramme = 9;
		
	public static void main(String[] args) {
			
		boissons[0] = "Caffè";
		boissons[1] = "Cappuccino";
		boissons[2] = "Caffè Latte";
		boissons[3] = "Caffè Macchiato";

		lancerTacheRecurrente();
		
		// Boucle infinie
		while (true) {
		
			afficherMenu();
		
			int choixCafe = demanderChoix("Faites votre choix svp", 1, 4);

			int choixVolume = demanderChoix("Tapez 1 pour court, 2 pour long", 1, 2);

			preparerCafe(choixCafe, choixVolume);

			afficherRemerciement();
			
		}
	}

	/**
	 * Toutes les huit secondes la méthode reduireAleatoirementTemperatureEau() est invoquée
	 */
	private static void lancerTacheRecurrente() {
		Timer timer = new Timer();
		timer.schedule(new TimerTask() {

			@Override
			public void run() {
				reduireAleatoirementTemperatureEau();
			}}, 0, 8000);
	
	}
	
	private static void reduireAleatoirementTemperatureEau() {
		if (Math.random()>0.5f) temperatureEauEnDegreCelsius -= 0.25f;
	}

	private static void afficherMenu() {
		System.out.println("Bienvenue sur la machine à café ");
		System.out.println("Quantité de café dans chaque tasse: " + quantiteCafeEnGramme + " grammes");
		System.out.println("Voici la liste des cafés proposés:");
		for (int i = 0; i < boissons.length; i++) {
			System.out.println((i+1) + ": " + boissons[i]);
		}
	}

	private static int demanderChoix(String message, int borneMin, int borneMax) {
		int valeur = 0;
		// Utilisation d'une boucle do while
		// Le code dans le do sera exécuté au moins une fois
		do {
			System.out.println(message);
			try {
				String saisie = Terminal.lireString();
				valeur = Integer.parseInt(saisie);
				if (valeur<borneMin || valeur>borneMax)
				{
					System.out.println("Merci de saisir un nombre compris entre " + borneMin + " et " + borneMax );
				}
			}
			catch (Exception e) 
			{
				System.out.println("Merci de saisir un nombre");
			}

		}
		while (!(valeur>=borneMin && valeur<=borneMax));
		return valeur;
	}
	
	private static void preparerCafe(int choixCafe, int choixVolume) {
		String nomCafePrepare = boissons[choixCafe-1];

		switch (choixVolume) {
		case 1:
			nomCafePrepare += " court";
			break;
		case 2:
			nomCafePrepare += " long";
		default:
			break;
		}

		System.out.println("Préparation de votre " + nomCafePrepare + " en cours");

		System.out.println("Température de l'eau: " + temperatureEauEnDegreCelsius + " °C");

		if (temperatureEauEnDegreCelsius<TEMPERATURE_OPTIMALE_EAU_EN_DEGRE_CELSIUS)
		{
			System.out.println("Chauffage de l'eau pour atteindre " + TEMPERATURE_OPTIMALE_EAU_EN_DEGRE_CELSIUS + " °C");
			while (temperatureEauEnDegreCelsius<TEMPERATURE_OPTIMALE_EAU_EN_DEGRE_CELSIUS)
			{
				chaufferEau();
			}
		}
		
		// boucle for: on définit les 3 «tions»: initialisation, condition, incrémentation
		for (int i = 0; i < 50; i++) {
			mettreApplicationEnVeille(50);
			System.out.print("|");
		}
		System.out.println("");
	}

	private static void chaufferEau() {
		mettreApplicationEnVeille(200);
		temperatureEauEnDegreCelsius += 0.25f;
	}

	private static void afficherRemerciement() {
		System.out.println("Voici votre café. Merci d'avoir utilisé la machine à café. Bonne dégustation\n");
		mettreApplicationEnVeille(3000);
	}
		
	private static void mettreApplicationEnVeille(int dureeEnMillisecondes)
	{
		try {
			Thread.sleep(dureeEnMillisecondes);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
}