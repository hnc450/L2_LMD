<form action="/send/mail" method="post">
    <?= \App\Models\Component\Component::Input('email','mail','Entrez votre email',null,null);?>
    <?= \App\Models\Component\Component::Button('submit','soummettre') ?>
</form>