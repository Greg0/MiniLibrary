var $input = $('.typeahead');
$input.typeahead({
    source: function (query, process) {
        return $.get('/search.json', {search: query}, function (data) {
            return process(data);
        });
    }, delay: 100
});


$('a.report-book--button').click(function() {
   $('div.report-book--form').slideToggle("normal");
   return false;
});