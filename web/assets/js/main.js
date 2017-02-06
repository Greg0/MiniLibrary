var $input = $('.typeahead');
$input.typeahead({
    source: function (query, process) {
        return $.get('/search.json', {search: query}, function (data) {
            return process(data);
        });
    }, delay: 100
});
