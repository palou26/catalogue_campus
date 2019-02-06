<?php
echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="catalogue.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="catalogue.php">Catalogue</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="panier.php">Panier (' . count($_SESSION['ChoosenArcticle']). ' articles)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="catalogue.php?newsession=1">Nouvelle Session</a>
            </li>
        </ul>
    </div>
</nav>

';

?>