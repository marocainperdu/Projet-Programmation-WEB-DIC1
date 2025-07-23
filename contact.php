<?php include 'header.php'; ?>

    <!-- CSS spécifique à la page Contact -->
    <link rel="stylesheet" href="contact-style.css">
    
    <!-- Script spécifique à la page Contact -->
    <script src="contact-script.js" defer></script>

    <!-- Bannière Contact -->
    <section class="page-hero">
        <div class="hero-overlay">
            <div class="container">
                <h1>Contactez-nous</h1>
                <p class="hero-breadcrumb">
                    <a href="index.php">Accueil</a> &gt; Contact
                </p>
            </div>
        </div>
    </section>

    <!-- Section Informations de contact -->
    <section class="contact-info-section">
        <div class="container">
            <div class="section-header">
                <h2>Nos Coordonnées</h2>
                <p>Nous sommes à votre disposition pour tous vos projets de décoration</p>
            </div>
            
            <div class="contact-info-grid">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="icon-location"></i>
                    </div>
                    <h3>Nos Showrooms</h3>
                    <div class="contact-details">
                        <p><strong>Showroom Almadies</strong><br>
                        Rue de la Corniche Ouest<br>
                        Almadies, Dakar - Sénégal</p>
                        
                        <p><strong>Boutique Plateau</strong><br>
                        Avenue Georges Pompidou<br>
                        Plateau, Dakar - Sénégal</p>
                    </div>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="icon-phone"></i>
                    </div>
                    <h3>Téléphone</h3>
                    <div class="contact-details">
                        <p><strong>Standard :</strong><br>
                        <a href="tel:+221338245678">+221 33 824 56 78</a></p>
                        
                        <p><strong>Conseil déco :</strong><br>
                        <a href="tel:+221776543210">+221 77 654 32 10</a></p>
                        
                        <p><strong>Service client :</strong><br>
                        <a href="tel:+221701234567">+221 70 123 45 67</a></p>
                    </div>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="icon-email"></i>
                    </div>
                    <h3>Email</h3>
                    <div class="contact-details">
                        <p><strong>Contact général :</strong><br>
                        <a href="mailto:contact@deco-elegance.sn">contact@deco-elegance.sn</a></p>
                        
                        <p><strong>Devis & projets :</strong><br>
                        <a href="mailto:devis@deco-elegance.sn">devis@deco-elegance.sn</a></p>
                        
                        <p><strong>Service après-vente :</strong><br>
                        <a href="mailto:sav@deco-elegance.sn">sav@deco-elegance.sn</a></p>
                    </div>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="icon-clock"></i>
                    </div>
                    <h3>Horaires d'ouverture</h3>
                    <div class="contact-details">
                        <p><strong>Lundi - Vendredi :</strong><br>
                        9h00 - 19h00</p>
                        
                        <p><strong>Samedi :</strong><br>
                        9h00 - 17h00</p>
                        
                        <p><strong>Dimanche :</strong><br>
                        10h00 - 16h00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Formulaire de contact -->
    <section class="contact-form-section">
        <div class="container">
            <div class="contact-form-content">
                <div class="form-info">
                    <h2>Envoyez-nous un message</h2>
                    <p class="form-intro">Vous avez un projet de décoration ? Une question sur nos produits ? Notre équipe vous répond sous 24h.</p>
                    
                    <div class="form-benefits">
                        <div class="benefit-item">
                            <i class="icon-check"></i>
                            <span>Réponse garantie sous 24h</span>
                        </div>
                        <div class="benefit-item">
                            <i class="icon-check"></i>
                            <span>Conseil personnalisé gratuit</span>
                        </div>
                        <div class="benefit-item">
                            <i class="icon-check"></i>
                            <span>Devis détaillé offert</span>
                        </div>
                    </div>
                    
                    <div class="social-contact">
                        <h4>Suivez-nous aussi sur :</h4>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="icon-facebook"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="icon-instagram"></i>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-link" aria-label="Pinterest">
                                <i class="icon-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <form id="contactForm" action="traitement-contact.php" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="prenom">Prénom *</label>
                                <input type="text" id="prenom" name="prenom" required>
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom *</label>
                                <input type="text" id="nom" name="nom" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="tel" id="telephone" name="telephone">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="sujet">Sujet de votre demande *</label>
                            <select id="sujet" name="sujet" required>
                                <option value="">Choisissez un sujet</option>
                                <option value="devis">Demande de devis</option>
                                <option value="conseil">Conseil en décoration</option>
                                <option value="produit">Question sur un produit</option>
                                <option value="livraison">Livraison et expédition</option>
                                <option value="sav">Service après-vente</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="budget">Budget approximatif (optionnel)</label>
                            <select id="budget" name="budget">
                                <option value="">Sélectionnez votre budget</option>
                                <option value="moins-100k">Moins de 100 000 FCFA</option>
                                <option value="100k-300k">100 000 - 300 000 FCFA</option>
                                <option value="300k-500k">300 000 - 500 000 FCFA</option>
                                <option value="500k-1m">500 000 FCFA - 1 000 000 FCFA</option>
                                <option value="plus-1m">Plus de 1 000 000 FCFA</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Votre message *</label>
                            <textarea id="message" name="message" rows="6" placeholder="Décrivez-nous votre projet, vos besoins ou posez-nous votre question..." required></textarea>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="newsletter" name="newsletter" value="1">
                                <span class="checkmark"></span>
                                Je souhaite recevoir la newsletter avec les dernières tendances déco
                            </label>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="rgpd" name="rgpd" value="1" required>
                                <span class="checkmark"></span>
                                J'accepte que mes données soient utilisées pour traiter ma demande *
                            </label>
                        </div>
                        
                        <button type="submit" class="submit-button">
                            <span>Envoyer le message</span>
                            <i class="icon-send"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Carte et localisation -->
    <section class="map-section">
        <div class="container">
            <div class="section-header">
                <h2>Nous Trouver</h2>
                <p>Visitez nos showrooms pour découvrir nos collections</p>
            </div>
            
            <div class="map-content">
                <div class="map-container">
                    <!-- Ici vous pourrez intégrer Google Maps ou OpenStreetMap -->
                    <div class="map-placeholder">
                        <div class="map-info">
                            <i class="icon-location"></i>
                            <h3>Showroom Principal - Almadies</h3>
                            <p>Rue de la Corniche Ouest<br>Almadies, Dakar</p>
                            <a href="https://maps.google.com/" target="_blank" class="map-link">
                                Voir sur Google Maps
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="location-info">
                    <h3>Accès et transport</h3>
                    <div class="transport-options">
                        <div class="transport-item">
                            <i class="icon-car"></i>
                            <div>
                                <h4>En voiture</h4>
                                <p>Parking gratuit disponible devant nos showrooms. Accès facile depuis l'autoroute A1.</p>
                            </div>
                        </div>
                        
                        <div class="transport-item">
                            <i class="icon-bus"></i>
                            <div>
                                <h4>En transport public</h4>
                                <p>Lignes de bus 8, 15, 23. Arrêt "Corniche Almadies" à 2 minutes à pied.</p>
                            </div>
                        </div>
                        
                        <div class="transport-item">
                            <i class="icon-delivery"></i>
                            <div>
                                <h4>Livraison à domicile</h4>
                                <p>Service de livraison gratuit dès 250 000 FCFA dans tout Dakar et sa banlieue.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section FAQ rapide -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Questions Fréquentes</h2>
                <p>Les réponses aux questions les plus courantes</p>
            </div>
            
            <div class="faq-grid">
                <div class="faq-item">
                    <h4>Quels sont vos délais de livraison ?</h4>
                    <p>Nos délais de livraison sont de 3 à 7 jours ouvrés pour Dakar et sa banlieue, et de 7 à 14 jours pour le reste du Sénégal.</p>
                </div>
                
                <div class="faq-item">
                    <h4>Proposez-vous un service de montage ?</h4>
                    <p>Oui, nous proposons un service de montage et d'installation pour tous nos meubles. Nos techniciens se déplacent à domicile.</p>
                </div>
                
                <div class="faq-item">
                    <h4>Puis-je échanger un article ?</h4>
                    <p>Vous avez 15 jours pour échanger un article non défectueux, dans son emballage d'origine et avec sa facture.</p>
                </div>
                
                <div class="faq-item">
                    <h4>Faites-vous du conseil en décoration ?</h4>
                    <p>Absolument ! Nos designers offrent des consultations à domicile pour vous aider à créer l'intérieur de vos rêves.</p>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
