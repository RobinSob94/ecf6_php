<?php
session_start();
require_once('connect.php');
include_once 'partials/headerfront.inc';?>


<div class="container">
<div class="row">
    <section id="section2" class="col-sm">
        <form>
            <div>
                <label for="name" class="col-form-label">Nom :</label>
                <input type="text" id="name" name="user_name" class="form-control">
            </div>
            <div>
                <label for="last_name" class="form-check-label">Prénom :</label>
                <input type="text" id="last_name" name="user_last_name" class="form-control">
            </div>
            <div>
                <label for="telephone" class="form-check-label">Téléphone :</label>
                <input type="tel" id="telephone" name="user_telephone" class="form-control">
            </div>
            <div>
                <label for="mail" class="form-check-label">e-mail :</label>
                <input type="email" id="mail" name="user_mail" class="form-control">
            </div>
            <div>
                <label for="msg" class="form-check-label">Message :</label>
                <textarea id="msg" name="user_message" class="form-control"></textarea>
            </div>
            <div class="button">
                <button type="submit">Envoyer le message</button>
            </div>
        </form>
    </section>
    <section id="section1" class="col-sm">
        <h1 class="text-center">Contactez-moi</h1>
        <div id="mail" class="text-center">
            <p>
                Mail :
                <a href="mailto:robin.sobasto94@gmail.com" style="text-decoration: none; color: black;">
                    <span>robin.sobast94@gmail.com</span>
                </a>
            </p>
        </div>
        <div id="tel" class="text-center">
            <p>Tel : <span>+33 6 42 47 54 73</span></p>
        </div>
        <div id="adress" class="text-center">
            <p >Adresse :</p>
            <p>
                <span>16 rue Mirabeau<br>94100 Saint-maur</span>
            </p>
        </div>
    </section>
</div>
<br>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2628.5614692032727!2d2.478563215961231!3d48.79026177928076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e60c939e3519e7%3A0x1cac5999fbacc238!2s16%20Rue%20Mirabeau%2C%2094100%20Saint-Maur-des-Foss%C3%A9s!5e0!3m2!1sfr!2sfr!4v1606384808678!5m2!1sfr!2sfr" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<?php include_once 'partials/footer.inc';?>