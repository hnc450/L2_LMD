document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne tous les boutons de suppression
    document.querySelectorAll('.btn-icon.delete').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const userId = this.getAttribute('data-user-id');
            if (!userId) return;

            if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
                fetch(`/administration/delete/user/${userId}`, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        // Optionnel : rafraîchir la page ou retirer la ligne du tableau
                        location.reload();
                    } else {
                        alert("Erreur lors de la suppression de l'utilisateur.");
                    }
                })
                .catch(() => alert("Erreur réseau lors de la suppression."));
            }
        });
    });
});
