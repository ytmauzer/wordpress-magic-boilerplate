fetch(WordpressMagicBoilerplate_boilerplate_ajax__vars.ajaxUrlAction)
    .then(function (response) {
        return response.json();
    })
    .then(function (r) {
        console.log(r);
    })
    .catch(function (e) {
        console.log(e);
    });