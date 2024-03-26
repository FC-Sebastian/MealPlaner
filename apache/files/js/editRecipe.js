let ingredientsDiv = $('#recipe2ingredient');

$('#addIngredient').on('click', addIngredientDiv);

function addIngredientDiv()
{
    let index = ingredientsDiv.children().length;

    let div = document.createElement('div');
    div.className = 'card card-body w-50 mx-auto mb-2';

    let amountDiv = createFloatingInput('ingredient[' + index + '][amount]', 'Menge');
    let delButtonDiv = createDeleteButton('Zutat Entfernen', div);

    getUnitOptions().then(response => {
        response = JSON.parse(response);
        let unitDiv = createSelectInput('ingredient[' + index + '][unit]', 'Keine Einheit', '0', response);

        getIngredientOptions().then(response => {
            response = JSON.parse(response);
            let ingredientDiv = createSelectInput('ingredient[' + index + '][unit]', 'Zutat', '', response, true, true);

            div.append(ingredientDiv);
            div.append(amountDiv);
            div.append(unitDiv);
            div.append(delButtonDiv);

            ingredientsDiv.append(div);
        });

    });
}

async function getIngredientOptions() {
    return $.ajax({
        url: url + '?controller=GetIngredientOptions',
        method: 'GET'
    });
}