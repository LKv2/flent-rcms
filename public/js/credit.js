document.addEventListener('DOMContentLoaded', function () {
    // Get references to the input fields
    const dateTraiteAchatInput = document.getElementById('date_traite_achat');
    const prixAchatInput = document.getElementById('prix_achat');
    const avanceAchatInput = document.getElementById('avance_achat');
    const dureeAchatInput = document.getElementById('duree_achat');

    // Get a reference to the field where you want to display the 'reste'
    const resteOutput = document.getElementById('reste');
    function calculateReste() {
        // Get values from the input fields
        const dateTraiteAchat = new Date(dateTraiteAchatInput.value);
        const prixAchat = parseFloat(prixAchatInput.value);
        const avanceAchat = parseFloat(avanceAchatInput.value);
        const dureeAchat = parseFloat(dureeAchatInput.value);
        console.log('dateTraiteAchat:', dateTraiteAchat);
        console.log('prixAchat:', prixAchat);
        // Calculate the 'reste' based on your formula
        const today = new Date();
        const monthsDifference = (today.getFullYear() - dateTraiteAchat.getFullYear()) * 12 + (today.getMonth() - dateTraiteAchat.getMonth());
        const monthlyPayment = (prixAchat / dureeAchat);
        const remainingPayment = prixAchat - (monthsDifference * monthlyPayment + avanceAchat);

        // Update the 'reste' field
        if (!isNaN(remainingPayment) && remainingPayment >= 0) {
            resteOutput.value = remainingPayment.toFixed(2).toString();
        } else {
            resteOutput.value = '0';
        }
    }
    // Add event listeners to the input fields
    dateTraiteAchatInput.addEventListener('change', calculateReste);
    prixAchatInput.addEventListener('change', calculateReste);
    avanceAchatInput.addEventListener('change', calculateReste);
    dureeAchatInput.addEventListener('change', calculateReste);



    // Call the function initially to display the 'reste' value
    calculateReste();
});