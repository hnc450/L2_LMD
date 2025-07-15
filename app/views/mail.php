<form id="monFormulaire">
  <input type="password" name="mdp" placeholder="Nom">
  <input type="password" name="confirm" placeholder="Email">
  <button type="submit">Envoyer</button>
</form>

<script>
    const formulaire = document.getElementById("monFormulaire");

formulaire.addEventListener("submit", function(e) {
  e.preventDefault(); // Empêche l'envoi classique du formulaire

  const formData = new FormData(formulaire);
 console.log(formData)
  // Exemple : afficher les données dans la console
//   formData.forEach((valeur, cle) => {
//     console.log(cle + " : " + valeur);
//   });

//   // Tu peux aussi convertir en objet :
//   const donnees = Object.fromEntries(formData.entries());
//   console.log(donnees);
});

</script>