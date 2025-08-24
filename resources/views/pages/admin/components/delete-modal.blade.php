<!-- Modal de confirmation -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4" role="dialog" aria-modal="true" onclick="if(event.target === this) closeDeleteModal()">
    <!-- Contenu du modal -->
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 font-poppins" id="modal-title">
                Confirmer l'action
            </h3>
            <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
        </div>
        
        <!-- Corps -->
        <div class="p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <i data-lucide="alert-triangle" class="h-5 w-5 text-red-600" id="modal-icon"></i>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm text-gray-700 font-poppins" id="modal-message">
                        Êtes-vous sûr de vouloir continuer ? Cette action ne peut pas être annulée.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors font-poppins">
                Annuler
            </button>
            <form id="deleteForm" method="POST" action="" class="inline">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hover:focus:ring-red-500 transition-all font-poppins" id="modal-action-btn">
                    <span id="modal-btn-text">Confirmer</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openConfirmModal(url, message = null, actionType = 'delete', method = 'DELETE') {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const messageEl = document.getElementById('modal-message');
    const btnText = document.getElementById('modal-btn-text');
    const iconEl = document.getElementById('modal-icon');
    const actionBtn = document.getElementById('modal-action-btn');
    const methodInput = form.querySelector('input[name="_method"]');
    
    // Configuration de l'action
    form.action = url;
    if (methodInput) {
        methodInput.value = method;
    }
    
    // Configuration du message
    if (message) {
        messageEl.textContent = message;
    } else {
        messageEl.textContent = 'Êtes-vous sûr de vouloir continuer ?';
    }
    
    // Configuration du bouton et de l'icône selon le type d'action
    switch(actionType) {
        case 'approve':
            btnText.textContent = 'Approuver';
            iconEl.setAttribute('data-lucide', 'check');
            actionBtn.className = 'px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors font-poppins';
            iconEl.className = 'h-5 w-5 text-green-600';
            // Forcer le fond vert
            actionBtn.style.backgroundColor = '#16a34a';
            break;
        case 'reject':
            btnText.textContent = 'Rejeter';
            iconEl.setAttribute('data-lucide', 'x');
            actionBtn.className = 'px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors font-poppins';
            iconEl.className = 'h-5 w-5 text-red-600';
            // Forcer le fond rouge immédiatement
            actionBtn.style.backgroundColor = '#dc2626';
            break;
        case 'delete':
        default:
            btnText.textContent = 'Supprimer';
            iconEl.setAttribute('data-lucide', 'trash-2');
            actionBtn.className = 'px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors font-poppins';
            iconEl.className = 'h-5 w-5 text-red-600';
            // Forcer le fond rouge pour la suppression aussi
            actionBtn.style.backgroundColor = '#dc2626';
            break;
    }
    
    // Afficher le modal
    modal.classList.remove('hidden');
    
    // Empêcher le scroll du body
    document.body.style.overflow = 'hidden';
    
    // Initialiser les icônes Lucide dans le modal
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

// Fonction de compatibilité avec l'ancien nom
function openDeleteModal(url, message = null) {
    openConfirmModal(url, message, 'delete', 'DELETE');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    
    // Réactiver le scroll du body
    document.body.style.overflow = 'auto';
}

// Fermer le modal avec la touche Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>