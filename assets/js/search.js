$(document).ready(function() {
    $('#myInput').autocomplete({
        source: function(request, response) {
            const inputValue = $('#myInput').val();
            const data = new URLSearchParams();
            data.append('term', inputValue);

            fetch('modules/autocomplete_data.php?' + data.toString())
                .then(response => response.json())
                .then(data => {
                    response(data);
                })
                .catch(error => console.error('Error:', error));
        },
        appendTo: "#myInputContainer",
        minLength: 1
    });
});

