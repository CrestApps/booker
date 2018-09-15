/**
* Converts an object with { name : 'n', value: 'v'} to object that looks like this { n : v }
* This is usefull when using serializeArray()
*
*/
window.getRequestObject = function (inputs) 
{
    var final = {};

    $.each(inputs, function (index, input) {

        if (final[input.name] !== undefined) {

            if ($.isArray(final[input.name])) {
                final[input.name].push(input.value)
            } else {
                var current = final[input.name];

                final[input.name] = [current, input.value];
            }
        } else {
            final[input.name] = input.value;
        }
    });

    return final;
}

window.getContent = function (html, index) {
    return html.replace(/_\d+__/g, '_' + index + '__')
        .replace(/\[\d+\]/g, '[' + index + ']');
}

window.getRandomString = function ()
{
    return Math.random().toString(36).substr(2, 5);
}