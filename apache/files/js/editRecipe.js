let ingredientsDiv = $('#recipe2ingredient');

$('#addIngredient').on('click', addIngredientDiv);

function addIngredientDiv()
{
    let index = ingredientsDiv.children().length;

    let div = document.createElement('div');
    div.className = 'card card-body bg-dark w-50 mx-auto mb-2';

    let amountDiv = createFloatingInput('ingredient[' + index + '][amount]', 'Menge');
    let delButtonDiv = createDeleteButton('Zutat Entfernen', div);

    getUnitOptions().then(response => {
        response = JSON.parse(response);
        let unitDiv = createSelectInput('ingredient[' + index + '][unit]', 'Keine Einheit', '0', response);

        getIngredientOptions(index).then(response => {
            response = JSON.parse(response);
            let ingredientDiv = document.createElement('div');
            ingredientDiv.className = 'row w-50 mx-auto mb-2';
            let ingredientInputs = document.createElement('div');
            ingredientInputs.className = 'd-flex mx-auto w-100 bg-secondary rounded overflow-auto justify-content-around';

            for (let i = 0; i < response.length; i++) {
                ingredientInputs.innerHTML += response[i];
            }
            ingredientDiv.append(ingredientInputs);

            div.append(ingredientDiv);
            div.append(amountDiv);
            div.append(unitDiv);
            div.append(delButtonDiv);

            ingredientsDiv.append(div);
        });

    });
}

function deleteIngredient (id) {
    $.ajax({
        url: url + '?controller=DeleteRecipeIngredient',
        method: 'POST',
        data: {
            id: id
        },
        success: function () {
            $('#ingredient'+id).remove();
        }
    });
}

async function getIngredientOptions(index) {
    return $.ajax({
        url: url + '?controller=GetIngredientOptions&count='+index,
        method: 'GET'
    });
}