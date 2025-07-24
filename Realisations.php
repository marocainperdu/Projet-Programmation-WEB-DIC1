<?php include('header.php'); ?>

<!-- Hero Section Réalisations -->
<section class="realisations-hero">
    <div class="container">
        <h1>Nos Réalisations</h1>
        <p class="hero-subtitle">Découvrez nos projets de décoration qui allient modernité et tradition sénégalaise</p>
    </div>
</section>

<!-- Portfolio des réalisations -->
<section class="portfolio-content">
    <div class="container">
        <!-- Filtres par catégorie -->
        <div class="portfolio-filters">
            <button class="filter-btn active" data-filter="*">Tous les projets</button>
            <button class="filter-btn" data-filter=".salon">Salons</button>
            <button class="filter-btn" data-filter=".chambre">Chambres</button>
            <button class="filter-btn" data-filter=".cuisine">Cuisines</button>
            <button class="filter-btn" data-filter=".terrasse">Terrasses</button>
            <button class="filter-btn" data-filter=".bureau">Bureaux</button>
        </div>

        <!-- Grille des réalisations -->
        <div class="portfolio-grid">
            <!-- Projet 1 - Salon Villa Almadies -->
            <div class="portfolio-item salon">
                <div class="project-card">
                    <div class="before-after-container">
                        <div class="before-after">
                            <div class="before">
                                <img src="images/avant1.jpg" alt="Salon avant transformation - Villa Almadies" />
                                <div class="label">AVANT</div>
                            </div>
                            <div class="after">
                                <img src="images/apres1.jpg" alt="Salon après transformation - Villa Almadies" />
                                <div class="label">APRÈS</div>
                            </div>
                            <div class="slider-handle"></div>
                        </div>
                    </div>
                    <div class="project-info">
                        <div class="project-category">Salon</div>
                        <h3>Villa Moderne aux Almadies</h3>
                        <p>Transformation complète d'un salon classique en espace contemporain africain. Intégration de textiles wax, mobilier moderne et art sénégalais pour créer un environnement chaleureux et sophistiqué.</p>
                        <div class="project-details">
                            <span><strong>Lieu :</strong> Almadies, Dakar</span>
                            <span><strong>Durée :</strong> 3 semaines</span>
                            <span><strong>Budget :</strong> 2 500 000 FCFA</span>
                        </div>
                        <a href="realisation-villa-almadies.php" class="view-details">Voir les détails</a>
                    </div>
                </div>
            </div>

            <!-- Projet 2 - Chambre Bohème -->
            <div class="portfolio-item chambre">
                <div class="project-card">
                    <div class="before-after-container">
                        <div class="before-after">
                            <div class="before">
                                <img src="images/avant2.jpg" alt="Chambre avant transformation" />
                                <div class="label">AVANT</div>
                            </div>
                            <div class="after">
                                <img src="images/apres2.jpg" alt="Chambre après transformation" />
                                <div class="label">APRÈS</div>
                            </div>
                            <div class="slider-handle"></div>
                        </div>
                    </div>
                    <div class="project-info">
                        <div class="project-category">Chambre</div>
                        <h3>Chambre Bohème Africaine</h3>
                        <p>Création d'une ambiance bohème chic avec matières naturelles, luminaires en rotin et textiles traditionnels. Un cocon de fraîcheur adapté au climat tropical.</p>
                        <div class="project-details">
                            <span><strong>Lieu :</strong> Plateau, Dakar</span>
                            <span><strong>Durée :</strong> 2 semaines</span>
                            <span><strong>Budget :</strong> 1 800 000 FCFA</span>
                        </div>
                        <a href="realisation-chambre-boheme.php" class="view-details">Voir les détails</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section témoignages -->
        <section class="testimonials">
            <h2>Ce que disent nos clients</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"Déco Élégance a transformé notre villa aux Almadies en véritable havre de paix. L'équipe a su allier notre goût pour la modernité avec des touches authentiquement sénégalaises."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/client-aminata.jpg" alt="Aminata Diallo" />
                        <div>
                            <strong>Aminata Diallo</strong>
                            <span>Directrice Marketing, Almadies</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"Professionnalisme, créativité et respect des délais. Notre bureau au Point E reflète maintenant parfaitement nos valeurs d'entreprise. Nous recommandons vivement !"</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/client-ibrahima.jpg" alt="Ibrahima Fall" />
                        <div>
                            <strong>Ibrahima Fall</strong>
                            <span>Chef d'entreprise, Point E</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-content">
                        <p>"Un travail remarquable sur notre terrasse ! L'espace est devenu notre lieu de détente favori. Merci pour cette transformation réussie."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="images/client-fatou.jpg" alt="Fatou Seck" />
                        <div>
                            <strong>Fatou Seck</strong>
                            <span>Architecte, Fann</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to action -->
        <section class="cta-section">
            <div class="cta-content">
                <h2>Votre projet de décoration nous intéresse</h2>
                <p>Contactez-nous pour discuter de vos idées et obtenir un devis personnalisé</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="cta-button primary">Demander un devis</a>
                    <a href="tel:+221338245678" class="cta-button secondary">Nous appeler</a>
                </div>
            </div>
        </section>
    </div>
</section>

<?php include('footer.php'); ?>
