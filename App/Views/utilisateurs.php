<?php
  use App\Controllers\Admin\Admin;

  if(isset($_GET['search']) && !empty($_GET['search']))
   {
      $search = strip_tags(htmlspecialchars(trim($_GET['search'])));
      $filters = Admin::get_user_by_tag($search);  
  }else {
      $filters = Admin::get_all_users();
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
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?= var_dump($_GET) ?>

        <form action="/users" method="GET">
            <input type="text" name="search" placeholder="search......">
      
            <button type="submit">search</button>
        </form>

        <tbody>
                <?php foreach($filters as $users):?>
                    <tr>
                      <td>#<?= $users['id_user']  ?> </td>
                      <td> <?=  $users['prenoms'] ?> </td>
                      <td><?=$users['pseudo'] ?></td>
                      <td> <?= $users['mails'] ?></td>
                      <td> <?= $users['tranche_age'] ?> </td>
                      <td>  <?=$users['genre'] ?> </td>
                      <td>  <?=$users['role'] ?> </td>
                      <td class="<?= $users['status'] ? 'online' :'offline'  ?>"> 
                        <?= $users['status']? 'online' : 'offline'  ?>
                      </td>

                      <td class="container">
                            <button><i class="fa-solid fa-trash"></i></button>
                            <a href="/user/<?= $users['id_user'] ?>"><i class="fa-solid fa-pencil-alt"></i></a>
                            <a href="/user/<?= $users['id_user'] ?>"><i class="fa-solid fa-eye"></i></a>
                      </td>
                         
                    </tr>
                <?php endforeach?>
     
        </tbody>
    </table>
</div>