document.addEventListener("DOMContentLoaded", function () {
    // Fermer la fenêtre d'alerte
    // Récupérer l'ID de l'alerte à partir du php
    let id = document.querySelector('#alertId').value;

    // console.log(id);
    function closeAlert(id) {

        let alertInfo = document.querySelector('.alert' + id);
        let iconClose = document.querySelector('#close' + id);

        iconClose.addEventListener('click', () => {
            alertInfo.style.display = 'none';
        });
    }
    // Appel de la fonction pour fermer l'alerte
    closeAlert(id);
    // Afficher la fenêtre d'alerte
    // function showAlert(id) {
    //     let alertInfo = document.querySelector('.alert' + id);
    //     alertInfo.style.display = 'block';
    // }
    // // Appel de la fonction pour afficher l'alerte
    // showAlert(id);
});