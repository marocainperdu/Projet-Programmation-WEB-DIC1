<?php include('header.php'); ?>

<!-- Hero Section Blog -->
<section class="blog-hero">
    <div class="container">
        <h1>Blog Déco Élégance</h1>
        <p class="hero-subtitle">Conseils, tendances et inspirations déco pour votre intérieur sénégalais</p>
    </div>
</section>

<!-- Articles récents -->
<section class="blog-content">
    <div class="container">
        <div class="blog-grid">
            <!-- Article principal -->
            <article class="featured-article">
                <div class="article-image">
                    <img src="images/blog-featured.jpg" alt="Salon africain moderne" />
                    <div class="article-category">Tendances</div>
                </div>
                <div class="article-content">
                    <h2>L'art de mélanger modernité et tradition sénégalaise</h2>
                    <div class="article-meta">
                        <span class="author">Par Aminata Diallo</span>
                        <span class="date">23 juillet 2025</span>
                        <span class="reading-time">5 min de lecture</span>
                    </div>
                    <p>Découvrez comment intégrer harmonieusement l'artisanat sénégalais dans un intérieur contemporain. Des tissus wax aux sculptures traditionnelles, créez un espace unique qui reflète votre identité culturelle.</p>
                    <a href="article-tradition-moderne.php" class="read-more">Lire l'article</a>
                </div>
            </article>

            <!-- Articles secondaires -->
            <div class="articles-grid">
                <article class="article-card">
                    <div class="article-image">
                        <img src="images/blog1.jpg" alt="Salon lumineux" />
                        <div class="article-category">Conseils</div>
                    </div>
                    <div class="article-content">
                        <h3>5 astuces pour un salon lumineux à Dakar</h3>
                        <div class="article-meta">
                            <span class="author">Par Sophie Ndiaye</span>
                            <span class="date">20 juillet 2025</span>
                        </div>
                        <p>Maximiser la lumière naturelle dans votre salon malgré la chaleur tropicale. Couleurs claires, miroirs stratégiques et choix d'éclairage adaptés.</p>
                        <a href="article-salon-lumineux.php" class="read-more">Lire la suite</a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image">
                        <img src="images/blog2.jpg" alt="Tendances déco 2025" />
                        <div class="article-category">Tendances</div>
                    </div>
                    <div class="article-content">
                        <h3>Les tendances déco 2025 au Sénégal</h3>
                        <div class="article-meta">
                            <span class="author">Par Mamadou Sarr</span>
                            <span class="date">15 juillet 2025</span>
                        </div>
                        <p>Couleurs terre, matériaux naturels et objets artisanaux : découvrez les tendances qui marquent l'année 2025 en décoration sénégalaise.</p>
                        <a href="article-tendances-2025.php" class="read-more">Lire la suite</a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image">
                        <img src="images/blog3.jpg" alt="Artisanat sénégalais" />
                        <div class="article-category">Artisanat</div>
                    </div>
                    <div class="article-content">
                        <h3>Intégrer l'artisanat local dans sa déco</h3>
                        <div class="article-meta">
                            <span class="author">Par Fatou Dieng</span>
                            <span class="date">10 juillet 2025</span>
                        </div>
                        <p>Paniers en osier, poteries traditionnelles, sculptures sur bois... Comment sublimer votre intérieur avec l'artisanat sénégalais authentique.</p>
                        <a href="article-artisanat-local.php" class="read-more">Lire la suite</a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image">
                        <img src="images/blog4.jpg" alt="Chambre tropicale" />
                        <div class="article-category">Inspiration</div>
                    </div>
                    <div class="article-content">
                        <h3>Créer une chambre fraîche et apaisante</h3>
                        <div class="article-meta">
                            <span class="author">Par Ibrahima Fall</span>
                            <span class="date">5 juillet 2025</span>
                        </div>
                        <p>Astuces et conseils pour aménager une chambre à coucher confortable malgré la chaleur, avec des matériaux respirants et des couleurs rafraîchissantes.</p>
                        <a href="article-chambre-fraiche.php" class="read-more">Lire la suite</a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image">
                        <img src="images/blog5.jpg" alt="Terrasse sénégalaise" />
                        <div class="article-category">Extérieur</div>
                    </div>
                    <div class="article-content">
                        <h3>Aménager sa terrasse pour la saison sèche</h3>
                        <div class="article-meta">
                            <span class="author">Par Aïssatou Ba</span>
                            <span class="date">30 juin 2025</span>
                        </div>
                        <p>Créez un espace extérieur accueillant avec des plantes résistantes, un mobilier adapté et des solutions d'ombrage élégantes.</p>
                        <a href="article-terrasse-saison-seche.php" class="read-more">Lire la suite</a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image">
                        <img src="images/blog6.jpg" alt="Cuisine africaine moderne" />
                        <div class="article-category">Cuisine</div>
                    </div>
                    <div class="article-content">
                        <h3>La cuisine ouverte à l'africaine</h3>
                        <div class="article-meta">
                            <span class="author">Par Ousmane Diop</span>
                            <span class="date">25 juin 2025</span>
                        </div>
                        <p>Concilier convivialité africaine et modernité dans l'aménagement de votre cuisine. Espaces de partage, matériaux naturels et praticité.</p>
                        <a href="article-cuisine-africaine.php" class="read-more">Lire la suite</a>
                    </div>
                </article>
            </div>
        </div>

        <!-- Newsletter -->
        <section class="newsletter-section">
            <div class="newsletter-content">
                <h3>Restez informé(e) des dernières tendances</h3>
                <p>Recevez nos conseils déco et nos inspirations directement dans votre boîte mail</p>
                <form class="newsletter-form" action="newsletter.php" method="post">
                    <input type="email" name="email" placeholder="Votre adresse email" required>
                    <button type="submit">S'abonner</button>
                </form>
            </div>
        </section>
    </div>
</section>

<?php include('footer.php'); ?>
