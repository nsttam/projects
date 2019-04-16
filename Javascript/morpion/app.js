// => to disable the use strict waning in JSLint
/*jslint node: true */
// => to disable "document is not defined" in JShint
/* jshint browser: true */
// => to disable "unespected console statement" in ESLint
/* eslint-disable no-console*/
"use strict";


//Nombre de cases du carré
var squaresSize = 3;
//Déclaration de la variable permettant de connaitre le tour
var count = 0;

//Déclaration de la constante recupérant les cases sous forme de "tableau"
var squares = document.querySelectorAll(".square"),
    squaresLength = squares.length;

// Fonction pour vider la grille
function resetGrid() {
    count = 0;
    for (var i = 0; i < squaresLength; i++) {
        squares[i].innerHTML = "";
    }
}

//Affiche le vainqueur => 
//TODO : faire une mise en forme plus glamour !
function showWinner(value, condition = true) {
    // la condition sera utiliser que si on teste avec des boucles (ligne 70)
    if (condition) {
        alert("Le joueur " + value + " a gagné !");
        resetGrid();
    }
}


//Les tests => 
function win() {

    //==============================
    //ON PEUT TESTER TOUTES LES CONDITIONS !

//           //En ligne : 
//           if (squares[0].innerHTML !== "" && squares[0].innerHTML === squares[1].innerHTML && squares[1].innerHTML === squares[2].innerHTML) {
//               showWinner(squares[0].innerHTML);
//           } else if (squares[3].innerHTML !== "" && squares[3].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[5].innerHTML) {
//               showWinner(squares[3].innerHTML);
//           } else if (squares[6].innerHTML !== "" && squares[6].innerHTML === squares[7].innerHTML && squares[7].innerHTML === squares[8].innerHTML) {
//               showWinner(squares[6].innerHTML);
//           }
//
//            //En colonne : 
//            if (squares[0].innerHTML !== "" && squares[0].innerHTML === squares[3].innerHTML && squares[3].innerHTML === squares[6].innerHTML) {
//                showWinner(squares[0].innerHTML);
//            } else if (squares[1].innerHTML !== "" && squares[1].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[7].innerHTML) {
//                showWinner(squares[1].innerHTML);
//            } else if (squares[2].innerHTML !== "" && squares[2].innerHTML === squares[5].innerHTML && squares[5].innerHTML === squares[8].innerHTML) {
//                showWinner(squares[2].innerHTML);
//            }
//
//            //En diagonale : 
//            if (squares[0].innerHTML !== "" && squares[0].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[8].innerHTML) {
//                showWinner(squares[0].innerHTML);
//            } else if (squares[6].innerHTML !== "" && squares[6].innerHTML === squares[4].innerHTML && squares[4].innerHTML === squares[2].innerHTML) {
//                showWinner(squares[6].innerHTML);
//            }
        

    //==============================
    // OU AVEC DES BOUCLES
    for (var i = 0; i < squaresLength; i++) {
        var condition;
        // Gestion des victoires horizontales (il faut tester pour les cases 0, 3 et 6)
        if (i % 3 === 0) {
            condition = "squares[" + i + "].innerHTML !== '' ";
            for (var j = 1; j < squaresSize; j++) {
                condition += " && squares[" + i + "].innerHTML === squares[" + (i + j) + "].innerHTML ";
            }
            showWinner(squares[i].innerHTML, eval(condition));
        }


        // Gestion des victoires verticales (il faut tester pour les cases 0, 1 et 2)
        if (i < squaresSize) {
            condition = "squares[" + i + "].innerHTML !== '' ";
            for (j = 1; j < squaresSize; j++) {
                condition += " && squares[" + i + "].innerHTML === squares[" + (i + j * squaresSize) + "].innerHTML ";
            }
            showWinner(squares[i].innerHTML, eval(condition));

        }

        // Gestion des diagonales descendantes 
        switch (i) {
            case 0:
                condition = "squares[" + i + "].innerHTML !== '' ";
                for (j = 1; j < squaresSize; j++) {
                    condition += " && squares[" + i + "].innerHTML === squares[" + (i + j * (squaresSize + 1)) + "].innerHTML ";
                }

                break;

            case (squaresSize - 1):
                condition = "squares[" + i + "].innerHTML !== '' ";
                for (j = 1; j < squaresSize; j++) {
                    condition += " && squares[" + i + "].innerHTML === squares[" + (i + j * (squaresSize - 1)) + "].innerHTML ";
                }
                break;

        }

        // La fonction eval va permettre d'utiliser le contenu de condition (si on met juste condition, il testera son existence)
        showWinner(squares[i].innerHTML, eval(condition));
    }
}

// Ajoute la croix ou le rond uniquement si la case est vide puis test s'il y a victoire ou non => attention la fonction est en majuscule pour eviter l'erreur JSLint => 
function play() {
    // Si CETTE (this) case est vide 
    if (!this.innerHTML) {
        // J'augmente le compteur de un     
        count++;
        
        // Puis je calcule à qui le tour (nombre pair : O et nombre impair X)
        if (count % 2 === 0) {
            this.innerHTML = "O";
        } else {
            this.innerHTML = "X";
        }
        
        // J'arrete le jeu si le compteur est égal à 9
        if (count === 9) {
            // puis je lance une alerte et je vide la grille
            alert("Match nul !");
            resetGrid();
        } else {
            win(); // Lance la fonction win
        }
    }
}

// Au démarage, on boucle sur toutes les cases puis lance la fonction play au click
squares.forEach(function (e) {
    e.addEventListener("click", play);
});
//Le même code avec une autre une fonction fléchée 
//squares.forEach(element => element.addEventListener("click", play));
