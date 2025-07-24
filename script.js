document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Toggle menu mobile
    navToggle.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        navToggle.classList.toggle('active');
        
        // Animation des lignes du burger
        const lines = navToggle.querySelectorAll('.hamburger-line');
        if (navToggle.classList.contains('active')) {
            lines[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
            lines[1].style.opacity = '0';
            lines[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
        } else {
            lines[0].style.transform = 'none';
            lines[1].style.opacity = '1';
            lines[2].style.transform = 'none';
        }
    });

    // Fermer le menu au clic sur un lien
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
            navToggle.classList.remove('active');
            
            // Reset animation burger
            const lines = navToggle.querySelectorAll('.hamburger-line');
            lines[0].style.transform = 'none';
            lines[1].style.opacity = '1';
            lines[2].style.transform = 'none';
        });
    });

    // Fermer le menu au clic à l'extérieur
    document.addEventListener('click', function(e) {
        if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
            navMenu.classList.remove('active');
            navToggle.classList.remove('active');
            
            // Reset animation burger
            const lines = navToggle.querySelectorAll('.hamburger-line');
            lines[0].style.transform = 'none';
            lines[1].style.opacity = '1';
            lines[2].style.transform = 'none';
        }
    });
});

// ===== GESTION DU SCROLL =====
window.addEventListener('scroll', function() {
    const header = document.querySelector('.site-header');
    
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// ===== ANIMATIONS AU SCROLL =====
function animateOnScroll() {
    const elements = document.querySelectorAll('.category-card, .service-item, .about-content, .hero-content');
    
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < window.innerHeight - elementVisible) {
            element.classList.add('animate');
        }
    });
}

window.addEventListener('scroll', animateOnScroll);
document.addEventListener('DOMContentLoaded', animateOnScroll);

// ===== GESTION DU PANIER =====
document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('modal-panier');
  var closeBtn = document.querySelector('.close-modal-panier');
  var form = document.getElementById('form-ajout-panier');
  var quantiteInput = document.getElementById('modal-quantite');
  var nomTitre = document.getElementById('modal-produit-nom');
  var nomInput = document.getElementById('modal-produit-nom-input');
  var idInput = document.getElementById('modal-produit-id');
  var prixInput = document.getElementById('modal-produit-prix');
  var cartCount = document.getElementById('cart-count');

  document.querySelectorAll('.btn-ajouter-panier').forEach(function(btn) {
    btn.addEventListener('click', function() {
      nomTitre.textContent = btn.getAttribute('data-nom');
      nomInput.value = btn.getAttribute('data-nom');
      idInput.value = btn.getAttribute('data-id');
      prixInput.value = btn.getAttribute('data-prix');
      quantiteInput.value = 1;
      modal.style.display = 'block';
    });
  });

  closeBtn.onclick = function() {
    modal.style.display = 'none';
  };
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };

  form.onsubmit = function(e) {
    e.preventDefault();
    var formData = new FormData(form);
    formData.append('action', 'ajouter');
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'traitement-panier.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onload = function() {
      if (xhr.status === 200) {
        try {
          var data = JSON.parse(xhr.responseText);
          if (data && data.nbArticles !== undefined && cartCount) {
            cartCount.textContent = data.nbArticles;
          }
        } catch (e) {}
        modal.style.display = 'none';
      }
    };
    xhr.send(formData);
  };
});

// ===== SMOOTH SCROLL POUR LES ANCRES =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ===== LAZY LOADING POUR LES IMAGES =====
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ===== GESTION DES DROPDOWNS =====
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const dropdownContent = dropdown.querySelector('.dropdown-content');
        let timeoutId;
        
        dropdown.addEventListener('mouseenter', function() {
            clearTimeout(timeoutId);
            dropdownContent.style.opacity = '1';
            dropdownContent.style.visibility = 'visible';
            dropdownContent.style.transform = 'translateY(0)';
        });
        
        dropdown.addEventListener('mouseleave', function() {
            timeoutId = setTimeout(() => {
                dropdownContent.style.opacity = '0';
                dropdownContent.style.visibility = 'hidden';
                dropdownContent.style.transform = 'translateY(-10px)';
            }, 100);
        });
    });
});

// ===== RECHERCHE EN TEMPS RÉEL (pour future implémentation) =====
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ===== UTILITAIRES =====
const Utils = {
    // Formatter les prix
    formatPrice: function(price) {
        return new Intl.NumberFormat('fr-SN', {
            style: 'currency',
            currency: 'XOF',
            currencyDisplay: 'code'
        }).format(price).replace('XOF', 'FCFA');
    },
    
    // Capitaliser la première lettre
    capitalize: function(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    },
    
    // Générer un ID unique
    generateId: function() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    },
    
    // Vérifier si un élément est visible
    isElementInViewport: function(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
};

// ===== CSS DYNAMIQUE POUR LES ANIMATIONS =====
const style = document.createElement('style');
style.textContent = `
    .header-scrolled {
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
    }
    
    .animate {
        opacity: 1;
        transform: translateY(0);
        transition: all 0.6s ease;
    }
    
    .category-card:not(.animate),
    .service-item:not(.animate),
    .about-content:not(.animate),
    .hero-content:not(.animate) {
        opacity: 0;
        transform: translateY(30px);
    }
    
    .lazy {
        filter: blur(5px);
        transition: filter 0.3s;
    }
    
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
`;
document.head.appendChild(style);

// ===== LOGS POUR DEBUG (à supprimer en production) =====
console.log('Déco Élégance - Site initialisé avec succès ✅');

// Export pour usage externe
window.DecoElegance = {
    utils: Utils
};

// ===== FILTRES PORTFOLIO (Page Réalisations) =====
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    if (filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Mettre à jour les boutons actifs
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Filtrer les éléments
                portfolioItems.forEach(item => {
                    if (filter === '*' || item.classList.contains(filter.substring(1))) {
                        item.style.display = 'block';
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }
});

// ===== EFFET AVANT/APRÈS INTERACTIF =====
document.addEventListener('DOMContentLoaded', function() {
    const beforeAfterContainers = document.querySelectorAll('.before-after-container');
    
    beforeAfterContainers.forEach(container => {
        const beforeAfter = container.querySelector('.before-after');
        const after = container.querySelector('.after');
        const handle = container.querySelector('.slider-handle');
        
        if (!beforeAfter || !after || !handle) {
            console.warn('Éléments avant-après manquants:', {beforeAfter, after, handle});
            return;
        }
        
        let isDragging = false;
        
        // Position initiale à 50%
        updatePosition(50);
        
        // Fonction pour mettre à jour la position
        function updatePosition(percentage) {
            percentage = Math.max(0, Math.min(100, percentage));
            after.style.clipPath = `polygon(${percentage}% 0%, 100% 0%, 100% 100%, ${percentage}% 100%)`;
            handle.style.left = `${percentage}%`;
        }
        
        // Fonction pour obtenir le pourcentage à partir des coordonnées X
        function getPercentageFromX(x) {
            const rect = beforeAfter.getBoundingClientRect();
            return ((x - rect.left) / rect.width) * 100;
        }
        
        // Événements de souris
        handle.addEventListener('mousedown', (e) => {
            isDragging = true;
            e.preventDefault();
            document.body.style.userSelect = 'none';
        });
        
        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                const percentage = getPercentageFromX(e.clientX);
                updatePosition(percentage);
            }
        });
        
        document.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                document.body.style.userSelect = '';
            }
        });
        
        // Événements tactiles
        handle.addEventListener('touchstart', (e) => {
            isDragging = true;
            e.preventDefault();
        });
        
        document.addEventListener('touchmove', (e) => {
            if (isDragging && e.touches.length > 0) {
                e.preventDefault();
                const touch = e.touches[0];
                const percentage = getPercentageFromX(touch.clientX);
                updatePosition(percentage);
            }
        });
        
        document.addEventListener('touchend', () => {
            isDragging = false;
        });
        
        // Clic sur le conteneur pour déplacer le curseur
        beforeAfter.addEventListener('click', (e) => {
            if (e.target !== handle && !handle.contains(e.target)) {
                const percentage = getPercentageFromX(e.clientX);
                updatePosition(percentage);
            }
        });
        
        // Empêcher la sélection de texte pendant le glissement
        beforeAfter.addEventListener('selectstart', (e) => {
            if (isDragging) e.preventDefault();
        });
    });
});
