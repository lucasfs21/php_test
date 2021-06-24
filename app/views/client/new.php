<?php $this->pageTitle = 'New Client';?>
<?php include '../app/views/layout/header.php'?>
    <h2>New Client</h2>
    <form id="client_form" action="/clients" method="post">
        <label for="name">Nome</label>
        <br>
        <input type="text" id="name" name="name">
        <br><br>
        <label for="birth_date">Data de Nascimento</label>
        <br>
        <input type="date" id="birth_date" name="birth_date">
        <br><br>
        <label">Gênero</label>
        <br>
        <input type="radio" id="male" name="gender" value="M" checked>
        <label for="male">Masculino</label>
        <input type="radio" id="female" name="gender" value="F">
        <label for="female">Feminino</label>
        <br><br>
        <label for="zip_code">CEP</label>
        <br>
        <input type="text" id="zip_code" name="zip_code">
        <br><br>
        <label for="street">Rua</label>
        <br>
        <input type="text" id="street" name="street">
        <br><br>
        <label for="number">Número</label>
        <br>
        <input type="text" id="number" name="number">
        <br><br>
        <label for="neighboorhood">Bairro</label>
        <br>
        <input type="text" id="neighboorhood" name="neighboorhood">
        <br><br>
        <label for="add_address_detail">Complemento</label>
        <br>
        <input type="text" id="add_address_detail" name="add_address_detail">
        <br><br>
        <label for="state">Estado</label>
        <br>
        <select id="state" name="state">
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
        </select>
        <br><br>
        <label for="city">Cidade</label>
        <br>
        <input type="text" id="city" name="city">
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