
<style>
body {
    background: linear-gradient(120deg, #2980b9 0%, #6dd5fa 100%);
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}
.form-mail-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.form-mail-box {
    background: #fff;
    padding: 2.7rem 2.2rem 2.2rem 2.2rem;
    border-radius: 18px;
    box-shadow: 0 8px 32px rgba(44, 62, 80, 0.18);
    width: 100%;
    max-width: 410px;
    animation: fadeIn 0.8s cubic-bezier(.4,0,.2,1);
    position: relative;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(40px);}
    to   { opacity: 1; transform: translateY(0);}
}
.form-mail-box .mail-icon {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 1.1rem;
}
.form-mail-box .mail-icon i {
    font-size: 2.6rem;
    color: #2980b9;
    background: #eaf6fb;
    border-radius: 50%;
    padding: 0.7rem;
    box-shadow: 0 2px 8px rgba(41,128,185,0.08);
}
.form-mail-box h2 {
    text-align: center;
    margin-bottom: 1.2rem;
    color: #2980b9;
    font-weight: 800;
    letter-spacing: 1px;
    font-size: 1.5rem;
}
.form-mail-box .form-help {
    text-align: center;
    color: #7f8c8d;
    font-size: 0.98rem;
    margin-bottom: 1.3rem;
}
.form-mail-box input[type="email"] {
    width: 100%;
    padding: 0.85rem 1.1rem;
    margin-bottom: 1.3rem;
    border: 1.5px solid #b2bec3;
    border-radius: 9px;
    font-size: 1.05rem;
    transition: border 0.2s, box-shadow 0.2s;
    background: #f8fbfd;
}
.form-mail-box input[type="email"]:focus {
    border: 2px solid #2980b9;
    box-shadow: 0 0 0 2px #6dd5fa55;
    outline: none;
    background: #fff;
}
.form-mail-box button[type="submit"] {
    width: 100%;
    padding: 0.85rem 1.1rem;
    background: linear-gradient(90deg, #2980b9 60%, #6dd5fa 100%);
    color: #fff;
    border: none;
    border-radius: 9px;
    font-size: 1.13rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    box-shadow: 0 2px 8px rgba(41,128,185,0.08);
    letter-spacing: 0.5px;
}
.form-mail-box button[type="submit"]:hover {
    background: linear-gradient(90deg, #2573a6 60%, #51b6e7 100%);
    transform: translateY(-2px) scale(1.02);
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="form-mail-container">
  <div class="form-mail-box">
    <div class="mail-icon">
      <i class="fas fa-envelope"></i>
    </div>
    <h2>Envoyer un mail</h2>
    <div class="form-help">Entrez votre adresse email pour recevoir un lien de réinitialisation.</div>
    <form action="/send/mail" method="post" autocomplete="off">
        <?= \App\Models\Component\Component::Input('email','mail','Entrez votre email',null,null);?>
        <?= \App\Models\Component\Component::Button('submit','Soumettre') ?>
    </form>
  </div>
</div>
<!-- Ajoute Font Awesome si ce n'est pas déjà fait -->
