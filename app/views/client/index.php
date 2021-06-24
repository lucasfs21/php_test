<?php $this->pageTitle = 'Clients';?>
<?php include '../app/views/layout/header.php'?>
    <h2>Clients</h2>
    <a href="clients/new">New Client</a>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Sexo</th>
                <th>CEP</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Complemento</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->clients as $client): ?>
                <tr>
                    <td><?php echo $client["name"] ; ?></td>
                    <td><?php echo $client["birth_date"] ; ?></td>
                    <td><?php echo $client["gender"] ; ?></td>
                    <td><?php echo $client["zip_code"] ; ?></td>
                    <td><?php echo $client["street"] ; ?></td>
                    <td><?php echo $client["number"] ; ?></td>
                    <td><?php echo $client["neighborhood"] ; ?></td>
                    <td><?php echo $client["add_address_details"] ; ?></td>
                    <td><?php echo $client["state"] ; ?></td>
                    <td><?php echo $client["city"] ; ?></td>
                    <td>
                        <form action="/clients/delete/<?php echo $client['id']; ?>" method="post">
                            <a href="/clients/edit/<?php echo $client['id']; ?>"><button type="button">Edit</button></a>
                            <input type="hidden" name="_METHOD" value="delete">
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php include '../app/views/layout/footer.php'?>