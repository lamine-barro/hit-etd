/**
 * Système unifié de notifications toast pour Hub Ivoire Tech
 * 
 * Usage:
 * showToast('Message de succès', 'success')
 * showToast('Message d\'erreur', 'error')
 * showToast('Information', 'info')
 * showToast('Attention', 'warning')
 */

window.showToast = function(message, type = 'success', options = {}) {
    // Configuration par défaut
    const defaultOptions = {
        duration: type === 'error' ? 5000 : 3000,
        close: true,
        gravity: 'bottom',
        position: 'right',
        stopOnFocus: true,
        className: `hit-toast hit-toast-${type}`,
        offset: {
            x: 20,
            y: 20
        }
    };

    // Couleurs selon le type
    const colors = {
        success: '#059669',
        error: '#DC2626', 
        warning: '#D97706',
        info: '#2563EB'
    };

    // Configuration finale
    const config = {
        ...defaultOptions,
        ...options,
        text: message,
        backgroundColor: colors[type] || colors.success
    };

    // Afficher le toast
    Toastify(config).showToast();
};

// Fonction pour les notifications depuis les sessions Laravel
window.showSessionToasts = function() {
    // Cette fonction sera appelée automatiquement dans le layout
};

// Fonction pour copier du texte dans le presse-papiers avec notification
window.copyToClipboard = function(text, successMessage = 'Copié !') {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
            showToast(successMessage, 'success', { duration: 2000 });
        }).catch(() => {
            showToast('Erreur lors de la copie', 'error');
        });
    } else {
        // Fallback pour les navigateurs plus anciens
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showToast(successMessage, 'success', { duration: 2000 });
        } catch (err) {
            showToast('Erreur lors de la copie', 'error');
        } finally {
            textArea.remove();
        }
    }
};

// Auto-initialisation quand le DOM est prêt
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide des messages flash traditionnels s'ils existent encore
    const flashMessages = document.querySelectorAll('[role="alert"]');
    flashMessages.forEach(function(message) {
        setTimeout(function() {
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.5s ease-out';
            setTimeout(function() {
                message.remove();
            }, 500);
        }, 3000);
    });
}); 