window.addEventListener('load', function() {

    const button = document.querySelector('#delete-button');

    if (button === null) {
        return;
    }

    button.onclick = function(event) {

        event.preventDefault();

        const subscribers = getSelectedSubscribers();
        const idList = subscribers.map(item => item.value);

        if (idList.length === 0) {
            return;
        }

        const json   = JSON.stringify(idList);

        const xhr = new XMLHttpRequest();

        xhr.onload = function() {
            location.reload();
        };

        xhr.onerror = function() {
            alert('There was some probleems on the server');
        }

        xhr.open('DELETE', '/admin-ajax/subscribers');
        xhr.send(json);
    };


    function getSelectedSubscribers() {
        const selector = '.js-subscriber-checkbox:checked';
    
        return [ ...document.querySelectorAll(selector) ];
    }
});
