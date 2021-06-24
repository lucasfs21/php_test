<?php $this->pageTitle = 'Edit Client';?>
<?php include '../app/views/layout/header.php'?>
    <h2>Edit Client</h2>
    <form id="client_form" action="/clients/<?php echo $this->client->id; ?>" method="post">
        <input type="hidden" name="_METHOD" value="put">
        <label for="name">Nome</label>
        <br>
        <input type="text" id="name" name="name" value="<?php echo $this->client->name; ?>">
        <br><br>
        <label for="birth_date">Data de Nascimento</label>
        <br>
        <input type="date" id="birth_date" name="birth_date"  value="<?php echo $this->client->birth_date; ?>">
        <br><br>
        <label>Gênero</label>
        <br>
        <input type="radio" id="male" name="gender" value="M" <?php echo $this->client->gender == 'M' ? 'checked' : ''; ?>>
        <label for="male">Masculino</label>
        <input type="radio" id="female" name="gender" value="F" <?php echo $this->client->gender == 'F' ? 'checked' : ''; ?>>
        <label for="female">Feminino</label>
        <br><br>
        <label for="zip_code">CEP</label>
        <br>
        <input type="text" id="zip_code" name="zip_code" value="<?php echo $this->client->zip_code; ?>">
        <br><br>
        <label for="street">Rua</label>
        <br>
        <input type="text" id="street" name="street" value="<?php echo $this->client->street; ?>">
        <br><br>
        <label for="number">Número</label>
        <br>
        <input type="text" id="number" name="number" value="<?php echo $this->client->number; ?>">
        <br><br>
        <label for="neighboorhood">Bairro</label>
        <br>
        <input type="text" id="neighboorhood" name="neighboorhood" value="<?php echo $this->client->neighborhood; ?>">
        <br><br>
        <label for="add_address_detail">Complemento</label>
        <br>
        <input type="text" id="add_address_detail" name="add_address_detail" value="<?php echo $this->client->add_address_details; ?>">
        <br><br>
        <label for="state">Estado</label>
        <br>
        <select id="state" name="state">
            <option <?php echo $this->client->state == "AC" ? "selected" : ""; ?> value="AC">Acre</option>
            <option <?php echo $this->client->state == "AL" ? "selected" : ""; ?> value="AL">Alagoas</option>
            <option <?php echo $this->client->state == "AP" ? "selected" : ""; ?> value="AP">Amapá</option>
            <option <?php echo $this->client->state == "AM" ? "selected" : ""; ?> value="AM">Amazonas</option>
            <option <?php echo $this->client->state == "BA" ? "selected" : ""; ?> value="BA">Bahia</option>
            <option <?php echo $this->client->state == "CE" ? "selected" : ""; ?> value="CE">Ceará</option>
            <option <?php echo $this->client->state == "DF" ? "selected" : ""; ?> value="DF">Distrito Federal</option>
            <option <?php echo $this->client->state == "ES" ? "selected" : ""; ?> value="ES">Espírito Santo</option>
            <option <?php echo $this->client->state == "GO" ? "selected" : ""; ?> value="GO">Goiás</option>
            <option <?php echo $this->client->state == "MA" ? "selected" : ""; ?> value="MA">Maranhão</option>
            <option <?php echo $this->client->state == "MT" ? "selected" : ""; ?> value="MT">Mato Grosso</option>
            <option <?php echo $this->client->state == "MS" ? "selected" : ""; ?> value="MS">Mato Grosso do Sul</option>
            <option <?php echo $this->client->state == "MG" ? "selected" : ""; ?> value="MG">Minas Gerais</option>
            <option <?php echo $this->client->state == "PA" ? "selected" : ""; ?> value="PA">Pará</option>
            <option <?php echo $this->client->state == "PB" ? "selected" : ""; ?> value="PB">Paraíba</option>
            <option <?php echo $this->client->state == "PR" ? "selected" : ""; ?> value="PR">Paraná</option>
            <option <?php echo $this->client->state == "PE" ? "selected" : ""; ?> value="PE">Pernambuco</option>
            <option <?php echo $this->client->state == "PI" ? "selected" : ""; ?> value="PI">Piauí</option>
            <option <?php echo $this->client->state == "RJ" ? "selected" : ""; ?> value="RJ">Rio de Janeiro</option>
            <option <?php echo $this->client->state == "RN" ? "selected" : ""; ?> value="RN">Rio Grande do Norte</option>
            <option <?php echo $this->client->state == "RS" ? "selected" : ""; ?> value="RS">Rio Grande do Sul</option>
            <option <?php echo $this->client->state == "RO" ? "selected" : ""; ?> value="RO">Rondônia</option>
            <option <?php echo $this->client->state == "RR" ? "selected" : ""; ?> value="RR">Roraima</option>
            <option <?php echo $this->client->state == "SC" ? "selected" : ""; ?> value="SC">Santa Catarina</option>
            <option <?php echo $this->client->state == "SP" ? "selected" : ""; ?> value="SP">São Paulo</option>
            <option <?php echo $this->client->state == "SE" ? "selected" : ""; ?> value="SE">Sergipe</option>
            <option <?php echo $this->client->state == "TO" ? "selected" : ""; ?> value="TO">Tocantins</option>
        </select>
        <br><br>
        <label for="city">Cidade</label>
        <br>
        <input type="text" id="city" name="city" value="<?php echo $this->client->city; ?>">
        <br><br>
        <button type="submit">Send</button>
    </form>
    <script>
        const getAddress = async(zipCode) => {
            const url = `https://viacep.com.br/ws/${zipCode}/json/`
            const data = await fetch(url)
            const address = await data.json()
            console.log(address)
            completeAddress(address);
            }

        const completeAddress = (address) => {
            document.getElementById('street').value = address.logradouro;
            document.getElementById('neighboorhood').value = address.bairro;
            document.getElementById('state').value = address.uf;
            document.getElementById('city').value = address.localidade;
        }

        let zipCode = document.getElementById('zip_code')
        zipCode.oninput = function() {
            var formatedZipCode = zipCode.value.replaceAll('-', '')
            if (formatedZipCode.length === 8) {
                getAddress(formatedZipCode)
            }
        }

        let form = document.getElementById('client_form')
        form.onsubmit = (event) => {
            event.preventDefault()
            let name = document.getElementById('name').value
            let birthDate = document.getElementById('birth_date').value
            let genderRadioButtons = document.getElementsByName('gender')
            for (let x = 0; x < genderRadioButtons.length; x++) {
                if (genderRadioButtons[x].checked) var gender = genderRadioButtons[x].value
            }
            if (name == '') {
                alert('Por favor, preencha o nome.')
                return
            } else if (birthDate == '') {
                alert('Por favor, preencha a data de nascimento.')
                return
            } else if (gender == '') {
                alert('Por favor, selecione o sexo.')
                return
            } else {
                form.submit()
            }
        }
    </script>