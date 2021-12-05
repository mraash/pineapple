window.addEventListener('load', function() {

    const button = document.querySelector('#download-button');

    if (button === null) {
        return;
    }


    button.onclick = function(event) {
        event.preventDefault();

        const uri      = this.dataset.uri;
        const filename = this.dataset.filename;

        const subscribers = getSelectedSubscribers();
        const idsList = subscribers.map(item => item.value);

        const queryString = getIDsQueryString(idsList);

        const $a = document.createElement('a');
        $a.href     = uri + '?' + queryString;
        $a.download = filename;

        $a.click();
    };


    function getSelectedSubscribers() {
        const selector = '.js-subscriber-checkbox:checked';
    
        return [ ...document.querySelectorAll(selector) ];
    }

    function getIDsQueryString(ids) {
        return 'ids[]=' + ids.join('&ids[]=');
    }
});
