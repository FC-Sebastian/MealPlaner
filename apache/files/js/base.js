function createFloatingInput(inputName, labelText, required = true)
{
    let div = document.createElement('div');
    div.className = 'row w-50 mx-auto form-floating mb-2';
    let input = document.createElement('input');
    input.type = 'text';
    input.className = 'col-12 form-control';
    input.name = inputName;
    input.placeholder = '';
    input.required = required;
    let label = document.createElement('label');
    label.innerText = labelText;
    
    div.append(input);
    div.append(label);

    return div;
}

function createDeleteButton(buttonText, delDiv)
{
    let div = document.createElement('div');
    div.className = 'row w-50 mx-auto';
    let button = document.createElement('button');
    button.type = 'button';
    button.className = 'btn btn-danger';
    button.innerText = buttonText;
    button.onclick = function () {
        delDiv.remove();
    }
    div.append(button);
    return div;
}

function createSelectInput(name, defaultOptionText, defaultOptionValue, options, required = true, defaultDisabled = false)
{
    let div = document.createElement('div');
    div.className = 'row w-50 mx-auto mb-2';
    let select = document.createElement('select');
    select.className = 'col-12 form-select';
    select.name = name;
    select.required = required;

    let option = document.createElement('option');
    option.innerText = defaultOptionText;
    option.value = defaultOptionValue;
    option.disabled = defaultDisabled;
    select.append(option);

    for (let i = 0; i < options.length; i++) {
        select.innerHTML += options[i];
    }

    div.append(select);
    select.selectedIndex = 0;

    return div;
}

async function getUnitOptions()
{
    return $.ajax({
        url: url + '?controller=GetUnitOptions',
        method: 'GET'
    });
}