<?php
    use App\Controllers\Admin\Admin;
    if(!isset($_SESSION['user']) || $_SESSION['user'][0]['role'] !== 'administrateur') {
        header('Location: /login');
        exit();
    }
    
?>
<style>
       .container
       {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
       }
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f4b400;
            color: white;
        }
        .online{
            background-color: green;
            color: white;
        }
        .offline
        {
            background-color: red;
            color: white;
        }
</style>
<h1>hello <?= $_SESSION['user'][0]['prenoms'] ?></h1>

<a href="/users">view all > </a>
<div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prenoms</th>
                <th>Pseudos</th>
                <th>Emails</th>
                <th>Âge</th>
                <th>Genre</th>
                <!-- <th>Role</th> -->
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
                <?php foreach(Admin::get_all_users() as $users):?>
                    <tr>
                      <td>#<?= $users['id_user']  ?> </td>
                      <td> <?=  $users['prenoms'] ?> </td>
                      <td><?=$users['pseudo'] ?></td>
                      <td> <?= $users['mails'] ?></td>
                      <td> <?= $users['tranche_age'] ?> </td>
                      <td>  <?=$users['genre'] ?> </td>
                
                      <td class="<?= $users['status'] ? 'online' :'offline'  ?>"> 
                        <?= $users['status']? 'online' : 'offline'  ?>
                      </td>

        
                    </tr>
                <?php endforeach?>
     
        </tbody>
    </table>
    </div>
<form action="/add/jeu" method="post">
    <input type="text" name="titre_jeu" placeholder="titre game" required>
    <textarea name="description_jeu" id="" placeholder="descritpion game" required></textarea>
    <input type="text" name="level_jeu" placeholder="level game" required>
    <input type="text" name="categorie_jeu" placeholder="categorie game" required>
    <input type="number" name="duration_jeu" placeholder="duration game" required>
    <button type="submit">ajouter</button>
</form>