fetch('https://api.example.com/resource/123', {
    method: 'DELETE',
})
.then(response => response.json())
.then(data => console.log('Suppression réussie :', data))
.catch(error => console.error('Erreur:', error));


fetch('https://api.example.com/resource/123', {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        name: 'Nouveau Nom',
        age: 30
    })
})
.then(response => response.json())
.then(data => console.log('Mise à jour réussie :', data))
.catch(error => console.error('Erreur:', error));
