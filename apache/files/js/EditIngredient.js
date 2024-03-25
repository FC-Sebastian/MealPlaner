let buyOptionDiv = $('#amount2ingredient');

$('#addBuy').on('click', addBuyOptionDiv);

function deleteBuyOption(id)
{
    $.ajax({
        url: url + '?controller=DeleteBuyOption',
        method: 'POST',
        data: {
            id: id
        },
        success: function () {
            $('#buyOption'+id).remove();
        }
    });
}

function addBuyOptionDiv()
{
    let index = buyOptionDiv.children().length;

    let div = document.createElement('div');
    div.className = 'card card-body w-50 mx-auto mb-2';

    let priceDiv = createFloatingInput('buyOption[' + index + '][price]', 'Preis');
    let amountDiv = createFloatingInput('buyOption[' + index + '][amount]', 'Menge');
    let delButtonDiv = createDeleteButton('Kaufoption Entfernen', div);

    getUnitOptions().then(response => {
        response = JSON.parse(response);
        let unitDiv = createSelectInput('buyOption[' + index + '][unit]', 'Keine Einheit', '0', response);

        div.append(priceDiv);
        div.append(amountDiv);
        div.append(unitDiv);
        div.append(delButtonDiv);

        buyOptionDiv.append(div);
    });
}