/* ===== SCRIPT SPÉCIFIQUE PAGE CONTACT ===== */

// ===== FORMULAIRE DE CONTACT =====
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        // Validation en temps réel
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearFieldError(this);
            });
        });
        
        // Soumission du formulaire
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validation complète
            let isValid = true;
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            
            if (isValid) {
                // Afficher un indicateur de chargement
                const submitButton = contactForm.querySelector('.submit-button');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<span>Envoi en cours...</span><i class="icon-loading">⏳</i>';
                submitButton.disabled = true;
                
                // Soumettre le formulaire
                setTimeout(() => {
                    contactForm.submit();
                }, 500);
            }
        });
        
        // Affichage des messages de succès/erreur
        displayContactMessages();
    }
});

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';
    
    // Validation selon le type de champ
    switch(fieldName) {
        case 'prenom':
        case 'nom':
            if (!value) {
                isValid = false;
                errorMessage = 'Ce champ est obligatoire';
            }
            break;
            
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!value) {
                isValid = false;
                errorMessage = 'L\'email est obligatoire';
            } else if (!emailRegex.test(value)) {
                isValid = false;
                errorMessage = 'Format d\'email invalide';
            }
            break;
            
        case 'telephone':
            const phoneRegex = /^(\+221|00221)?[0-9\s\-\.]{8,}$/;
            if (value && !phoneRegex.test(value)) {
                isValid = false;
                errorMessage = 'Format de téléphone invalide';
            }
            break;
            
        case 'sujet':
            if (!value) {
                isValid = false;
                errorMessage = 'Veuillez choisir un sujet';
            }
            break;
            
        case 'message':
            if (!value) {
                isValid = false;
                errorMessage = 'Le message est obligatoire';
            } else if (value.length < 10) {
                isValid = false;
                errorMessage = 'Le message doit contenir au moins 10 caractères';
            }
            break;
            
        case 'rgpd':
            if (!field.checked) {
                isValid = false;
                errorMessage = 'Vous devez accepter l\'utilisation de vos données';
            }
            break;
    }
    
    // Affichage de l'erreur
    if (!isValid) {
        showFieldError(field, errorMessage);
    } else {
        clearFieldError(field);
    }
    
    return isValid;
}

function showFieldError(field, message) {
    clearFieldError(field);
    
    field.style.borderColor = '#e74c3c';
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.color = '#e74c3c';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
}

function clearFieldError(field) {
    field.style.borderColor = '';
    
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

function displayContactMessages() {
    const urlParams = new URLSearchParams(window.location.search);
    
    // Message de succès
    if (urlParams.get('succes')) {
        showNotification('Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.', 'success');
        
        // Nettoyer l'URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    
    // Messages d'erreur
    if (urlParams.get('erreur')) {
        const erreurs = decodeURIComponent(urlParams.get('erreur')).split('|');
        erreurs.forEach(erreur => {
            showNotification(erreur, 'error');
        });
        
        // Nettoyer l'URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        z-index: 10000;
        max-width: 400px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    if (type === 'success') {
        notification.style.background = '#27ae60';
    } else {
        notification.style.background = '#e74c3c';
    }
    
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animation d'entrée
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto-suppression
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 5000);
}

// ===== AMÉLIORATIONS UX POUR LE FORMULAIRE =====

// Auto-resize du textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('message');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    }
});

// Formatage automatique du numéro de téléphone
document.addEventListener('DOMContentLoaded', function() {
    const telInput = document.getElementById('telephone');
    if (telInput) {
        telInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            
            // Formater pour le Sénégal
            if (value.startsWith('221')) {
                value = '+' + value;
            } else if (value.startsWith('7') && value.length === 9) {
                value = '+221 ' + value;
            }
            
            this.value = value;
        });
    }
});

// Animation des cartes de contact au scroll
function animateContactCards() {
    const cards = document.querySelectorAll('.contact-card, .faq-item');
    
    cards.forEach((card, index) => {
        const rect = card.getBoundingClientRect();
        const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
        
        if (isVisible && !card.classList.contains('animated')) {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
                card.classList.add('animated');
            }, index * 100);
        }
    });
}

// Initialiser les animations
document.addEventListener('DOMContentLoaded', function() {
    // Préparer les cartes pour l'animation
    const cards = document.querySelectorAll('.contact-card, .faq-item');
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
    });
    
    // Démarrer les animations
    animateContactCards();
    window.addEventListener('scroll', animateContactCards);
});

// Validation en temps réel pour un meilleur UX
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            const email = this.value;
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            
            if (email.length > 5) {
                if (isValid) {
                    this.style.borderColor = '#27ae60';
                } else {
                    this.style.borderColor = '#e74c3c';
                }
            } else {
                this.style.borderColor = '';
            }
        });
    }
});

// Compteur de caractères pour le message
document.addEventListener('DOMContentLoaded', function() {
    const messageTextarea = document.getElementById('message');
    if (messageTextarea) {
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.cssText = `
            text-align: right;
            font-size: 0.875rem;
            color: var(--text-light);
            margin-top: 0.25rem;
        `;
        
        messageTextarea.parentNode.appendChild(counter);
        
        messageTextarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = `${length} caractères`;
            
            if (length < 10) {
                counter.style.color = '#e74c3c';
            } else if (length > 500) {
                counter.style.color = '#f39c12';
            } else {
                counter.style.color = '#27ae60';
            }
        });
    }
});

console.log('✅ Script contact.js chargé avec succès');
